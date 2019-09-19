<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Cache;
use app\common\model\Video;

class Index extends Controller 
{
    public function index()
    {
        $current_page = abs( input('id',1,'intval') );
        $cache_name = 'home_video_page_'.$current_page;
        $limit = 20;
        
        if(  Cache::has($cache_name) )
        {
            $res = Cache::get($cache_name);
            $page_html = $this->page($res['count'], $current_page, $limit);
            $this->assign('res', $res['list']);
            $this->assign('page', $page_html);
            $this->assign('count', $res['count']);
            return $this->fetch();
        }
        else
        {
            $offset = abs( $current_page * $limit - $limit);
            list($res, $count) = Video::list_home($offset);

            if( $res ){
                Cache::set($cache_name, ['list'=>$res,'count'=>$count], 86400);
                $page_html = $this->page($count,$current_page,$limit);
                $this->assign('res', $res);
                $this->assign('page', $page_html);
                $this->assign('count', $count);
                return $this->fetch();
            }else{
                Cache::set($cache_name, ['list'=>[],'count'=>$count], 86400);   //没有内容, 缓存写个空的
            }
        }
        
    }

    //详情页
    public function video()
    {
        $video_id = input('id',0,'intval');
       
        $cache_name = 'home_video_id_'.$video_id;
        if( false !== Cache::get($cache_name) )
        {
            $res = Cache::get($cache_name);
            //var_dump( json_decode($res['res_js'],true));
            $this->assign('m', $res);
            return $this->fetch();
        } else {
            $res = Video::get( $video_id )->toArray();
            if($res)
            {
                Cache::set($cache_name, $res, 86420);
                $this->assign('m', $res);
                return $this->fetch();
            } else {
                Cache::set($cache_name, '', 600);
            }
        }        
    }
                
    //获取分页
    private function page($count, $page_curr, $page_size=15 )
    {
        
        $page_html = '<a href="." class="laypage-first" title="首页">首页</a>';
        if( $count <= $page_size )
        {
            return $page_html;
            }
         
        $page_count = ceil($count/$page_size);
        if( $page_curr > $page_count ){
            $page_curr = $page_count;
        }
        
        $start=1;
        $end = $page_count;
        
        if($page_count>10)
        {
            if($page_curr<5)
            {
                $end = 10;
    }
            elseif( $page_curr > ($page_count-6) )
            {
                $start=$page_count-10;
}
            else
            {
                $start=$page_curr-6;
                $end = $page_curr+5;
            }
        }
        
        for(;$start<$end;$start++)
        {
            if($start==$page_curr){
                $page_html .= '<span class="laypage-curr">'.$start.'</span>';
            }else{
                $page_html .= '<a herf="'.url('home_video_list',['id'=>$start] ).'" >'.$start.'</a>';
            }
            
        }

        $page_html .= '<a href="'.url('home_video_list',['id'=>($start+1)] ).'" class="laypage-next">下一页</a>';
        return $page_html;
    }
    
}
