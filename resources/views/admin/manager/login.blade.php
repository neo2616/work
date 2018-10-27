@extends('admin/common/master')
@section('title','登录')
@section('class','login-body body')
@section('content')
<div class="login-box">
    <form class="layui-form layui-form-pane" method="get" action="">
        <div class="layui-form-item">
            @if($error == true)
            	<h3>{{$error}}</h3>
            @else
            	<h3>推广后台系统</h3>
            @endif
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">用户名：</label>

            <div class="layui-input-inline">
                <input type="text" name="mg_name" class="layui-input" placeholder="用户名"
                       autocomplete="on" maxlength="20"/>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">密码：</label>

            <div class="layui-input-inline">
                <input type="password" name="password" class="layui-input" placeholder="密码"
                       maxlength="20"/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">验证码：</label>

            <div class="layui-input-inline">
                <input type="number" name="code" class="layui-input" placeholder="验证码" maxlength="4"/><img
                    src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}?' +Math.random();">
            </div>
        </div>
        <div class="layui-form-item">
            <button type="reset" class="layui-btn layui-btn-danger btn-reset">重置</button>
            <button type="button" class="layui-btn btn-submit" lay-submit="" lay-filter="sub">立即登录</button>
        </div>
    </form>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','layer'],function(){
		//操作对象
		var form = layui.form,
			layer = layui.layer,
			$ = layui.jquery;

		//提交监听
		form.on('submit(sub)',function(data){
			var shuju = data.field;
			//ajax
			$.ajax({
				url:'{{url("/store_login")}}',
				data:shuju,
				dataType:'json',
				type:'post',
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						window.location.href = '{{url("index/index")}}';
					}else if(msg.code == 0){
						layer.msg(msg.error);
					}
					console.log('cuccess');
				},
				error:function(jqXHR, textStatus, errorThrown){
					var code = jqXHR.responseJSON.code ? jqXHR.responseJSON.code : "";
					var password = jqXHR.responseJSON.password ? jqXHR.responseJSON.password : "";
					var mg_name = jqXHR.responseJSON.mg_name ? jqXHR.responseJSON.mg_name : "";
					layer.msg(mg_name+code+password);
					console.log(jqXHR);
				}
			});
			return false;
		});
	})
</script>
@endsection