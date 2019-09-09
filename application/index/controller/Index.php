<?php

namespace app\index\controller;

use think\Controller;
use app\common\model\Video;
class Index extends Controller 
{
    public function index()
    {
        
        $res = Video::get(1);
        //print_r($res);
        
        if( $res ){
            $res->res_js = json_decode( $res->res_js , true );
            print_r($res->res_js);
            $this->assign('res', $res);
            return $this->fetch();
        }
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
