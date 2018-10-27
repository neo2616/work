@extends('admin/common/master')
@section('title','权限列表')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
	<div class="my-btn-box">
		<span class="fl">
			<button class="layui-btn btn-add btn-default" id="btn-add"><i class="layui-icon">&#xe654;</i>添加权限</button>
			&nbsp;&nbsp;&nbsp;添加权限之后,需要刷新一下后台才会更新的哦 !
		</span>
	</div>
</blockquote>
	<div class="layui-collapse">
		<div class="layui-colla-item">
			<h2 class="layui-colla-title">展开权限列表</h2>
			<div class="layui-colla-content layui-show">
				<div class="layui-form" id="table-list">
					<table class="layui-table" lay-skin="line" lay-size="sm">
						<colgroup>
							<col width="50">
							<col width="200">
							<col width="200">
							<col width="200">
							<col>
							<col width="180">
							<col width="150">
						</colgroup>
						<thead>
							<tr>
								<th>ID</th>
								<th>权限名称</th>
								<th>控制器</th>
								<th>方法</th>
								<th>路由</th>
								<th>修改时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tree as $vv)
							<tr>
								<td>{{$vv['ps_id']}}</td>
								<td>{{str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$vv['ps_level']).$vv['ps_name']}}</td>
								<td>{{$vv['ps_c']}}</td>
								<td>{{$vv['ps_a']}}</td>
								<td>{{$vv['ps_route']}}</td>
								<td>{{$vv['created_at']}}</td>
								<td>
									<div class="layui-inline">
										<button class="layui-btn layui-btn-mini layui-btn-normal  go-btn" data-id="{{$vv['ps_id']}}" ><i class="layui-icon">&#xe642;</i>编辑</button>
										<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$vv['ps_id']}}" ><i class="layui-icon">&#xe640;</i>删除</button>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('my-js')
<script>
	layui.use(['element','layer'], function(){
	    var element = layui.element,
	    	layer = layui.layer,
	  		$ = layui.jquery;
	  	
	  	//添加权限
	  	$('#btn-add').click(function(){
	
		  	var index = layer.open({
			      type: 2,
			      title: '添加权限',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      content: '{{url("/permission/getpermissionview")}}'
			});
			layer.full(index);
	  	});

	  	//删除权限
	  	$('tbody').on('click','.del-btn',function(){
	  		var id = $(this).attr('data-id');
	  		var _this = $(this);
	  		//ajax
	  		layer.confirm('确定需要删除么?',function(){
	  			$.ajax({
		  			url:'{{url("/permission/delpermission")}}',
		  			data:{id:id},
		  			type:'post',
		  			dataType:'json',
		  			headers:{
		  				'X-CSRF-TOKEN':'{{csrf_token()}}'
		  			},
		  			success:function(data){
		  				if(data.code == 1){
		  					layer.msg('删除成功',function(){
		  						_this.parent().parent().parent().remove();
		  					});
		  				}else{
		  					layer.msg('此物有子孙不可删除!');
		  				}
		  			}
		  		});
	  		})
	  		
	  		//alert(id);
	  	});

	  	//编辑权限
	  	$('tbody').on('click','.go-btn',function(){
	  		var id = $(this).attr('data-id');
	  		var index = layer.open({
			      type: 2,
			      title: '添加权限',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      content: '{{url("/permission/getstorepermissionview")}}' + '/' +id
			});
			layer.full(index);
	  		//alert(id);
	  	});
	});
</script>
@endsection