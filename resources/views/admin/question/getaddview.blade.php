@extends('admin/common/master')
@section('title','添加问题')
@section('class','body')
@section('content')
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>你的问题: </legend>
</fieldset>
<form class="layui-form" action="">
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">问题描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" class="layui-textarea" name="title" id="q"></textarea>
        </div>
    </div>
   <!--  <div class="layui-form-item">
        <label class="layui-form-label">类型</label>
        <div class="layui-input-block">
            <input type="text" name="topic" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div> -->
 
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
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,$ = layui.$;

        //监听提交
        form.on('submit(demo1)', function(data){
        	$question = $('#q').val();
        	if($question == ''){
        		layer.alert('问题描述必须添写');
        		return false;
        	}
   
            //ajax
            $.ajax({
            	url:'{{url("/question/createquestion")}}',
            	data:data.field,
            	dataType:'json',
            	type:'post',
            	headers:{
            		'X-CSRF-TOKEN':'{{csrf_token()}}'
            	},
            	success:function(data){
            		if(data.code == 1){
            			parent.window.location.href = parent.window.location.href;
            		}
            	}
            })
            return false;
        });

    });
</script>
@endsection