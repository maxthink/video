<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1">
    <title>{$res.name}</title>

    <link href="https://vjs.zencdn.net/7.6.0/video-js.css" rel="stylesheet">

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
</head>

<body>
    <video id='my-video' class='video-js' controls preload='auto' width='640' height='264'
           poster='/static/index/pin.jpg' data-setup='{}'>
        <source src='https://cdn-7.haku88.com/hls/2019/09/03/tBCyRuI5/playlist.m3u8' type='application/x-mpegURL'>
        <p class='vjs-no-js'>
            To view this video please enable JavaScript, and consider upgrading to a web browser that
            <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
        </p>
    </video>
    <div id="play_list">
    </div>
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        var video = '<?php echo $res['res_js']; ?>';
        if( video!=='' ){
            var videos = JSON.parse(video);
            $.each(videos.Data, function(key, val){
                var playlist = '<ul>';
                $.each(val.playurls, function(_key,_val){
                    playlist += '<li><p class="playres" data="'+_val[1]+'" >'+_val[0]+"</p></li>";
                })
                playlist += '</ul>';
                $("#play_list").append(playlist);
            })
        }
        
        $('.playres').on('click',function(){
            alert($(this).attr('data'));
            $('#my-video>source').attr('src',$(this).attr('data') );        
        })
    </script>
    <script src='https://vjs.zencdn.net/7.4.1/video.js'></script>

</body>
</html>
