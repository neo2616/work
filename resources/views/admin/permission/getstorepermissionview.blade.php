@extends('admin/common/master')
@section('title','编辑权限')
@section('class','body')
@section('content')
<form class="layui-form" action="">
	<input type="hidden" name="ps_id" value="{{$info->ps_id}}">
    <div class="layui-form-item">
        <label class="layui-form-label">权限名称</label>
        <div class="layui-input-block">
            <input type="text" name="ps_name"  autocomplete="off" placeholder="请输入权限名称" class="layui-input" value="{{$info->ps_name}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">父级权限</label>
        <div class="layui-input-block">
            <select name="ps_pid" lay-filter="aihao">
            	@foreach($tree as $v)
                <option value="{{$v['ps_id']}}" 
                @if($info->ps_pid == $v['ps_id'])
                selected
                @endif
                >{{str_repeat('&nbsp;&nbsp;',$v['ps_level']).$v['ps_name']}}</option>
               	@endforeach
            </select>
        </div>
    </div>
	<div class="layui-form-item">
        <label class="layui-form-label">控制器</label>
        <div class="layui-input-block">
            <input type="text" name="ps_c"  autocomplete="off" placeholder="请输入控制器名称" class="layui-input" value="{{$info->ps_c}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">方法</label>
        <div class="layui-input-block">
            <input type="text" name="ps_a"  autocomplete="off" placeholder="请输入方法名称" class="layui-input" value="{{$info->ps_a}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">路由</label>
        <div class="layui-input-block">
            <input type="text" name="ps_route"  autocomplete="off" placeholder="请输入路由名称" class="layui-input" value="{{$info->ps_route}}">
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
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,$ = layui.$;


        //监听提交
        form.on('submit(demo1)', function(data){
            var shuju = data.field;
            //AJAX
            $.ajax({
                url:'{{url("/permission/editpermission")}}',
                data:shuju,
                type:'post',
                dataType:'json',
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                success:function(data){
                    if(data.code == 1){
                        layer.alert('编辑成功!',function(){
                            parent.window.location.href = parent.window.location.href;
                        });
                    }else{
                        layer.alert('编辑权限失败!');
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    var ps_a = jqXHR.responseJSON.ps_a ? jqXHR.responseJSON.ps_a : '';
                    var ps_c = jqXHR.responseJSON.ps_c ? jqXHR.responseJSON.ps_c : '';
                    var ps_name = jqXHR.responseJSON.ps_name ? jqXHR.responseJSON.ps_name : '';
                    var ps_route = jqXHR.responseJSON.ps_route ? jqXHR.responseJSON.ps_route : '';
                    layer.alert(ps_a+ps_c+ps_name+ps_route);
                    console.log(jqXHR);
                }
            })
    
            return false;
        });


    });
</script>
@endsection