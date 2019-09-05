<?php

require '../../vendor/autoload.php';

use QL\QueryList;

//采集某页面所有的图片
$data = QueryList::get('https://www.juji.tv/dianshiju/index.html')->find('.ui-pages>a')->attrs('href');
//打印结果
print_r($data->all());