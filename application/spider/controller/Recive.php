<?php

namespace app\spider\controller;

use think\Controller;
use app\common\model\Video;

class Recive extends Controller {
    
    //resive video
    public function video() {

        $params = input('post.*');
        
        $m = Video::get($params['id']);
        if($m){
            if($m['timeline']!=$params['timeline']){
                if( $m->save($params) ){
                    return 2;   //更新成功
                }else{
                    return 3;  //更新失败
                }
            }else{
                return 1; //不需更新
            }
        }else{
            if( $m->insert($params) ){
                return 0; //添加成功
            }else{
                return 1; //添加失败
            }
        }
 
    }
    
    public function movie()
    {
        
    }

    
    
}
