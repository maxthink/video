<?php
/**
 * 视频
 * User: maxthink
 * Date: 2019. 4 .25
 */

namespace app\common\model;
 
class Video extends Common {

    protected $table = 'h_res_video';

    public static function list_home($offset, $limit=20)
    {
        $res = self::order('id desc')->limit($offset, $page)->column('name,alise,desc,director,actor,language,showtime,type,area,intro,cover,type','id');
        $count = self::count();
        return [$res,$count];
    }

    public function list_admin( $page=1, $size=15, $where='1=1', $order=[] ){
 
        if(null==$order){
            array_push($order,'id DESC');
        }

        if( is_int($page) && $page>0 ){

            $result['data'] =  self::query('select SQL_CALC_FOUND_ROWS * from '.$this->table.' where '. implode(' and ',$where).' order by  id desc limit '.($page-1)*$size.','.$size );
            $sum = self::query('select found_rows() as coun ');
        
            $result['count'] = $sum[0]['coun'];
            return $result;

        } else {
            return self::query('select SQL_CALC_FOUND_ROWS * from '.$this->table.' where '. implode(' and ',$where).' order by id desc ' );
        }
    }
}
