@extends('admin/common/master')
@section('title','详情')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
	1,根据日期(默认是当天时间数据)或者昵称搜索 2,灰色代表点击添加微信按钮,绿色代表普通访客
</blockquote>
<form class="layui-form">
 <div class="layui-inline">
    <label class="layui-form-label">日期</label>
        <div class="layui-input-inline">
            <input type="text" name="date" id="date"  autocomplete="off" class="layui-input" value="{{$_GET['date']}}">
        </div>
    </div>
    
    <div class="layui-inline">
        <div class="layui-input-inline">
            <input type="text" name="url" autocomplete="off" placeholder="输入来源网址\访问网址" class="layui-input" value="{{$_GET['url']}}">
        </div>
    </div>
   
    <button class="layui-btn" lay-submit="" type="submit"><i class="layui-icon">&#xe615;</i>确认查询</button>
 </div>
 <span class="fr">
    <a class="layui-btn btn-add btn-default" href="javascript:location.replace(location.href);"><i class="layui-icon">&#x1002;</i></a>
 </span>
</form>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>来源统计 {{$count}}</legend>
</fieldset>
<table class="layui-table" lay-even lay-size="sm" lay-skin="line">
	<colgroup>
		<!-- <col width="50"> -->
		<!-- <col width="70"> -->
		<col width="200">
		<col width="200">
		<col width="200">
		<col width="200">
		<col >
	</colgroup>
	<thead>
		<tr>
			<th>模拟用户昵称</th>
			<th>来源网址</th>
			<th>访问网址</th>
			<th>类型</th>
			<th>时间</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $v)
        <tr>
            <td>{{$v->cookie}}</td>
            <td>{{$v->form_url}}</td>
            <td>{{$v->to_url}}</td>
            <td>{!!status($v->type,'普通访客','加微信访客')!!}</td>
            <td>{{$v->created_at}}</td>
        </tr>
        @endforeach
	</tbody>
</table>
<span class="fr">
	{{ $data->appends(['date'=>$whereData['created_at'],'url'=>$whereData['url']])->links() }}
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
       	
       
    });
</script>
@endsection