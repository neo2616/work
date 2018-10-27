@extends('admin/common/master')
@section('title','开始笔记')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
 	注意: 点击添加微信信息, 如果微信存在是会自动更新的哦!
</blockquote>
<form>
<div class="my-btn-box">
	<span class="fl">
        <!-- <a class="layui-btn layui-btn-danger radius btn-delect" id="btn-delete-all">批量删除</a> -->
        <button class="layui-btn"  id="add-wx"><i class="layui-icon">&#xe654;</i>批量添加微信号</button>
        <a class="layui-btn btn-add btn-default" href="javascript:location.replace(location.href);"><i class="layui-icon">&#x1002;</i></a>
    </span>
    <span class="fr">
        <span class="layui-form-label">搜索条件：</span>
        <div class="layui-input-inline">
            <input type="text" name="k" placeholder="请输入搜索微信号" class="layui-input" value="{{$_GET['k']}}">
        </div>
        <button class="layui-btn mgl-20">查询</button>
    </span>

</div>
</form>
<table class="layui-table" lay-even lay-size="sm" lay-skin="line">
	<colgroup>
		<!-- <col width="50"> -->
		<col width="70">
		<col width="130">
		<col width="130">
		<col width="100">
		<col >
		<col width="150">
	</colgroup>
	<thead>
		<tr>
           <!--  <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th> -->
			<th>ID</th>
			<th>微信号</th>
			<th>微信状态</th>
			<th>所属用户</th>
			<th>备注</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($wechat as $v)
        <tr>
            <!-- <td><input type="checkbox" name="" lay-skin="primary" data-id="1"></td> -->
            <td>{{$v->wx_id}}</td>
            <td>{{$v->wx_name}}</td>
            <td>{!! status($v->wx_status,'正常','停用') !!}</td>
            <td><span class="layui-badge layui-bg-gray">{{$v->manager->mg_name}}</span></td>
            <td>{{$v->desc}}</td>
            <td>
                <div class="layui-inline">
                    <button class="layui-btn layui-btn-small layui-btn-normal go-btn" data-id="{{$v->wx_id}}" >编辑</button>
                    <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="{{$v->wx_id}}" >删除</button>
                </div>
            </td>
        </tr>
        @endforeach
	</tbody>
</table>
<span class="fr">
	{{ $wechat->links() }}
</span>
@endsection
@section('my-js')
<script type="text/javascript">
    layui.use(['element', 'layer','laypage'], function () {
        var element = layui.element
                , layer = layui.layer
                ,	$ = layui.$;
       

        //监听删除
        $('tbody').on('click','.del-btn',function(){
        	var id = $(this).attr('data-id');
        	var _this = $(this);

        	var index = layer.confirm('确认需要删除么?', function(){
                $.ajax({
                    url:'/wechat/'+id,
                    data:{id:id},
                    dataType:'json',
                    type:'DELETE',
                    headers:{
                        'X-CSRF-TOKEN':'{{csrf_token()}}'
                    },
                    success:function(data){
                        if(data.code == 1){
                             _this.parent().parent().parent().remove();
                             layer.close(index);
                        }else if(data.code == 0){
                            layer.alert('删除失败');
                        }
                    }
                });
            });

        })

        //监听编辑
        $('tbody').on('click','.go-btn',function(){
        	var id = $(this).attr('data-id');
        	var _this = $(this);
            var index = layer.open({
                  type: 2,
                  title: '微信编辑',
                  shadeClose: true,
                  shade: false,
                  maxmin: true, //开启最大化最小化按钮
                  content: '/wechat/'+id+'/edit'
                });
            layer.full(index);
        })

        //添加微信信息
        $('#add-wx').click(function(){
        	layer.open({
                  type: 2,
                  title: '多个微信时输入,以逗号进行分割',
                  shadeClose: true,
                  shade: false,
                  maxmin: false, //开启最大化最小化按钮
                  area: ['600px', '330px'],
                  content: '/wechat/create'
                });
            return false;
        });
    });
</script>
@endsection