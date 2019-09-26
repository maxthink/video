<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,maxthink';
});

Route::rule('list_video_:id', 'index/index/index')->pattern(['id' => '\d+'])->name('home_video_list');
Route::rule('video/:id', 'index/index/video')->pattern(['id' => '\d+'])->name('home_video_view');

Route::rule('app_list_video_:id', 'app/index/index')->pattern(['id' => '\d+'])->name('app_video_list');
Route::rule('app_video/:id', 'app/index/video')->pattern(['id' => '\d+'])->name('app_video_view');
return [];
