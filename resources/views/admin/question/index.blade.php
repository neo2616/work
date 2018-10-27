@extends('admin.common/master')
@section('title','问题显示')
@section('class','body')
@section('content')
<link rel="stylesheet" type="text/css" href="/admin/page.css">
<blockquote class="layui-elem-quote layui-text">
<div class="layui-inline">
    <label class="layui-form-label" style="width: 200px;">1,点击按钮之后即可添加问题</label>
    <div class="layui-input-inline">
       <button class="layui-btn q-btn"><i class="layui-icon">&#xe654;</i>添加问题</button>
    </div>
</div>
</blockquote>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 20px;">
    <legend>问题列表显示</legend>
    <div>
    	<ul class="layui-timeline">
		 @foreach($q as $v)
		 <hr class="layui-bg-gray">
		  <li class="layui-timeline-item">
		    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
		    <div class="layui-timeline-content layui-text">
		      <h3 class="layui-timeline-title"><em>{{$v->mg_name}}提问:</em>&nbsp;&nbsp;&nbsp;于 {{$v->created_at}}</h3>
		      <span class="fr">
		      	<button href="#" class="layui-btn  layui-btn-radius layui-btn-warm answer-btn" q-id="{{$v->q_id}}">回答--{{$v->mg_name}}</button>
		      </span>
		      <p>{{$v->title}}</p>
		      <div id="answer{{$v->q_id}}">
		      	<!-- 存放答案 -->
			      @foreach($v->answer as $vv)
			      <ul>
			      	<li>{{$vv->content}}</li>
			      	<span class="fc" >&nbsp;&nbsp;&nbsp;&nbsp;<em>----{{$vv->manager->mg_name}}</em></span>
			      </ul>
			      @endforeach
		      </div>
		    </div>
		  </li>
		  <hr class="layui-bg-gray">
		  @endforeach
		</ul>
    </div>

</fieldset>
<span class="fr">
  {{ $q->links() }}	
</span>
@endsection
@section('my-js')
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                , $ = layui.$;


            $('.q-btn').click(function(){
	            var index = layer.open({
				      type: 2,
				      title: '添加问题',
				      shadeClose: true,
				      shade: false,
				      maxmin: true, //开启最大化最小化按钮
				      content: '{{url("/question/getaddview")}}'
				    });
	            layer.full(index);
            })

            //回答问题
            $('.answer-btn').click(function(){
            	var q_id = $(this).attr('q-id');
            	//ajax
            	var index = layer.open({
				      type: 2,
				      title: '回答问题',
				      shadeClose: true,
				      shade: false,
				      maxmin: true, //开启最大化最小化按钮
				      area: ['893px', '600px'],
				      content: '{{url("/question/getanswerview")}}'+'/'+q_id
				    });
    			layer.full(index);
            });
    });
</script>
@endsection