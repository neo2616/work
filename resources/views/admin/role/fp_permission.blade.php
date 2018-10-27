@extends('admin/common/master')
@section('title','权限分配')
@section('class','body')
@section('content')
<link rel="stylesheet" type="text/css" href="/admin/h-ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/h-ui/static/h-ui.admin/css/H-ui.admin.css" />
<blockquote class="layui-elem-quote layui-text">
	权限分配
</blockquote>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<input type="hidden" name="role_id" value="{{$info->role_id}}">
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-1">用户组：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  readonly="readonly"  name="role_name" value="{{$info->role_name}}">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-1">网站权限：</label>
			<div class="formControls col-xs-8 col-sm-9">
				@foreach($permission_a as $v)
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="{{$v->ps_id}}" name="quanxian[]" 
							@if(in_array($v->ps_id,$ps_ids_arr))
								checked
							@endif
							>
							{{$v->ps_name}}</label>
					</dt>
					<dd>
						@foreach($permission_b as $vv)
						@if($vv->ps_pid == $v->ps_id)
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="{{$vv->ps_id}}" name="quanxian[]" 
									@if(in_array($vv->ps_id,$ps_ids_arr))
										checked
									@endif
									>
									{{$vv->ps_name}}</label>
							</dt>
							<dd>
								@foreach($permission_c as $vvv)
								@if($vvv->ps_pid == $vv->ps_id)
								<label class="">
									<input type="checkbox" value="{{$vvv->ps_id}}" name="quanxian[]" 
									@if(in_array($vvv->ps_id,$ps_ids_arr))
										checked
									@endif
									>
									{{$vvv->ps_name}}</label>
								@endif
								@endforeach
							</dd>
						</dl>
						@endif
						@endforeach
					</dd>
				</dl>
				@endforeach
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-10 col-xs-offset-4 col-sm-offset-2">
				<button type="submit" class="btn btn-success" style="width: 100px;"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
@endsection
@section('my-js')
<script type="text/javascript">
    layui.use(['form'], function () {
        // 操作对象
        var form = layui.form
                , $ = layui.jquery;

        // you code ...
        $(function(){
			$(".permission-list dt input:checkbox").click(function(){
				$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
			});
			$(".permission-list2 dd input:checkbox").click(function(){
				var l =$(this).parent().parent().find("input:checked").length;
				var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
				if($(this).prop("checked")){
					$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
					$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
				}
				else{
					if(l==0){
						$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
					}
					if(l2==0){
						$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
					}
				}
			});
			
		});

        
        //监听
        $('#form-admin-role-add').submit(function(evt){
        	evt.preventDefault();
        	var shuju = $(this).serialize();
        	//至少一个被选中
        	//debugger;
	        if($('input[type="checkbox"]:checked').length < 1){
	        	layer.msg('至少一个被选中',{icon:5});
	        	return false;
	        }
        	//ajax
        	$.ajax({
        		url:'{{url("/role/fp_savepermission")}}',
        		data:shuju,
        		type:'post',
        		dataType:'json',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(msg){
        			if(msg.code == 1){
        				layer.alert('权限分配成功',function(){
        					parent.window.location.href = parent.window.location.href;
        				});
        			}else{
        				layer.alert('失败');
        			}
        		}
        	})
        	//console.log(shuju);
        })
    });
</script>
@endsection