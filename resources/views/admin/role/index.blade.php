@extends('admin/common/master')
@section('title','用户组列表')
@section('class','body')
@section('content')
<div class="page-content-wrap">
	<form class="layui-form" action="">
		<div class="layui-form-item">
			<span class="fl">
		        <a class="layui-btn btn-add btn-default" id="btn-add"><i class="layui-icon">&#xe654;</i>添加组管理</a>
		        <a class="layui-btn btn-add btn-default" id="btn-refresh"><i class="layui-icon">&#x1002;</i></a>
		    </span>
			<!-- <span class="fr">
		        <span class="layui-form-label">搜索条件：</span>
		        <div class="layui-input-inline">
		            <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input">
		        </div>
		        <button class="layui-btn mgl-20">查询</button>
		    </span> -->
		</div>
	</form>
	<div class="layui-form" id="table-list">
		<table class="layui-table" lay-even lay-skin="line" >
			<colgroup>
				<col width="50">
				<col >
				<col >
				<col >
				<col >
				<col width="200">
			</colgroup>
			<thead>
				<tr>
					<th>ID</th>
					<th>用户名称</th>
					<th>权限IDS</th>
					<th>控制器&方法</th>
					<th>发布时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($role as $v)
				<tr>
					<td>{{$v->role_id}}</td>
					<td>{{$v->role_name}}</td>
					<td>{{$v->ps_ids}}</td>
					<td>{{$v->ps_ca}}</td>
					<td>{{$v->created_at}}</td>
					<td>
						<div class="layui-inline">
							<button class="layui-btn layui-btn-mini layui-btn-warm permission" data-id="{{$v->role_id}}"><i class="layui-icon">&#xe600;</i>分配权限</button>
							<button class="layui-btn layui-btn-mini layui-btn-danger role_del" data-id="{{$v->role_id}}"><i class="layui-icon">&#xe640;</i>删除</button>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['layer'],function(){
		var $ = layui.jquery,
			layer = layui.layer;


		//删除功能
		$('tbody').on('click','.role_del',function(){
			var _this = $(this);
			var id = $(this).attr('data-id');
			//ajax

			var index = layer.confirm('确认要删除么?',function(){
							$.ajax({
								url:'{{url("role/del")}}',
								data:{id:id},
								type:'post',
								dataType:'json',
								headers:{
									'X-CSRF-TOKEN':'{{csrf_token()}}'
								},
								success:function(data){
									//debugger;
									if(data.code == 1){
										_this.parent().parent().parent().remove();
										layer.close(index);
									}else{
										layer.alert('删除失败,请重新删除!');
									}
								}
							})
						});
			console.log(id);
		})

		//分配权限
		$('tbody').on('click','.permission',function(){
			var id = $(this).attr('data-id');
			var index =	layer.open({
					type:2,
					title:'警告: 只有管理者才看进行修改,你看看就行了',
					shadeClose: true,
					shade:[0.5],
					maxmin: true, //开启最大化最小化按钮
					content: '{{url("/role/fp_permission")}}' + '/' + id
				});
			layer.full(index);
			console.log(id);
		})
		//添加用户组
		$('#btn-add').click(function(){
			var index =	layer.open({
					type:2,
					title:'添加用户组',
					shadeClose: true,
					shade:[0.5],
					maxmin: true, //开启最大化最小化按钮
					content: '{{url("/role/getroleview")}}'
				});
				layer.full(index);
		})	

		//刷新当前页面
		$('#btn-refresh').click(function(){
			window.location.href = '{{url("role/index")}}';
		});
	})
</script>
@endsection