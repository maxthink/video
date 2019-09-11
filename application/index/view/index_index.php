<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
<title>天天影视</title>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width,initial-scale=1">
</head>
<body>
    <ul class="page_list">
        <?php foreach ($res as $video): ?>
            <li>
                <img src="<?php echo $video['cover']; ?>" >
                <h5><a href="view/<?php echo $video['id']; ?>" ><?php echo $video['name']; ?></a></h5>
                <p><?php echo $video['actor']; ?></p>
                <p><?php echo $video['intro']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
<link href="https://vjs.zencdn.net/7.6.0/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src='https://vjs.zencdn.net/7.4.1/video.js'></script>
</html>
