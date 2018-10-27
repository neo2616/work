@extends('admin/common/master')
@section('title','用户密码重置')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
    如果 {{$manager->mg_name}} 忘记了登录密码使用超级用户直接可以把密码重置了
</blockquote>

<form class="layui-form">
	<input type="hidden" name="mg_id" value="{{$manager->mg_id}}">
	<div class="layui-form-item">
        <label class="layui-form-label">用户名称</label>
        <div class="layui-input-block">
            <input type="text" name="mg_name" lay-verify="title" autocomplete="off" value="{{$manager->mg_name}}" readonly class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">输入新密码</label>
        <div class="layui-input-block">
            <input type="text" name="password" lay-verify="title" autocomplete="off" placeholder="输入新密码" class="layui-input" value="">
        </div>
    </div>
    <br>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" type="submit" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@endsection
@section('my-js')
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,$ = layui.$;

        //监听提交
        form.on('submit(demo1)', function(data){
        	var shuju = data.field;
        	var id = $('input[type="hidden"]').val();
        	//ajax
        	if($('input[name="password"]').val() == ''){
        		layer.alert('密码不可以为空!');
        		return false;
        	}
        	//debugger;
        	$.ajax({
        		url:'{{url("/manager/resetuser")}}' + '/' +id,
        		data:shuju,
        		dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},	
        		success:function(data){
        			if(data.code == 1){
        				 parent.window.location.href = parent.window.location.href;
        			}else{
        				layer.alert('操作失败!');
        			}
        		}
        	})
 			
            return false;
        });


    });
</script>
@endsection