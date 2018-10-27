@extends('admin/common/master')
@section('title','微信编辑')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
 	微信编辑
</blockquote>
<form class="layui-form" action="">
	<input type="hidden" name="wx_id" value="{{$wechat->wx_id}}">
    <div class="layui-form-item">
        <label class="layui-form-label">微信号</label>
        <div class="layui-input-block">
            <input type="text" name="wx_name"  autocomplete="off" placeholder="请输入微信号" class="layui-input" value="{{$wechat->wx_name}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="radio" name="wx_status" value="1" @if($wechat->wx_status == 1) checked @endif title="正常">
            <input type="radio" name="wx_status" value="2" @if($wechat->wx_status == 2) checked @endif title="停用">
        </div>
    </div>
   
    <div class="layui-form-item">
        <label class="layui-form-label">所属用户 &nbsp;(建议不改)</label>
        <div class="layui-input-block">
            <select name="mg_id" lay-filter="mg_id" lay-search="">
            	@foreach($mgAndMgId as $k=>$v)
            		<option value="{{$k}}" @if($wechat->mg_id == $k) selected @endif>{{$v}}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" class="layui-textarea" name="desc">{{$wechat->desc}}</textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@endsection
@section('my-js')
<script>
    layui.use(['form',  'layer'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,$ = layui.$;

        //监听提交
        form.on('submit(demo1)', function(data){
        	var shuju = data.field;
        	//debugger;
            //ajax
            $.ajax({
            	url:'/wechat/'+shuju.wx_id,
            	data:shuju,
            	dataType:'json',
            	type:'PATCH',
            	headers:{
            		'X-CSRF-TOKEN':'{{csrf_token()}}'
            	},
            	success:function(data){
            		if(data.code == 1){
            			layer.alert('编辑成功!',function(){
            				//debugger;
            				parent.window.location.href = parent.window.location.href
            			});
            		}else if(data.code == 0){
            			layer.msg('编辑失败!');
            		}
            	}
            });
            return false;
        });


    });
</script>
@endsection