@extends('admin/common/master')
@section('title','添加用户组')
@section('class','body')
@section('content')
<form class="layui-form layui-form-pane" >
    <div class="layui-form-item">
        <label class="layui-form-label">用户组名称</label>
        <div class="layui-input-block">
            <input type="text" name="role_name" autocomplete="off" placeholder="输入用户组"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</form>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','layer'],function(){

		var form = layui.form,
			layer = layui.layer,
			$ = layui.jquery;

		//表单提交
		form.on('submit(demo1)',function(data){
			var shuju = data.field;
			//ajax
			$.ajax({
				url:'{{url("/role/storeRole")}}',
				type:'post',
				dataType:'json',
				data:shuju,
				headers:{
					'X-CSRF-TOKEN':'{{csrf_token()}}'
				},
				success:function(msg){
					if(msg.code == 1){
						layer.msg('添加用户组成功!',function(){
							parent.window.location.href = parent.window.location.href;
						})
					}else{
						layer.msg(msg.error);
					}
				},
				error:function(jqXHR, textStatus, errorThrown){
					var role_name = jqXHR.responseJSON.role_name[0] ? jqXHR.responseJSON.role_name[0] :'';
					//console.log(jqXHR.responseJSON.role_name[0]);
					layer.msg(role_name);
				}
			});
			return false;
		});
	});
</script>
@endsection