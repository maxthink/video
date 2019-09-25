<?php
/**
 * kubo 资源采集
 * 
 * 1.0 2019/9/25 采集完成
 */

namespace app\spider\controller;

use think\Controller;
use QL\QueryList;

class Kubo extends Controller {

    public $dbtable = 'h_res_video';
    public $ql = null;
    public $domain = 'http://www.kubozy.net';
    public $res_from = 'kubo';

    public function index() {

        $this->ql = QueryList::getInstance();
        set_time_limit(0);
        ini_set('display_error', 'On');
        error_reporting(E_ALL);
        ini_set('memory_limit', '128M');

        //todo1  列表页首页
        $html = $this->geturl('/?m=vod-type-id-2.html');
        $page_lists = $this->ql->html($html)->find('.pagelink_b')->attrs('href')->all();
        
        //todo2 得到所有列表页
        for ($i = 1; $i < count($page_lists); $i++) { //动态count, pagelist会增加
            //echo '<br>1 pagelists geting : '.memory_get_usage();
            $html = $this->geturl($page_lists[$i]);
            if (false !== $html) {
                $data = $this->ql->html($html)->find('.pages>.pagelink_b')->attrs('href');
            } else {
                continue;
            }

            $_lists = $data->all();

            foreach ($_lists as $_url) {
                if (!in_array($_url, $page_lists)) {
                    array_push($page_lists, $_url);
                }
            }
            //if($i==10) break;
            //echo '<br>1 pagelists end : '.memory_get_usage();
        }

        $page_lists = array_unique($page_lists);
        natsort($page_lists);
        //shuffle($page_lists);
        print_r($page_lists);

        //todo3 detail-page 单个详情: 从列表页获取单个数据
        $detail = [];
        $range = '.xing_vb4'; //列表里获取单个元素
        $rule = [
            'url' => ['a', 'href'] //列表单个元素虽然有id, 但还是以url为键, 
        ];
        $ii = 1;
        foreach ($page_lists as $list_url) {
            //echo '<br/>2 page_list get detail, memory use: ' . $list_url . ' __' . memory_get_usage();
            $html = $this->geturl($list_url);
            if (false == $html)
                continue;

            $dom = $this->ql->html($html)->rules($rule)->range($range)->queryData();  //获取列表单页里的 单个资源地址
            foreach ($dom as $unit) {
                $detail[] = $unit['url'];
            }
            $this->insertdb($detail);
            $detail = [];

            //echo '<br/>2 page_list get detail, memory use end : ' . memory_get_usage();
            $ii++;
            //if ($ii > 10) break;
        }
    }

    function insertdb($detail) {
        //echo '<br>3 insertdb : '. memory_get_usage();
        //todo 进详情页
        foreach ($detail as $k => $url) {
            //获取资源源id, md5值, 
            $unit['res_id'] = 0;
            if (preg_match('/\d+/', $url, $match)) {
                $unit['res_id'] = $match[0];  //res id
                unset($match);
            } else {
                echo "\r\n" . 'not get id : ' . $url;
                continue;
            }
            $qlh = $this->ql->html($this->geturl($url));
            //获取资源详情
            $res = $qlh->find('#2>ul>li')->texts()->flatten()->all();
            if (!$res) {
                echo '<br> 资源是空的 ' . $unit['res_id'];
                continue; //资源是空的, 直接下一个
            }
            foreach ($res as $kk => $vv) {
                $k = explode('$', $vv);
                $res[$kk] = ['name' => str_replace(['第','集'],'', $k[0]), 'res' => $k[1]];
            }

            //print_r($res);break;
            //计算资源存储结构
            $unit['res'] = json_encode($res);
            unset($k, $kk, $vv, $res);
            $unit['md5'] = md5($unit['res']);  //比较是否更新用

            $status = $this->newOrUpdate($unit['res_id'], $unit['md5'], $unit['res']);

            if ($status == 0) { //没有该资源
                $unit['url'] = $url;
                $unit['name'] = addslashes($qlh->find('h2')->text());
                $unit['desc'] = addslashes($qlh->find('.vodInfo>.vodh>span')->text());           //影片资源描述, hd 高清 dvd 这类
                $unit['alise'] = addslashes($qlh->find('.vodinfobox>ul>li:eq(0)>span')->text());  //别名      
                $unit['director'] = addslashes($qlh->find('.vodinfobox>ul>li:eq(1)>span')->text());  //导演
                $unit['actor'] = addslashes($qlh->find('.vodinfobox>ul>li:eq(2)>span')->text());  //演员
                $unit['type'] = $qlh->find('.vodinfobox>ul>li:eq(3)>span')->text();  //类型
                $unit['area'] = $qlh->find('.vodinfobox>ul>li:eq(4)>span')->text();  //地区
                $unit['language'] = $qlh->find('.vodinfobox>ul>li:eq(5)>span')->text();  //语言
                $unit['showtime'] = $qlh->find('.vodinfobox>ul>li:eq(6)>span')->text();  //上映时间
                $unit['cover'] = $qlh->find('.vodImg>img')->src;                      //封面
                $unit['intro'] = addslashes($qlh->find('.vodplayinfo:eq(1)')->text());            //简介
                $unit['res_from'] = $this->res_from;
                $unit['timeline'] = time();
                
                $this->add($unit);
                $unit = [];
                //break;
            } else {
                $unit = [];
                continue; //next one
            }
            unset($qlh);
            //echo '<br>3  6 '. memory_get_usage().'<br>';
        }

        //echo '<br>3 insertdb end : '. memory_get_usage();
    }

    /**
     * 
     * @param int $res_id  源id
     * @param string $res_md5 源资源md5
     */
    public function newOrUpdate($res_id, $res_md5, $res) {

        $m = \Db::table($this->dbtable)->where('res_id=' . $res_id)->find();
        if ($m) {
            if ($m['md5'] != $res_md5) {
                $e = \Db::table($this->dbtable)->where('res_id='.$res_id)->update( ['md5'=>$res_md5,'res'=>$res,'timeline'=>time(),'isup'=>0] );
                if ($e) {
                    echo '<br>更新成功' . $res_id;
                    return 2;   //更新成功
                } else {
                    echo '<br>更新失败' . $res_id;
                    return 3;  //更新失败
                }
            } else {
                //echo '<br>无需更新'.$res_id;
                return 1; //不需更新
            }
        } else {
            echo '<br>添加' . $res_id;
            return 0;   //无资源
        }
    }

    public function add($detail) {
        echo '<br>db add' . $detail['res_id'];

        try {
            $re = \Db::table($this->dbtable)->insert($detail);
            if (false == $re) {
                // echo "<br>\r\n 添加错误  insert into ".$dbtable.' set '. implode(',', $sql) ;
                echo "<br>\r\n add error " . mysqli_error(self::$mysqli) . mysqli_errno(self::$mysqli);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function geturl($url, $ttl = 86400) {

        try {
            $url = $this->domain . $url;
            $query = [];
            if (strpos($url, '?')) {      //处理 http://domain.com/?moty=323&kkk=333 这类问题
                $params = parse_url($url);
                $_query = explode('&', $params['query']);
                foreach ($_query as $q_string) {
                    $_temp = explode('=', $q_string);
                    $query[$_temp[0]] = $_temp[1];
                }
            }
            //print_r($query);die;
            return $this->ql->get($url, $query, [
                    'headers' => [
                        'referer' => $this->domain,
                        'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
                        'accept-language' => 'zh-CN,zh;q=0.8',
                        'accept-encoding' => 'gzip, deflate, sdch, br',
                    ],
                    'cache' => '.', //current dir
                    'cache_ttl' => $ttl,
                    ]
                )->getHtml();
        } catch (\Exception $e) {
            echo $e->getMessage();
            //die;
            return false;
        }
    }

}