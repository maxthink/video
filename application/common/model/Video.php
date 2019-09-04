<?php
/**
 * 视频
 * User: maxthink
 * Date: 2019. 4 .25
 */

namespace app\common\model;
 
class Video extends Common {

    protected $table = 'h_video';
    protected $insert = [];

    const ISLOCK_NO = 0;
    const ISLOCK_YES = 1;

    static $lock_desc = [
        self::ISLOCK_NO => '否',
        self::ISLOCK_YES => '是',
    ];
    
    //
    public function list_admin( $page=1, $size=15, $where=[], $order=[] ){

        if(null==$order){
            array_push($order,'id DESC');
        }

        if( is_int($page) && $page>0 ){

            $result['data'] =  self::query('select SQL_CALC_FOUND_ROWS `id`,host_id,`title`,`name`,`cover`,`intro`,`lock` from '.$this->table.' where '. implode(' and ',$where).' order by  id desc limit '.($page-1)*$size.','.$size );
            $sum = self::query('select found_rows() as coun ');
        
            $result['count'] = $sum[0]['coun'];
            return $result;

        } else {

            return self::query('select SQL_CALC_FOUND_ROWS c.*, u.realname from '.$this->table.' c left join h_user u on c.uid=u.id where '. implode(' and ',$where).' order by c.id desc ' );
        }
    }
}
