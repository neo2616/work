@extends('admin/common/master')
@section('title','根据网站统计')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
	1,根据日期(默认是当天时间数据)或者昵称搜索 统计数据是根据前端模拟一个cookie数值,,数据只具有参考价值
</blockquote>
<form class="layui-form">
 <div class="layui-inline">
    <label class="layui-form-label">日期</label>
        <div class="layui-input-inline">
            <input type="text" name="date" id="date"  autocomplete="off" class="layui-input" value="{{$_GET['date']}}">
        </div>
    </div>
    
    <!-- <div class="layui-inline">
        <div class="layui-input-inline">
            <input type="text" name="url" autocomplete="off" placeholder="输入来源网址\访问网址" class="layui-input" value="{{$_GET['url']}}">
        </div>
    </div> -->
   
    <button class="layui-btn" lay-submit="" type="submit"><i class="layui-icon">&#xe615;</i>确认查询</button>
 </div>
 <span class="fr">
    <a class="layui-btn btn-add btn-default" href="javascript:location.replace(location.href);"><i class="layui-icon">&#x1002;</i></a>
 </span>
</form>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>根据网站统计 </legend>
</fieldset>
<table class="layui-table" lay-even lay-size="sm" lay-skin="line">
	<colgroup>
		<!-- <col width="50"> -->
		<!-- <col width="70"> -->
		<!-- <col width="200"> -->
		<col width="200">
		<col width="200">
		<col >
	</colgroup>
	<thead>
		<tr>
			<!-- <th>来源网址</th> -->
			<th>访问网址</th>
			<th>游客人数</th>
			<th>加好友人数</th>
		</tr>
	</thead>
	<tbody>
		@foreach($d as $v)
        <tr>
            <!-- <td>{{$v->form_url}}</td> -->
            <td>{{$v->to_url}}</td>
            <td>{{$v->fk_count}} 人</td>
            <td>{{$v->gf_count}} 人</td>
        </tr>
        @endforeach
	</tbody>
</table>
<span class="fr">

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