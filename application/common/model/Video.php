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
    
    
}
