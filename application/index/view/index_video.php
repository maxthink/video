<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>test</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="keywords" content="电影天堂_电影下载">
<meta name="description" content="电影天堂_最新电影_高清电影_在线观看_在线视频_在线看电影">
<link rel="stylesheet" href="/static/index/style1.css">
</head>
<body>

<div class="header">
    <div class="container">
        <a class="header-logo" href="/"> 天堂电影院 </a>
        <ul class="header-nav">
            <li class="header-nav-item header-nav-item-this"><a href="/" target="_blank" >推荐站一</a> </li>
            <li class="header-nav-item"> <a href="/" target="_blank" >推荐站二</a> </li>
            <li class="header-nav-item"> <a href="http://wm/" target="_blank">推荐站三</a> </li>
        </ul>
    </div>
</div>

<div class="container main">
    <div class="video-left">
        <div class="video-box">
            <video id='my-video' class="video-intance" muted="muted" class='video-js vjs-big-play-centered' controls preload='auto' width='100%'  height='300' poster='/static/index/pin.jpg'  data-setup='{}'>
                <p class='vjs-no-js'> 请开启Javascript脚本以便 支持HTML5 video播放器 </p>
            </video>
        </div>  
        <div class="video-info">
            <h1>{$m.name}{$m.desc}</h1>
            <span>{$m.showtime}</span>
            <span>{$m.type}</span>
            
        </div>
    </div>
    <div class="video-right" >
        <p>剧集</p>
        <ul id="play_list" class="vedio_numbers" >
            <li class="item" ><a href="#" >1</a></li>
            <li class="item" ><a href="#" >2</a></li>
            <li class="item" ><a href="#" >4</a></li>
            <li class="item" ><a href="#" >5</a></li>
            <li class="item" ><a href="#" >6</a></li>
            <li class="item" ><a href="#" >7</a></li>
            <li class="item" ><a href="#" >8</a></li>
            <li class="item" ><a href="#" >9</a></li>
            <li class="item" ><a href="#" >10</a></li>
            <li class="item" ><a href="#" >11</a></li>
            <li class="item" ><a href="#" >12</a></li>
            <li class="item" ><a href="#" >13</a></li>
            <li class="item" ><a href="#" >14</a></li>
            <li class="item" ><a href="#" >15</a></li>
            <li class="item" ><a href="#" >16</a></li>
            <li class="item" ><a href="#" >17</a></li>
            <li class="item" ><a href="#" >18</a></li>
            <li class="item" ><a href="#" >19</a></li>
            <li class="item" ><a href="#" >10</a></li>
        </ul>
    </div>    
</div>
<div class="container video-intro">
    <p>{$m.intro}</p>
</div>
    
<div class="container recommend">
        <p>推荐</p>
        <ul class="video-recommend">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
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
<!--script src="/static/index/video.min.js"></script>
<link href="//vjs.zencdn.net/7.6.0/video-js.min.css" rel="stylesheet"-->
<link href="/static/index/video-js.css" rel="stylesheet">
<!--script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script-->
<script src='/static/index/video.min.js'></script>

<script type="text/javascript">
    var video = <?php echo $m['res']; ?>;

    //var videos = JSON.parse(video);
    var playlist = '<ul>';
    $.each(video, function (key, val) {
        playlist += '<li class="item" ><a href="' + val.res + '" >' + val.name + "</a></li>";
    })
    playlist += '</ul>';
    //$("#play_list").append(playlist);

    $('.playres').on('click', function () {
        //alert($(this).attr('data'));
        $('#my-video>source').attr('src', $(this).attr('data'));
    })

    var options = {
        width: 640,
        aspectRatio: '16:9',
        sources: [{
                src: '/static/index/ad2.mp4',
                type: 'video/mp4'
            }, {
                src: $(".resource>li:eq(" + playOrder + ")>p").attr('data'),
                type: 'application/x-mpegURL'
            }
        ],
        techOrder: ['html5'],
    };

    var playOrder = 0;
    var player = videojs('my-video', options, function onPlayerReady() {

        //player.play(); // 开始播放
        console.log('muted: ' + this.muted);
        // 监听播放结束状态
        this.on('ended', function () {
            player.src($(".resource>li:eq(" + playOrder + ")>a").attr('href'));
            playOrder++;
            //player.play(); // 开始播放
        });
        //document.getElementById("my-video").click;
    });


    </script>

</body>
</html>