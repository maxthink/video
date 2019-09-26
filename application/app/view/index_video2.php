<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>test</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="keywords" content="电影天堂_电影下载">
<meta name="description" content="电影天堂_最新电影_高清电影_在线观看_在线视频_在线看电影">
<link rel="stylesheet" href="/static/index/layui.css">
<link rel="stylesheet" href="/static/index/style.css">
</head>
<body>

<div class="fly-header layui-bg-black ">
    <div class="layui-container ">
        <a class="fly-logo" href="/"> 天堂电影院 </a>
        <ul class="layui-nav fly-nav layui-hide-xs">
            <li class="layui-nav-item layui-this"><a href="/" target="_blank" >推荐站一</a> </li>
            <li class="layui-nav-item"> <a href="/" target="_blank" >推荐站二</a> </li>
            <li class="layui-nav-item"> <a href="http://wm/" target="_blank">推荐站三</a> </li>
        </ul>
    </div>
</div> 

<div class="fly-column layui-hide-xs">
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

<div class="fly-case-header">
    <div class="layui-row layui-col-space15">
        
        <div class="layui-col-md8 content detail">
            <div class="detail-box">
                
                <div id='my-video' style="width:100%; height:auto;" ></div>

                <h1>{$m.name}{$m.desc}</h1>
                
                <div class="detail-about">
                    <div class="fly-detail-user">
                        <a href="../user/home.html" class="fly-link">
                            <cite>贤心</cite>
                        </a>
                        <span>{$m.showtime}</span>
                    </div>
                    <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
                        <span style="padding-right: 10px; color: #FF7200">{$m.type}</span>  
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <dl class="fly-panel fly-list-one">
                <dt class="fly-panel-title">本周热议</dt>
                <div id="play_list" class="mod_episodes_numbers"></div>
            </dl>

            <div class="fly-panel">
                <div class="fly-panel-title">
                    adadadad
                </div>
                <div class="fly-panel-main">
                    <a href="#" target="_blank" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">adadadad</a>
                </div>
            </div>

            <div class="fly-panel" style="padding: 20px 0; text-align: center;">

                <p style="position: relative; color: #666;">adadadadad</p>
            </div>

        </div>
    </div>
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8 content detail">
            <div class="fly-panel detail-box">
                 

                 
                <div class="fly-detail-info">

                    <span class="fly-list-nums"> 
                        <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> 66</a>
                        <i class="iconfont" title="人气">&#xe60b;</i> 99999
                    </span>
                </div>
                <div class="detail-about">

                    <div class="fly-detail-user">
                        <a href="../user/home.html" class="fly-link">
                            <cite>贤心</cite>
                            <i class="iconfont icon-renzheng" title="认证信息：{{ rows.user.approve }}"></i>
                            <i class="layui-badge fly-badge-vip">VIP3</i>
                        </a>
                        <span>2017-11-30</span>
                    </div>
                    <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
                        <span style="padding-right: 10px; color: #FF7200">悬赏：60飞吻</span>  
                    </div>
                </div>
                 
            </div>

            <div class="fly-panel detail-box" id="flyReply">
                <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                    <legend>回帖</legend>
                </fieldset>

                <ul class="jieda" id="jieda">
                    <li data-id="111" class="jieda-daan">
                    </li>
                    <li data-id="111">
                    </li>
                </ul>

                <div class="layui-form layui-form-pane">
                    <form action="/jie/reply/" method="post">
                        <div class="layui-form-item layui-form-text">
                            <a name="comment"></a>
                            <div class="layui-input-block">
                                <textarea id="L_content" name="content" required lay-verify="required" placeholder="请输入内容"  class="layui-textarea fly-editor" style="height: 150px;"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <input type="hidden" name="jid" value="123">
                            <button class="layui-btn" lay-filter="*" lay-submit>提交回复</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <dl class="fly-panel fly-list-one">
                <dt class="fly-panel-title">本周热议</dt>
                <dd>
                    <a href="">基于 layui 的极简社区页面模版</a>
                    <span><i class="iconfont icon-pinglun1"></i> 16</span>
                </dd>
                <dd>
                    <a href="">基于 layui 的极简社区页面模版</a>
                    <span><i class="iconfont icon-pinglun1"></i> 16</span>
                </dd>
                <dd>
                    <a href="">基于 layui 的极简社区页面模版</a>
                    <span><i class="iconfont icon-pinglun1"></i> 16</span>
                </dd>

                <dd>
                    <a href="">基于 layui 的极简社区页面模版</a>
                    <span><i class="iconfont icon-pinglun1"></i> 16</span>
                </dd>

                <!-- 无数据时 -->
                <!--
                <div class="fly-none">没有相关数据</div>
                -->
            </dl>

            <div class="fly-panel">
                <div class="fly-panel-title">
                    这里可作为广告区域
                </div>
                <div class="fly-panel-main">
                    <a href="http://layim.layui.com/?from=fly" target="_blank" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">LayIM 3.0 - layui 旗舰之作</a>
                </div>
            </div>

            <div class="fly-panel" style="padding: 20px 0; text-align: center;">

                <p style="position: relative; color: #666;">微信扫码关注 layui 公众号</p>
            </div>

        </div>
    </div>
</div>

<div class="fly-footer">
    <p><a href="http://fly.layui.com/" target="_blank">Fly社区</a> 2017 &copy; <a href="http://www.layui.com/" target="_blank">layui.com 出品</a></p>
    <p>
        <a href="http://fly.layui.com/jie/3147/" target="_blank">付费计划</a>
        <a href="http://www.layui.com/template/fly/" target="_blank">获取Fly社区模版</a>
        <a href="http://fly.layui.com/jie/2461/" target="_blank">微信公众号</a>
    </p>
</div>

<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script src="http://imgcache.qq.com/open/qcloud/video/vcplayer/TcPlayer-2.3.2.js"></script>
<script type="text/javascript">
     
    var video = <?php echo $m['res']; ?>;

    //var videos = JSON.parse(video);
    var playlist = '<ul>';
    $.each(video, function (key, val) {
        playlist += '<li class="item" ><a href="' + val.res + '" >' + val.name + "</a></li>";
    })
    playlist += '</ul>';
    $("#play_list").append(playlist);

    $('.playres').on('click', function () {
        //alert($(this).attr('data'));
        $('#my-video>source').attr('src', $(this).attr('data'));
    })
    
    poster='/static/index/pin.jpg'
    var playOrder = 0;
    
    (function(){
        var player = new TcPlayer('my-video', {
            "m3u8": $('.resource>li:eq('+playOrder+')>p').attr('data'), //请替换成实际可用的播放地址
            //"autoplay" : true,      //iOS 下 safari 浏览器，以及大部分移动端浏览器是不开放视频自动播放这个能力的
            poster : {"style":"stretch", "src":"/static/index/pin.jpg"} ,
            height:350,
            listener: function (msg) {
                console.log('listener',msg);
                if( msg.type == 'error'){
                    window.setTimeout(function(){
                        player.load();//进行重连
                    },5000);
                }
                if( msg.type === 'ended' ){ //播放完毕
                    this.src = $('.resource>li:eq('+playOrder+')>p').attr('data')
                }
            }
        });
        
        //player.src= $('.resource>li:eq('+playOrder+')>p').attr('data') ;
        //player.play();
    })();
    
var sub = document.getElementById("my-video");
if (/msie/i.test(navigator.userAgent)) //IE
{
    console.log('ddd');
    sub.fireEvent("onclick");
} else {
    console.log('fff');
    var e = document.createEvent('MouseEvent');
    e.initEvent('click', false, false);
    try{
        sub.dispatchEvent(e);
    }catch{
        console.log('eee');
    }
}

</script>
</body>
</html>