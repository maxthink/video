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

Route::rule('view/:id', 'index/index/view')->pattern(['id' => '\d+'])->name('home_view');
Route::rule('list_page_:id', 'index/index/index')->pattern(['id' => '\d+'])->name('home_list');

return [];
