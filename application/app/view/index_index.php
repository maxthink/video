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
            <li class="header-nav-item "><a href="/" target="_blank" >首页</a> </li>
            <li class="header-nav-item"> <a href="/movie.html" target="_blank" >电影</a></li>
            <li class="header-nav-item"> <a href="/video.html" target="_blank">电视剧</a></li>
            <li class="header-nav-item"> <a href="/cartoon.html" target="_blank">动漫</a></li>
            <li class="header-nav-item"> <a href="/happy.html" target="_blank">综艺</a></li>
        </ul>
    </div>
</div>

<div class="container list">
    <div class="list-content">
        <ul>
            {foreach $res as $k=>$m }
            <li>
                <a class="list-cover" href="{:url('app_video_view',['id'=>$m['id'] ])}" target="_blank" > <img src="{$m.cover}" alt="{$m.name}{$m.desc}"> </a>
                <h2><a class="list-title"  href="{:url('app_video_view',['id'=>$m['id'] ])}" >{$m.name} {$m.desc} {$m.alise}</a> </h2>
                <div class="list-info">
                    <span>{$m.area}</span>
                    <span>{$m.type}</span> 
                    <span> <i class="iconfont icon-yulan1" title=""></i> 152</span>
                    <p>{$m.intro}</p>
                </div>
            </li>
            {/foreach}
        </ul>
        <div class="list-page">
            {$page|raw}
        </div>
    </div>

    <div class="list-ad" >
        <dl class="fly-panel fly-list-one">
            <dt class="fly-panel-title">最新更新</dt>
            <dd>
                <a href="">基于 layui 的极简社区页面模版</a>
                <span><i class="iconfont icon-pinglun1"></i> 16</span>
            </dd>
            <dd>
                <a href="">基于 layui 的极简社区页面模版</a>
                <span><i class="iconfont icon-pinglun1"></i> 16</span>
            </dd>
        </dl>

        <div class="fly-panel">
            <div class="fly-panel-title">这里可作为广告区域</div>
            <div class="fly-panel-main"><a href="" target="_blank" class="fly-zanzhu" style="background-color: #393D49;">虚席以待</a></div>
        </div>

        <div class="fly-panel fly-link">
            <h3 class="fly-panel-title">友情链接</h3>
            <dl class="fly-panel-main">
                <dd><a href="/" target="_blank">layui</a><dd>
                <dd><a href="/" target="_blank">WebIM</a><dd>
                <dd><a href="/" target="_blank">layer</a><dd>
                <dd><a href="/" target="_blank">layDate</a><dd>
                <dd><a href="mailto:xianxin@layui-inc.com?subject=%E7%94%B3%E8%AF%B7Fly%E7%A4%BE%E5%8C%BA%E5%8F%8B%E9%93%BE" class="fly-link">申请友链</a><dd>
            </dl>
        </div>
    </div>
</div>
<div class="footer">
    <p><a href=" /" target="_blank"> 社区</a> 2019 &copy; <a href="/" target="_blank">lllllljjj.com 出品</a></p>
    <p>
        <a href=" /" target="_blank">付费计划</a>
        <a href=" y/" target="_blank">获取 社区模版</a>
        <a href=" 1/" target="_blank">微信公众号</a>
    </p>
</div>
</body>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?e43e868097a2cd0a997a29227736415c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</html>
