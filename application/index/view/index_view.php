<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
<title>{$res.name}</title>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width,initial-scale=1">
<link href="https://vjs.zencdn.net/7.6.0/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<style>
    .resource{width:95%; padding:4px;}
    .resource li{ width:20%;height:40px; display:block; float:left; }
</style>
</head>
<body>
    <video 
        id='my-video' 
        class='video-js vjs-big-play-centered' 
        controls 
        preload='auto' 
        width='640' 
        height='264'
        poster='/static/index/pin.jpg' 
        data-setup='{}'>
        <source src='https://cdn-7.haku88.com/hls/2019/09/03/tBCyRuI5/playlist.m3u8' type='application/x-mpegURL'>
        <p class='vjs-no-js'> 请开启Javascript脚本以便 支持HTML5 video播放器 </p>
    </video>
    <div id="play_list"></div>
    
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script src="//vjs.zencdn.net/7.4.1/video.min.js"></script>
    <script type="text/javascript">
        var video = '<?php echo $res['res_js']; ?>';
        if( video!=='' ){
            var videos = JSON.parse(video);
            $.each(videos.Data, function(key, val){
                var playlist = '<ul class="resource" >';
                $.each(val.playurls, function(_key,_val){
                    playlist += '<li><p class="playres" data="'+_val[1]+'" >'+_val[0]+"</p></li>";
                })
                playlist += '</ul>';
                $("#play_list").append(playlist);
            })
        }
        
        $('.playres').on('click',function(){
            //alert($(this).attr('data'));
            $('#my-video>source').attr('src',$(this).attr('data') );        
        })
        
        var options = {};

        var player = videojs('my-player', options, function onPlayerReady() {
            
            this.play(); // 开始播放

            // 监听播放结束状态
            this.on('ended', function() {
                
            });
        });
    

    </script>
    
</body>
<script src='https://vjs.zencdn.net/7.4.1/video.js'></script>
<script src="//vjs.zencdn.net/7.4.1/video.min.js"></script>
<link href="//vjs.zencdn.net/7.6.0/video-js.min.css" rel="stylesheet">
</html>
