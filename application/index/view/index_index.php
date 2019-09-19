<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>test</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="keywords" content="电影天堂_电影下载">
<meta name="description" content="电影天堂_最新电影_高清电影_在线观看_在线视频_在线看电影">
<link rel="stylesheet" href="/static/index/layui.css">
<link rel="stylesheet" href="/static/index/global.css">
</head>
<body>

<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/"> 天堂电影院 </a>
        <ul class="layui-nav fly-nav layui-hide-xs">
            <li class="layui-nav-item layui-this"><a href="/" target="_blank" ><i class="iconfont icon-jiaoliu"></i>推荐站一</a> </li>
            <li class="layui-nav-item"> <a href="/" target="_blank" ><i class="iconfont icon-iconmingxinganli"></i>推荐站二</a> </li>
            <li class="layui-nav-item"> <a href="http://wm/" target="_blank"><i class="iconfont icon-ui"></i>推荐站三</a> </li>
        </ul>
    </div>
</div> 

<div class="fly-panel fly-column">
    <div class="layui-container">
        <ul class="layui-clear">
            <li class="layui-hide-xs"><a href="/">首页</a></li> 
            <li class="layui-this"><a href="/movie/new.html">最新电影</a></li> 
            <li><a href="/movie/all.html">电影</a></li> 
            <li><a href="/movie/guonei.html">电视剧</a></li> 
            <li><a href="/movie">动漫</a></li> 
            <li><a href="">综艺</a></li>
        </ul>     
    </div>
</div>

<div class="layui-container">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">
            <div class="fly-panel" style="margin-bottom: 0;">
                <ul class="fly-list">    
                    {foreach $res as $k=>$m }
                    <li>
                        <a href="{:url('home_video_view',['id'=>$m['id'] ])}" target="_blank" class="fly-avatar"> <img src="{$m.cover}" alt="{$m.name}{$m.desc}"> </a>
                        <h2> <a href="detail.html">{$m.name} {$m.desc} {$m.alise}</a> </h2>
                        <div class="fly-list-info">
                            <a href="{:url('home_video_view',['id'=>$m['id'] ])}" target="_blank" ><cite>{$m.area}</cite></a>
                            <span>{$m.type}</span> 
                            <p class="layui-hide-xs" title=" ">{$m.intro}</p>
                            <span class="fly-list-nums"> <i class="iconfont icon-yulan1" title="">观看</i> 152</span>
                        </div>
                    </li>
                    {/foreach}
                </ul>

                <div style="text-align: center">
                    <div class="laypage-main">
                        {$page|raw}
                    </div>
                </div>

            </div>
        </div>
        <div class="layui-col-md4">
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
</div>

<div class="fly-footer">
    <p><a href=" /" target="_blank">Fly社区</a> 2019 &copy; <a href="/" target="_blank">lllllljjj.com 出品</a></p>
    <p>
        <a href=" /" target="_blank">付费计划</a>
        <a href=" y/" target="_blank">获取Fly社区模版</a>
        <a href=" 1/" target="_blank">微信公众号</a>
    </p>
</div>

</body>
<link href="https://vjs.zencdn.net/7.6.0/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src='https://vjs.zencdn.net/7.4.1/video.js'></script>
</html>
