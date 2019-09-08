<?php

require '../../vendor/autoload.php';

use QL\QueryList;

$referer_list = [
    'referer'=>'httphttps://www.juji.tv/s',
    'user-agent'=>'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
    'accept-language'=>'zh-CN,zh;q=0.8',
    'accept-encoding'=>'gzip, deflate, sdch, br',
    'cookie'=>'first_h=1567866684341; count_h=1; first_m=1567866684343; count_m=1; __music_index__=1; UM_distinctid=16d0c2300d83ac-069463574e77d-6a11157a-100200-16d0c2300da122; CNZZDATA1275758918=915366585-1567866049-%7C1567866049; Hm_lvt_3c7de09b19879e2b844c58d409602f7e=1567866683; Hm_lpvt_3c7de09b19879e2b844c58d409602f7e=1567866701; first_h=1567866702277; count_h=1; first_m=1567866702279; count_m=1; __music_index__=1'
    ];
$domain = 'https://www.juji.tv';

function geturl($url)
{
    global $client,$domain,$referer_list;
    try{
        return QueryList::get(
            $domain.$url,
            [],
            [
                'headers'=>$referer_list,
                'cache' => 'D:/html/cache',
                'cache_ttl' => 46000 ,
            ] 
        )->getHtml();
    }catch(\Exception $e){
        echo $e->getMessage();
        die;
    }
}

//列表页
$html = geturl('/dianshiju/index.html');
$data = QueryList::html($html)->find('.ui-pages>a')->attrs('href');
$page_lists = $data->all();
print_r($page_lists);

for($i=1;$i<count($page_lists);$i++){
    
    $html = geturl($page_lists[$i]);
    
    
    $data = QueryList::html($html)->find('.ui-pages>a')->attrs('href');
    $_lists = $data->all();
    foreach($_lists as $_url){
        if(!in_array($_url,$page_lists)){
            array_push($page_lists,$_url);
        }
    }
    
}
$page_lists = array_unique($page_lists);
natsort($page_lists);

//单个详情: 从列表页获取单个数据
$detail = [];
foreach($page_lists as $list_url){
    $html = geturl($list_url);
    //列表页的单个元素
    $rule=[
        'name'=>['.play-txt>h5>a ','text'],
        'actor'=>['.play-txt>.actor','text'],
        'cover'=>['.play-img>img','src'],
        'type'=>['.fn-left>a','text'],
        'url'=>['.play-img','href']
    ];
    $range = '.show-list>li';
    $dom = QueryList::html($html)->rules($rule)->range($range)->queryData();
    
    foreach($dom as $unit){
        if( !array_key_exists($unit['url'],$detail) )
        {
            $detail[ $unit['url'] ] = $unit;
        }
    }
    //print_r($detail);die;
}

//todo 进详情页
foreach($detail as $k=>$unit )
{
    $html = geturl($unit['url']);
    $rule = ['sid'=>['#SOHUCS','sid']];
    $sid = QueryList::html($html)->find('#SOHUCS')->attr('sid');

    $unit['id']=$sid;
    $unit['res'] = $unit['url'].'play-'.$sid.'-0-1.js';
    $html = geturl($unit['res']);
    $unit['res_js']= json_decode( substr( str_replace('var ff_urls=\'', '', $html),0,-2),1);
    print_r($unit);die;
    $detail[$k]=$unit;
    
}

