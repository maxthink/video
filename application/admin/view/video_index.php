{include file="public/header" /}
<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-form toolbar">
                <div class="layui-form-item">
                    
                    <div class="layui-inline">
                        <div class="layui-input-inline mr0">
                            <input id="s_1" class="layui-input" type="text" placeholder="输入名字"/>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button id="btnSearch" class="layui-btn icon-btn"><i class="layui-icon">&#xe615;</i>搜索</button>
                        <button id="btnAdd" class="layui-btn icon-btn"><i class="layui-icon">&#xe654;</i>添加</button>
                    </div>
                </div>
            </div>

            <table class="layui-table" id="modelTable" lay-filter="modelTable"></table>
        </div>
    </div>
</div>

<!-- 表格操作列 -->
<script type="text/html" id="tableBar">
    <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-xs" lay-event="list">剧集</a>
</script>
 
<!-- 表格状态列 -->
<script type="text/html" id="tableState">
    <input type="checkbox" lay-filter="ckState" value="{{d.id}}" lay-skin="switch"
           lay-text="正常|锁定" {{d.lock==0 ?'checked':''}}/>
</script>
<!-- 表单弹窗 -->
<script type="text/html" id="modelObj">
    <form id="modelObjForm" lay-filter="modelObjForm" class="layui-form model-form">
        <input name="id" type="hidden"/>
        <div class="layui-form-item">
            <label class="layui-form-label">标题:</label>
            <div class="layui-input-block">
                <input name="title" placeholder="" type="text" class="layui-input" maxlength="200"
                       lay-verType="tips" lay-verify="required" required/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">名称:</label>
            <div class="layui-input-block">
                <input name="name" placeholder="" type="text" class="layui-input" maxlength="200"
                       lay-verType="tips" lay-verify="required" required/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">封面:</label>
            <div class="layui-input-block">
                <input name="cover" placeholder="" type="text" class="layui-input" maxlength="200"
                       lay-verType="tips" lay-verify="required" required/>
           </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">简介:</label>
            <div class="layui-input-block">
                <textarea name="intro" placeholder="" class="layui-textarea" lay-vertype="tips" lay-verify="required" required=""></textarea>
            </div>
        </div>
        <div class="layui-form-item text-right">
            <button class="layui-btn layui-btn-primary" type="button" tw-event="closePageDialog">取消</button>
            <button class="layui-btn" lay-filter="modelObjSubmit" lay-submit>保存</button>
        </div>
        
    </form>
</script>

<!-- 添加剧集 -->
<script type="text/html" id="modelObjList">
    <form id="modelObjListForm" lay-filter="modelObjListForm" class="layui-form model-form">
        <input name="video_id" type="hidden" id="video_id" />
        <div class="layui-form-item">
            <div class="layui-inline layui-col-md2">
                <input name="episode" placeholder="顺序" type="text" class="layui-input" maxlength="200"
                       lay-verType="tips" lay-verify="required" required style="width:10%" />
            </div>
            <div class="layui-inline layui-col-md8">
                <input name="resource" placeholder="地址" type="text" class="layui-input" maxlength="200"
                       lay-verType="tips" lay-verify="required" required style="width:85%" />
            </div>
            <div class="layui-inline layui-col-md2">
            <button class="layui-btn" lay-filter="modelObjSubmit" lay-submit>保存</button>
            </div>
        </div>
    </form>
    <table class="layui-table" id="modelListTable" lay-filter="modelListTable"></table>
</script>

<!-- 剧集 表格操作列 -->
<script type="text/html" id="listtableBar">
    <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-xs" lay-event="del">删除</a>
</script>


<!-- js部分 -->
<script type="text/javascript" src="/static/admin/libs/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js?v=311"></script>
<script>
    
    layui.use(['layer', 'form', 'table', 'util', 'admin', 'formSelects'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        var util = layui.util;
        var admin = layui.admin;
        var formSelects = layui.formSelects;

        // 渲染表格
        var insTb = table.render({
            elem: '#modelTable',
            url: '{:url('video/index')}',
            method: 'post', //如果无需自定义HTTP类型，可不加该参数
            page: true,
            cellMinWidth: 100,
            cols: [[
                {field: 'id', title: '编号', width:60},
                {field: 'host_id', title: '服务器id',width:100},
                {field: 'title', title: '标题'},
                {field: 'name', title: '名称'},
                {field: 'cover', title: '封面' },
                {templet: '#tableState', title: '状态',width:100},
                {align: 'center', toolbar: '#tableBar', title: '操作', width: 150}
            ]]
        });

        // 添加
        $('#btnAdd').click(function () {
            showEditModel();
        });

        // 搜索
        $('#btnSearch').click(function () {
            var search = new Object();
            search.s1 = $('#s_1').val();
            search.s2 = $('#s_2').val();
            search.s3 = $('#s_3').val();
            if (!search.s1 && !search.s2 && !search.s3 ) {
                layer.msg('没有搜索条件', {icon: 2});
                search = new Object();
            }
            insTb.reload({where: search ,page: {page: 1 } });            
        });

        // 工具条点击事件
        table.on('tool(modelTable)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;
            if (layEvent === 'edit') { // 修改
                showEditModel(data);
            } else if (layEvent === 'list') { // 添加剧集
                top.layui.index.openTab({
                    title: '剧集编辑',
                    url: "{:url('videoitem/index')}"+'?vid='+data.id
                });
            } else if (layEvent === 'show') { // 预览
                window.open('{:url('index/video')}/'+data.id,'_blank');  
            }
        });

        // 显示表单弹窗
        function showEditModel(M) {
            admin.open({
                type: 1,
		        area: ['800px','500px'],
                title: (M ? '修改' : '添加') + '套餐',
                content: $('#modelObj').html(),
                success: function (layero, dIndex) {
                    $(layero).children('.layui-layer-content').css('overflow', 'visible');
                    var url = M ? '{:url('video/update')}' : '{:url('video/add')}';
                    // 回显数据
                    if (M) {
                        //$('input[name="username"]').attr('readonly', 'readonly');
                        M.long = M.long/60;
                        M.price = M.price/100;
                        form.val('modelObjForm', M);
                    } else {
                        form.render('radio');
                    }

                    // 表单提交事件
                    form.on('submit(modelObjSubmit)', function (data) {
                        //data.field.roleIds = formSelects.value('roleId', 'valStr');
                        layer.load(2);
                        $.post(url, data.field, function (res) {
                            layer.closeAll('loading');
                            if (res.code == 0) {
                                layer.close(dIndex);
                                layer.msg(res.msg, {icon: 1});
                                insTb.reload();
                            } else if(res.code == 2) {
                                top.location.href = location.href;
                            } else {
                                layer.msg(res.msg, {icon: 2});
                            }
                        }, 'json');
                        return false;
                    });
                }
            });
        }
        
        // 修改数据锁定状态
        form.on('switch(ckState)', function (obj) {
            layer.load(2);
            
            $.post('{:url('video/lock')}', {
                Id: obj.elem.value,
                state: obj.elem.checked ? 0 : 1
            }, function (res) {
                layer.closeAll('loading');
                if ( res.code == 1 ) {
                    layer.msg(res.msg, {icon: 2});
                } else if( res.code == 0 ) {
                    layer.msg(res.msg, {icon: 1});
                    $(obj.elem).prop('checked', obj.elem.checked);
                    form.render('checkbox');
                }
            }, 'json');
        });

        //添加剧集
        function addItem(video_id)
        {
            $("#video_id").val(video_id);

            // 渲染表格
            var listTb = table.render({
                elem: '#modelListTable',
                url: '{:url('video/itemlist')}',
                method: 'post', //如果无需自定义HTTP类型，可不加该参数
                page: true,
                cellMinWidth: 100,
                cols: [[
                    {field: 'id', title: '编号', width:60},
                    {field: 'episode', title: '序号',width:60},
                    {field: 'resource', title: 'url'},
                    {align: 'center', toolbar: '#listtableBar', title: '操作', width: 150}
                ]]
            });

            admin.open({
                type: 1,
                area: ['800px','600px'],
                title: '子集添加',
                content: $('#modelObjList').html(),
                success: function (layero, dIndex) {
                    $(layero).children('.layui-layer-content').css('overflow', 'visible');
                    
                    if (M) {
                        form.val('modelObjListForm', M);
                    } else {
                        form.render('radio');
                    }

                    // 表单提交事件
                    form.on('submit(modelObjListForm)', function (data) {

                        layer.load(2);
                        $.post('{:url('video/itemupdate')}', data.field, function (res) {
                            layer.closeAll('loading');
                            if (res.code == 0) {
                                layer.close(dIndex);
                                layer.msg(res.msg, {icon: 1});
                                insTb.reload();
                            } else if(res.code == 2) {
                                top.location.href = location.href;
                            } else {
                                layer.msg(res.msg, {icon: 2});
                            }
                        }, 'json');
                        return false;
                    });
                }
            });

        }

    });
</script>

</body>
</html>
