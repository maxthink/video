<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>test</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="keywords" content="电影天堂_电影下载">
<meta name="description" content="电影天堂_最新电影_高清电影_在线观看_在线视频_在线看电影">
<link rel="stylesheet" href="/static/index/style3.css">
</head>
<body>

<div class="header">
    <div class="container">
        <a class="header-logo" href="/"> 天堂电影院 </a>
        <ul class="header-nav">
            <li class="header-nav-item header-nav-item-this"><a href="/" target="_blank" >首页</a> </li>
            <li class="header-nav-item"> <a href="/" target="_blank" >电影</a></li>
            <li class="header-nav-item"> <a href="http://wm/" target="_blank">电视剧</a></li>
            <li class="header-nav-item"> <a href="http://wm/" target="_blank">动漫</a></li>
            <li class="header-nav-item"> <a href="http://wm/" target="_blank">综艺</a></li>
        </ul>
    </div>
</div>

<div class="main">
    <div class="container">
        <div class="video-left">
            <video id='my-video' class="video-intance" muted="muted" controls preload='auto' poster='/static/index/pin.jpg'  data-setup='{}'>
                <p> 请开启Javascript脚本以便 支持HTML5 video播放器 </p>
            </video>
            <div class="video-info">
                <h1>{$m.name}{$m.desc}</h1>
                <span>{$m.showtime}</span>
                <span>{$m.type}</span>
            </div>
        </div>
        <div class="video-right" >
            <p>剧集</p>
            <div id="play_list" class="vedio_numbers scroll_wrap" ></div>
        </div>
    </div>
</div>
    
<div class="container intro">
    <p class="intro-title" >影片简介</p>
    <p class="intro-content" >{$m.intro}</p>
</div>

<div class="container recommend">
    <p class="recommend-title" >推荐</p>
    <ul class="recommend-list">
        {foreach $recommend as $k=>$val }
        <li><a href="{:url('home_video_view',['id'=>$val['id']])}"><img src="{$val.cover}" ></a><p>{$val.name}</p></li>
        {/foreach}         
    </ul>
</div>

<div class="footer">
    <p><a href="http://fly.layui.com/" target="_blank">Fly社区</a> 2017 &copy; <a href="http://www.layui.com/" target="_blank">layui.com 出品</a></p>
    <p>
        <a href="http://fly.layui.com/jie/3147/" target="_blank">付费计划</a>
        <a href="http://www.layui.com/template/fly/" target="_blank">获取Fly社区模版</a>
        <a href="http://fly.layui.com/jie/2461/" target="_blank">微信公众号</a>
    </p>
</div>

<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/hls.js/0.12.5-beta.2/hls.js"></script>
<script type="text/javascript">
    var video = {$m.res|raw};
    
    //var videos = JSON.parse(video);
    var playlist = '';
    $.each(video, function(key, val){
        playlist += '<span><a class="playres" data="'+val.res+'" >'+3+"</a></span>";
    }) 
    $("#play_list").html(playlist);
    
    $('.playres').on('click',function(){
        hls.loadSource($(this).attr('data') );
        hls.attachMedia(video);
        $(this).addClass('current')
        playOrder = $(this).index();
    })

    poster='/static/index/pin.jpg'
    var playOrder = 0;
    
    var video = document.getElementById('my-video');
    var hls;
    if(Hls.isSupported()) {
        var hls = new Hls();
        hls.loadSource( $('#play_list>span:eq('+playOrder+')>a').attr('data') );
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED,function() {
            //video.play();
            playOrder++;
        });
        hls.on(Hls.Events.ENDED,function() {
            if( $(".playres").size() - playOrder > 1 ) {
                hls.loadSource( $('#play_list>span:eq('+playOrder+')>a').attr('data') );
                hls.attachMedia(video);
            }else{
                //todo 下一个影片
            }
        });
    }else{
        //浏览器不支持hls协议
    }
     
 
</script>
</body>
</html>