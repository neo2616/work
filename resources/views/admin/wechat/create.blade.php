@extends('admin/common/master')
@section('title','微信编辑')
@section('class','body')
@section('content')
<form class="layui-form layui-form-pane" action="">
<div class="layui-form-item layui-form-text">
    <div class="layui-input-block">
        <textarea placeholder="请输入微信账号" class="layui-textarea" style="height: 180px;" name="wx_names"></textarea>
    </div>
</div>
<div class="layui-form-item">
    <button class="layui-btn" lay-submit="" lay-filter="demo1">保存数据</button>
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
        	
        	if(data.field.wx_names == ''){
        		layer.alert('你没有添加微信账号的哦');
        		return false;
        	}
            //ajax
            $.ajax({
            	url:'/wechat',
            	data:data.field,
            	dataType:'json',
            	type:'post',
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