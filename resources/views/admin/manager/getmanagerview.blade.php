@extends('admin/common/master')
@section('title','用户添加')
@section('class','body')
@section('content')
<form class="layui-form layui-form-pane" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名称</label>
        <div class="layui-input-block">
            <input type="text" name="mg_name" autocomplete="off" placeholder="输入用户名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请记住你的密码</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">用户组</label>
        <div class="layui-input-block">
            <select name="role_id" lay-filter="aihao">
                @foreach($roleidAndRolename as $k=>$v)
                    <option value="{{$k}}">{{$v}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item" pane="">
        <label class="layui-form-label">开关</label>
        <div class="layui-input-block">
            <input type="checkbox" checked="" name="status" lay-skin="switch" lay-filter="switchTest" title="开关">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">文本域</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" class="layui-textarea" name="desc"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <button class="layui-btn layui-btn" lay-submit lay-filter="demo1">立即提交</button>
		<button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</form>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','layer'],function(){
		var form = layui.form,
			layer = layui.layer,
			$ = layui.$;

		//监听指定开关
        form.on('switch(switchTest)', function(data){
            $(data.elem).attr('type','hidden').val(this.checked?'on':'off');
            layer.msg('当前用户状态是：'+ (this.checked ? '开启' : '关闭'), {
                offset: '150px'
            });
        });
        //监听提交
        form.on('submit(demo1)', function(data){
            var shuju = data.field;
            //ajax
            $.ajax({
                url:'{{url("/manager/storemanager")}}',
                data:shuju,
                type:'post',
                dataType:'json',
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                success:function(msg){
                    if(msg.code == 1){
                        layer.alert('添加成功!',function(){
                            parent.window.location.href = parent.window.location.href;
                        });
                    }else if(msg.code == 0){
                        layer.alert(msg.error);
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    var mg_name = jqXHR.responseJSON.mg_name ? jqXHR.responseJSON.mg_name : '';
                    var password = jqXHR.responseJSON.password ? jqXHR.responseJSON.password : '';
                    layer.alert(mg_name+password);
                    console.log(jqXHR);
                }
            });
            return false;
        });
	});
</script>
@endsection