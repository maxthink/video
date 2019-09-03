<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录</title>
    <link rel="stylesheet" href="/static/admin/libs/layui/css/layui.css"/>
    <link rel="stylesheet" href="/static/admin/css/login.css?v=311">
    <script>
        if (window != top) {
            top.location.replace(location.href);
        }
    </script>
</head>
<body>
<div class="login-wrapper">
    <div class="login-header">
        <img src="/static/admin/images/logo.png"> ThinkWeb后台开发框架
    </div>
    <div class="login-body">
        <div class="layui-card">
            <div class="layui-card-header">
                <i class="layui-icon layui-icon-engine"></i>&nbsp;&nbsp;用户登录
            </div>
            <form class="layui-card-body layui-form layui-form-pane">
                <div class="layui-form-item">
                    <label class="layui-form-label"><i class="layui-icon layui-icon-username"></i></label>
                    <div class="layui-input-block">
                        <input name="username" type="text" placeholder="账号" class="layui-input"
                               lay-verify="required" required/>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><i class="layui-icon layui-icon-password"></i></label>
                    <div class="layui-input-block">
                        <input name="password" type="password" placeholder="密码" class="layui-input"
                               lay-verify="required" required/>
                    </div>
                </div>
                <!--div class="layui-form-item">
                    <label class="layui-form-label"><i class="layui-icon layui-icon-vercode"></i></label>
                    <div class="layui-input-block">
                        <div class="layui-row inline-block">
                            <div class="layui-col-xs7">
                                <input name="code" type="text" placeholder="验证码" class="layui-input"
                                       lay-verify="required" required/>
                            </div>
                            <div class="layui-col-xs5" style="padding-left: 10px;">
                                <img class="login-captcha" src="https://www.oschina.net/action/user/captcha">
                            </div>
                        </div>
                    </div>
                </div-->
                <div class="layui-form-item">
                    <!--a href="javascript:;" class="layui-link">帐号注册</a-->
                    <a href="javascript:;" class="layui-link pull-right">忘记密码？</a>
                </div>
                <div class="layui-form-item">
                    <button lay-filter="login-submit" class="layui-btn layui-btn-fluid" lay-submit>登 录</button>
                </div>
                <!--div class="layui-form-item login-other">
                    <label>第三方登录</label>
                    <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
                    <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
                    <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>
                </div-->
            </form>
        </div>
    </div>

    <div class="login-footer">
        <p>© 2019 thinkweb.vip 版权所有</p>
        <!--p>
            <span><a href="https://thinkweb.vip" target="_blank">获取授权</a></span>
            <span><a href="https://thinkweb.vip/doc/" target="_blank">开发文档</a></span>
            <span><a href="https://demo.thinkweb.vip/spa/" target="_blank">单页面版</a></span>
        </p-->
    </div>
</div>

<script type="text/javascript" src="/static/admin/libs/layui/layui.js"></script>
<script>
    layui.use(['layer', 'form'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;

        // 表单提交
        form.on('submit(login-submit)', function (obj) {
    	    $.ajax({
        		url: '{:url('login/login')}',
        		method:'post',
        		data: obj.field,
        		success: function(res){
                    layer.msg(res.msg);
        		    if(res.code === 0){
        			    location.href= '/admin/index';
        		    }
        		}
    	    });
            return false;
        });

        // 图形验证码
        $('.login-captcha').click(function () {
            this.src = this.src + '?t=' + (new Date).getTime();
        });
        
        
    });
    
</script>
</body>
</html>