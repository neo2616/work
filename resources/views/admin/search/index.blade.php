@extends('admin/common/master')
@section('title','开始笔记')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
	1,根据日期(默认是当天时间数据)或者昵称搜索 2,灰色代表停用,绿色代表正常
</blockquote>
<form class="layui-form">
 <div class="layui-inline">
    <label class="layui-form-label">日期</label>
        <div class="layui-input-inline">
            <input type="text" name="date" id="date"  autocomplete="off" class="layui-input" value="{{$_GET['date']}}">
        </div>
    </div>
    @if(is_root())
    <div class="layui-inline">
        <div class="layui-input-inline">
            <input type="text" name="mg_name" autocomplete="off" placeholder="输入昵称" class="layui-input" value="{{$_GET['mg_name']}}">
        </div>
    </div>
    @endif
    <button class="layui-btn" lay-submit="" type="submit"><i class="layui-icon">&#xe615;</i>确认查询</button>
 </div>
 <span class="fr">
    <a class="layui-btn btn-add btn-default" href="javascript:location.replace(location.href);"><i class="layui-icon">&#x1002;</i></a>
 </span>
</form>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>开始笔记</legend>
</fieldset>
<table class="layui-table" lay-even lay-size="sm" lay-skin="line">
	<colgroup>
		<!-- <col width="50"> -->
		<col width="70">
		<col >
		<col >
		<col >
		<col >
		<col >
		<col >
		<col >
		<col >
		<col width="150">
	</colgroup>
	<thead>
		<tr>
           <!--  <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th> -->
			<th>ID</th>
			<th>昵称</th>
			<th>微信号</th>
			<th>好友人数</th>
			<th>注册人数</th>
			<th>注册平台</th>
			<th>存款人数</th>
			<th>创建时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($notes as $v)
        <tr>
            <!-- <td><input type="checkbox" name="" lay-skin="primary" data-id="1"></td> -->
            <td>{{$v->note_id}}</td>
            <td>{!!mg_status($v->manager->status,$v->manager->mg_name,$v->manager->mg_name)!!}</td>
            <td>{!! status($v->weixin->wx_status,$v->weixin->wx_name,$v->weixin->wx_name)!!}</td>
            <td>{{$v->gf_counts}}</td>
            <td>{{$v->rg_counts}}</td>
            <td>{{$v->rg_platform}}</td>
            <td>{{$v->money_in_counts}}</td>
            <td>{{$v->created_at}}</td>
            <td>
                <div class="layui-inline">
                    <!-- <button class="layui-btn layui-btn-small layui-btn-normal go-btn" data-id="" >编辑</button>
                    <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="" >删除</button> -->

                </div>
            </td>
        </tr>
        @endforeach
	</tbody>
</table>
<span class="fr">
	{{$notes->appends(['date'=>$whereData['date'],'mg_name'=>$whereData['mg_name']])->links()}}
</span>

@endsection
@section('my-js')
<script type="text/javascript">
    layui.use(['element', 'layer','form','laydate'], function () {
        var element = layui.element
                , layer = layui.layer
                , form = layui.form
                ,	$ = layui.$
                ,laydate = layui.laydate;
        //日期
        laydate.render({
            elem: '#date'
        });
       	
        //提交日期查询
        $('#search').click(function(evt){
        	evt.preventDefault();
        	var date = $('input[name="date"]').val();
            var keyword = $('input[name="mg_name"]').val();
        	//ajax
        	$.ajax({
        		url:'{{url("/checknote/datainit")}}',
        		data:{date:date,keyword:keyword},
        		dataType:'json',
        		type:'post',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
                    $('#content').html('');
                    if(data.code == 1){
                        $('#content').html(data.html);
                        element.init();
                        layer.msg('查询ok');
                    }
        		}
        	});
        });
        //退回提交的申请
        $('#content').on('click','.tui-btn',function(){
        	var note_id = $(this).attr('data-id');
        	var _this = $(this);
        	//ajax
        	$.ajax({
        		url:'{{url("/checknote/tuihui")}}',
        		data:{note_id:note_id},
        		type:'post',
        		dataType:'json',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			
        			if(data.code ==1){
        				_this.parent().parent().parent().remove();
                        layer.msg('退回成功');
        			}
        		}
        	});
        })
    });
</script>
@endsection