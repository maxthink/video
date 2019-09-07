<?php

require '../../vendor/autoload.php';

use QL\QueryList;

$referer_list = [
    'referer'=>'httphttps://www.juji.tv/s',
    'user-agent'=>'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
    'accept-language'=>'zh-CN,zh;q=0.8',
    'accept-encoding'=>'gzip, deflate, sdch, br',
    'cookie'=>'first_h=1567866684341; count_h=1; first_m=1567866684343; count_m=1; __music_index__=1; UM_distinctid=16d0c2300d83ac-069463574e77d-6a11157a-100200-16d0c2300da122; CNZZDATA1275758918=915366585-1567866049-%7C1567866049; Hm_lvt_3c7de09b19879e2b844c58d409602f7e=1567866683; Hm_lpvt_3c7de09b19879e2b844c58d409602f7e=1567866701; first_h=1567866702277; count_h=1; first_m=1567866702279; count_m=1; __music_index__=1'
    ];
$domain = 'https://www.juji.tv';
$client = new GuzzleHttp\Client();

function geturl($url)
{
    global $client,$domain,$referer_list;
    $list = $client->request('GET', $domain.$url,[
            'cache' => 'D:/html/cache',
            'cache_ttl' => 600 ],['headers'=>$referer_list] );
    return $list->getBody();
}


$html = geturl('/dianshiju/index.html');
$data = QueryList::html($html)->find('.ui-pages>a')->attrs('href');
$page_lists = $data->all();
print_r($page_lists);

for($i=1;$i<count($page_lists);$i++){
    
    $html = geturl($page_lists[$i]);
    $dom = QueryList::html($html)->find('.show_list>li')->
    
    $data = QueryList::html($html)->find('.ui-pages>a')->attrs('href');
    $_lists = $data->all();
    foreach($_lists as $_url){
        if(!in_array($_url,$page_lists)){
            array_push($page_lists,$_url);
        }
    }
    die;
}
$page_lists = array_unique($page_lists);
natsort($page_lists);

foreach($page_lists as $detail_url){
    
    $html = geturl($detal_url);
    
}
