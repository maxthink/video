<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Cache;
use app\common\model\Video;
class Index extends Controller 
{
    public function index()
    {
        $page = abs( input('page',1,'intval') );
        $cache_name = 'home_video_page_'.$page;
        //if( null === Cache::get($cache_name,null) )
        if(  Cache::has($cache_name) )
        {
            $res = Cache::get($cache_name);
            $this->assign('res', $res);
            return $this->fetch();
        }
        else
        {
            $limit = 15;
            $offect = abs($page*15 -15);
            $res = Video::order('id desc')->limit($offect, $page)->column('name,actor,intro,cover,type','id');

            if( $res ){
                Cache::set($cache_name, $res, 86400);
                $this->assign('res', $res);
                return $this->fetch();
            }else{
                
            }
        }
        
    }

    public function view()
    {
        $video_id = input('id',0,'intval');
       
        $cache_name = 'home_video_id_'.$video_id;
        if( false !== Cache::get($cache_name) )
        {
            $res = Cache::get($cache_name);
            var_dump( json_decode($res['res_js'],true));
            $this->assign('res', $res);
            return $this->fetch();
        } else {
            $res = Video::get( $video_id )->toArray();
            if($res)
            {
                Cache::set($cache_name, $res, 86420);
                $this->assign('res', $res);
                return $this->fetch();
            } else {
                Cache::set($cache_name, '', 600);
                
            }
        }
        
    }
}
