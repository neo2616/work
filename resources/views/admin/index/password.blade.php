@extends('admin/common/master')
@section('title','修改密码')
@section('class','body')
<style type="text/css">
	.layui-form {margin: 10px 40px; width: 80%;}
</style>
@section('content')
<blockquote class="layui-elem-quote layui-text">
	如果你的密码不记得了请联系管理员重置
</blockquote>
<form class="layui-form layui-form-pane">
	<div class="layui-form-item">
		<label class="layui-form-label">旧密码</label>
		<div class="layui-input-block">
			<input type="text" name="oldpwd"  placeholder="请输入旧密码"  class="layui-input pwd">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">新密码</label>
		<div class="layui-input-block">
			<input type="password" name="newpwd"  placeholder="请输入新密码"  class="layui-input pwd">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">确认密码</label>
		<div class="layui-input-block">
			<input type="password" name="pwdconfirm"  placeholder="请确认密码"  class="layui-input pwd">
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button type="button" class="layui-btn" lay-submit lay-filter="demo1">立即提交</button>
			<button type="reset" class="layui-btn layui-btn-primary">重置</button>
	    </div>
	</div>
</form>
@endsection
@section('my-js')
<script>
    layui.use(['form', 'layedit'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
            		$ = layui.$;

        //监听提交
        form.on('submit(demo1)', function(data){
        	var shuju = data.field;
            //ajax
            $.ajax({
            	url:'{{url("/password")}}',
            	data:shuju,
            	type:'post',
            	dataType:'json',
            	headers:{
            		'X-CSRF-TOKEN':'{{csrf_token()}}'
            	},
            	success:function(data){
            		if(data.code == 1){
            			layer.alert('修改成功!',function(){
                            parent.window.location.href = '{{url("/login")}}';		//重新登录
                        });
            		}else if(data.code == 0){
            			layer.msg(data.error);
            		}
            	}
            })
            return false;
        });


    });
</script>
@endsection