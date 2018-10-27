@extends('admin/common/master')
@section('title','话术列表')
@section('class','body')
@section('content')
<link rel="stylesheet" type="text/css" href="/admin/page.css">
<blockquote class="layui-elem-quote layui-text">
	@if(is_root())
	<div class="layui-inline">
        <label class="layui-form-label" style="width: 100px;">推广使用话术</label>
        <div class="layui-input-inline">
            <button name="btn"  class="layui-btn add-btn"><i class="layui-icon">&#xe654;</i>添加话术</button>
        </div>
    </div>
    @else
    推广使用话术
    @endif
</blockquote>
<br/><br/>
<div class="layui-row" style="text-align: center;">
	<div class="layui-col-md1">ID</div>
	<div class="layui-col-md10" style="text-align: left;">内容</div>
	<div class="layui-col-md1">操作</div>
</div>
<hr class="layui-bg-black">
	@foreach($data as $v)
	<div class="layui-row" style="text-align: center;">
		<div class="layui-col-md1">{{$v->huashu_id}}</div>
		<div class="layui-col-md10" style="text-align: left;" ><span id="foo{{$v->huashu_id}}">{{$v->content}}</span>&nbsp;&nbsp;&nbsp;--作者:无名</div>
		<div class="layui-col-md1">
			@if(is_root())
			<button class="layui-btn layui-btn-mini layui-btn edit-btn" >编辑</button>
			@endif
			<button class="layui-btn layui-btn-mini layui-btn-primary btn" data-clipboard-action="copy" data-clipboard-target="#foo{{$v->huashu_id}}">复制</button>
		</div>
	</div>
	<hr class="layui-bg-black">
	@endforeach
	<span class="fr">
		{{ $data->links() }}
	</span>

@endsection
@section('my-js')
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="/admin/lib/clipboard.min.js"></script>

<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                , $ = layui.$;

        //添加话术显示页面
        $('.add-btn').click(function(){
        	//显示输入框
        	var index = layer.open({
			      type: 2,
			      title: '添加话术',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '{{url("/huashu/getadd")}}'
			    });
        	layer.full(index);
        });

        //编辑话术显示页面
         $('.edit-btn').click(function(){
         	var _this = $(this);
         	var id = _this.parent().parent().find('div:eq(0)').html();
         	//var content = _this.parent().parent().find('div:eq(1)').html()
         	//debugger;
        	//显示输入框
        	var index = layer.open({
			      type: 2,
			      title: '编辑话术',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      area: ['893px', '600px'],
			      content: '{{url("/huashu/getedit")}}'+ '/'+id
			    });
        	layer.full(index);
        });

        //剪切板
        var clipboard = new ClipboardJS('.btn');
	        clipboard.on('success', function(e) {
	 
			    layer.msg("复制成功");
			});
    });
</script>
@endsection