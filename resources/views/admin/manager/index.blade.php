@extends('admin/common/master')
@section('title','管理员列表')
@section('class','body')
@section('content')
<form class="layui-form" id="form">
	<div class="layui-form-item">
		<span class="fl">
	        <a class="layui-btn btn-add btn-default" id="btn-add"><i class="layui-icon">&#xe654;</i>添加用户</a>
	        <a class="layui-btn btn-add btn-default" id="btn-refresh"><i class="layui-icon">&#x1002;</i></a>
	    </span>
		<span class="fr">
	        <span class="layui-form-label">搜索条件：</span>
	        <div class="layui-input-inline">
	            <input type="keyword" autocomplete="off" placeholder="请输入搜索条件" class="layui-input">
	        </div>
	        <button class="layui-btn mgl-20" id="submit">查询</button>
	    </span>
	</div>
</form>
<input type="hidden" name="conut" value="{{$count}}">
<div class="layui-form" id="table-list">
	<table class="layui-table" lay-even lay-skin="line">
		<colgroup>
			<col width="50">
			<col width="100">
			<col width="150">
			<col>
			<col>
			<col>
			<col width="200">
		</colgroup>
		<thead>
			<tr>
				<th>ID</th>
				<th>用户名称</th>
				<th>用户组</th>
				<th>用户密码重置</th>
				<th>IP</th>
				<th>最后登录时间</th>
				<th>创建时间</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<!-- 内容填充区 -->
		</tbody>
	</table>
	<span class="fr">
		<div id="demo0">
			<!-- 分页 -->
		</div>
	</span>
</div>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['laypage','layer'],function(){
		var laypage = layui.laypage
  			,layer = layui.layer,
  				$ = layui.jquery;
  		var count = $('input[type="hidden"]').val();
  		//分页
  		laypage.render({
		   elem: 'demo0'
		   ,count: count //数据总数
		   //,limits:[5,12,24,36,48]  // 自定义 Array 每页显示多少条 默认 [10, 20, 30, 40, 50]
		   ,limit:13                //默认单页显示多少条
		   ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']  //skip 跳转到多少页
		   ,jump :function(obj, first){
				$.ajax({
					url:'{{url("/manager/ajax")}}',
					data:{page:obj.curr,limit:obj.limit},
					type:'post',
					dataType:'json',
					headers:{
						'X-CSRF-TOKEN':'{{csrf_token()}}'
					},
					success:function(data){
						$('tbody').html('');
						for(var i = 0; i < data.length; i++) {
							var item = _create_item(data[i]);
							$('tbody').append(item);
							//debugger;
						}
						//console.log(data);
					}
				})
		   }
		});

  		//用户密码修改
  		$('tbody').on('click','.pwd-reset',function(){
  			var id = $(this).attr('data-id');
  			//ajax

  			layer.open({
		      type: 2,
		      title: '修改用户的密码',
		      shadeClose: true,
		      shade: [0.5],
		      maxmin: true, //开启最大化最小化按钮
		      area: ['500px', '350px'],
		      content: '{{url("/manager/resetuser")}}' + '/' +id
		    });
  		})

  		//修改状态
  		$('tbody').on('click','.table-list-status',function(){
  			var id = $(this).attr('data-id');
  			var _this = $(this);
	  		var index = layer.confirm('要修改当前用户状态么',function(){
	  				//ajax
	  				$.ajax({
	  					url:'{{url("/manager/setstatus")}}',
	  					data:{id:id},
	  					dataType:'json',
	  					type:'post',
	  					headers:{
	  						'X-CSRF-TOKEN':'{{csrf_token()}}'
	  					},
	  					success:function(data){
	  						if(data.code ==1){	
	  							//debugger;
	  							_this.html(data.status);
	  							console.log(data.status);
	  							layer.close(index);
	  						}
	  					}
	  				})
	  				//alert(id);
	  			})
  		});
  		//监听编辑
  		$('tbody').on('click','.go-btn',function(){
  			var id = $(this).attr('data-id');
  			var index = layer.open({
		      type: 2,
		      title: '编辑用户',
		      shadeClose: true,
		      shade: false,
		      maxmin: true, //开启最大化最小化按钮
		      content: '{{url("/manager/geteditmanagerview/")}}' + '/' +id
		    });
  			layer.full(index);
  			//alert(id);
  		});
  		//监听删除
  		$('tbody').on('click','.del-btn',function(){
  			var id = $(this).attr('data-id');
  			var _this = $(this);
  			//ajax
	  		var index =	layer.confirm('确认删除ID: '+id+' 用户么?',function(){
  				$.ajax({
	  				url:'{{url("/manager/delmanager")}}',
	  				data:{id:id},
	  				dataType:'json',
	  				type:'post',
	  				headers:{
	  					'X-CSRF-TOKEN':'{{csrf_token()}}'
	  				},
	  				success:function(data){
	  					if(data.code == 1){
	  						//debugger;
		  					_this.parent().parent().parent().remove();
		  					layer.close(index);
	  					}else{
	  						layer.alert('删除失败!');
	  					}
	  				}
	  			})
  			});
  		});

  		//监听搜索
        $('#submit').click(function(evt){
        	evt.preventDefault();
        	var keyword = $('input[type="keyword"]').val();
        	if(keyword == ''){
        		layer.alert('请输入查询的用户名称!');
        	}
        	//ajax
        	$.ajax({
        		url:'{{url("/manager/ajax")}}',
        		data:{k:keyword},
        		dataType:'json',
        		type:'post',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			$('tbody').html('');
        			$('#demo0').remove();
        			for(var i = 0; i < data.length; i++) {
        				var tr = _create_item(data[i]);
        			}
        			$("tbody").append(tr);
        			console.log(data);
        		}
        	});
        	//alert(keyword);
        });

  		//刷新
  		$('#btn-refresh').click(function(){
  			window.location.href = '{{url("/manager/index")}}';
  		});
		//添加用户
		$('#btn-add').click(function(){
			var index =	layer.open({
			      type: 2,
			      title: '添加用户',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '{{url("/manager/getmanagerview")}}'
			});
			layer.full(index);
		});

		//创建tr
		function _create_item(d){
			//debugger;
			var tr = $('<tr></tr>');
			var mg_id = $('<td>'+ d["mg_id"] +'</td>');
			var mg_name = $('<td>'+d["mg_name"]+'</td>');
			var role_id = $('<td>'+d["role_name"]+'</td>');
			var resetpwd = $('<td><button class="layui-btn layui-btn-mini layui-btn-normal pwd-reset" data-id="'+d["mg_id"]+'">密码重置</button></td>');
			var login_ip = $('<td>'+d["login_ip"]+'</td>');
			var last_login_time = $('<td>'+d["last_login_time"]+'</td>');
			var created_at = $('<td>'+d["created_at"]+'</td>');
			var status = $('<td><button class="layui-btn layui-btn-mini layui-btn-warm table-list-status" data-id="'+d["mg_id"]+'">'+d["status"]+'</button></td>');
			var opt_td = $('<td><div class="layui-inline"><button class="layui-btn layui-btn-mini layui-btn  go-btn" data-id="'+d["mg_id"]+'" ><i class="layui-icon">&#xe642;</i>编辑</button><button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="'+d["mg_id"]+'" ><i class="layui-icon">&#xe640;</i>删除</button></div></td>');

			tr.append(mg_id);
			tr.append(mg_name);
			tr.append(role_id);
			tr.append(resetpwd);
			tr.append(login_ip);
			tr.append(last_login_time);
			tr.append(created_at);
			tr.append(status);
			tr.append(opt_td);
			return tr;
			/**/
			
		}
	});
</script>
@endsection