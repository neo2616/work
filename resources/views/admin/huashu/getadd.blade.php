@extends('admin/common/master')
@section('title','话术添加')
@section('class','body')
@section('content')
<form class="layui-form layui-form-pane" action="">
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">话术内容</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容"  class="layui-textarea" name="content" id="content" value=""></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <button class="layui-btn layui-btn" lay-submit id="demo1">立即提交</button>
		<button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</form>
@endsection
@section('my-js')
<script type="text/javascript">
	layui.use(['form','layer'],function(){
		var form = layui.form,
			layer = layui.layer,
			$ = layui.$;
        $('#demo1').click(function(evt){
            evt.preventDefault();
            var content = $('#content').val();
            if(content == ''){
                layer.alert('话术内容不得为空!');
                return;
            }
            //ajax
            $.ajax({
                url:'{{url("/huashu/savehuashu")}}',
                data:{content:content},
                dataType:'json',
                type:'post',
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                success:function(data){
                    if(data.code == 1){
                       layer.alert('添加成功!',function(){
                            parent.window.location.href = parent.window.location.href;
                        });
                    }
                }
            })
        })
	});
</script>
@endsection