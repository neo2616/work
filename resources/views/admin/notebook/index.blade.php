@extends('admin/common/master')
@section('title','开始笔记')
@section('class','body')
@section('content')
<style type="text/css">
	.top{
		
		background-color:  #9933ff!important;
	    position: relative;
	    top: -9px;
	}
	#font{
        margin: 2%;
    }
</style>
<div class="my-btn-box">
    <span class="fl">
         @if(!is_root())
            <a class="layui-btn add-note" >新建笔记</a>
         @endif
    </span>
    <span class="fr">
         <a class="layui-btn btn-add btn-default"  href="javascript:location.replace(location.href);"><i class="layui-icon">&#x1002;</i></a>
    </span>
</div>
<fieldset class="layui-elem-field" >
  <legend>当前微信数量: {{$count}}个, 当前时间: <span id="now"> </span></legend>
  @if(is_root())
<div class="layui-field-box">
    @foreach($managers as $k=>$v)
    	@if($k != '0')
			<button class="layui-btn layui-btn-radius layui-btn-mini manager" data-id="{{$v->mg_id}}">{{$v->mg_name}}</button> <span class="layui-badge layui-bg-blue top">{{$v->weixin->count()}}</span>
    	@endif
    @endforeach
  </div>
  @else
  <div class="layui-field-box">
    @foreach($wechatFields as $k=>$v)
    	<span class="layui-badge layui-bg-green" >{{$v}}</span>&nbsp;
    @endforeach
  </div>
  @endif
  

</fieldset>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>开始笔记</legend>
</fieldset>
@if(is_root())
@include('admin/notebook/rootlist')
@else
@include('admin/notebook/list')
@endif
@endsection
@section('my-js')
<script type="text/javascript">
    layui.use(['element', 'layer','form'], function () {
        var element = layui.element
                , layer = layui.layer
                , form = layui.form
                ,	$ = layui.$;
        //新建笔记
        $('.add-note').on('click',function(){
            //ajax
            $.ajax({
                url:'/notebook/store',
                data:'',
                type:'get',
                dataType:'json',
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                success:function(msg){
                    if(msg.code == 1){
                        self.location = self.location;
                    }else if(msg.code == 0){
                        layer.alert(msg.error)
                    }
                }
            })
        });

        //点击查询记录
        $('.manager').on('click',function(){
            var mgId = $(this).attr('data-id');
            //ajax
            $.ajax({
                url:'/notebook/show',
                data:{mgId:mgId},
                type:'post',
                dataType:'json',
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                success:function(msg){
                    if(msg.code == 1){
                        $('#content').html('');
                        var span = '';

                        $.each(msg.data,function(i,item){
                            span += '<span id="font">'+item.note_id+'</span>';
                            span += '<span id="font">'+item.wx_name+'</span>';
                            span += '<span id="font">'+item.gf_counts+'</span>';
                            span += '<span id="font">'+item.rg_counts+'</span>';
                            span += '<span id="font">'+item.rg_platform+'</span>';
                            span += '<span id="font">'+item.money_in_counts+'</span>';
                            span += '<span id="font">'+item.created_at+'</span>';
                            span += '<hr class="layui-bg-cyan">';
                        })
     
                        $('#content').append(span);
                    }else if(msg.code == 0){
                        $('#content').html('没有数据!');
                    }
                }
            })
            console.log(mgId);
        });

        //表格实时编辑
        $(function(){
        	var tds = $('tr').find('td:gt(1):lt(4)'); 
        	tds.click(function(){
        		var td = $(this);
        		var _index = $(td).index();
        		var oldtext = $(this).text();
        		var id = $(this).parent('tr').find('td:last').find('button').attr('data-id');
        		var input = $('<input autofocus="autofocus" type="text" value="'+ oldtext +'">');
        		td.html(input);
        		input.click(function(){return false});
        		input.focus();
        		input.width(td.width);
        		
        		input.blur(function(){
        			var input_blur = $(this);
        			var newtext = input_blur.val();
        			td.html(newtext);
        			//ajax
        			//debugger;
        			my_ajax(_index,id,newtext);
        		});
        		input.keyup(function(event){
					// 获取键值  
		            var keyEvent=event || window.event;  
		            var key=keyEvent.keyCode;  
		            //获得当前对象  
		            var input_blur=$(this);  
		            switch(key)  
		            {  
		                case 13://按下回车键，保存当前文本框的内容  
		                    var newtext=input_blur.val();   
		                    td.html(newtext);
		                    //ajax
		                    my_ajax(_index,id,newtext);
		                break;  
		                  
		                case 27://按下esc键，取消修改，把文本框变成文本  
		                    td.html( oldtext );   
		                break;  
		            }  
				});	
        		//debugger;
        	})
        });

        //发送数据到数据库内
        function my_ajax(index,id,d) {	// 2, 好友人数 3,注册人数 4,注册平台 5,存款人数
        		
        	if(index == '2' || index == '3' || index == '5'){
        		console.log(index,id,d);
        		if(isNaN(d)){
	        		layer.alert('必须为数字',{title:'提示'});
	        		return false;
        		}
        	}
        	//ajax
        	$.ajax({
        		url:'/notebook/update',
        		data:{index:index,id:id,d:d},
        		type:'post',
        		dataType:'json',
        		headers:{
        			'X-CSRF-TOKEN':"{{csrf_token()}}"
        		},
        		success:function(msg){

        		}
        	})
        }

        //当前时间
        setInterval(get_time,1000);
       	$(function(){
        	get_time();
        })
       	//时间的显示
        function get_time(){
        	var myDate = new Date();
        	var year = myDate.getFullYear();
        	var month = myDate.getMonth()+1;
        	var date = myDate.getDate();
        	var hours = myDate.getHours();
        	var minutes = myDate.getMinutes();
			var seconds = myDate.getSeconds();
			//月
			if(month<10){
				month = '0'+month;
			}
			//日
			if(date<10){
				date = '0'+date;
			}
			//时
			if(hours<10){
				hours = '0'+hours;
			}
			//分
			if(minutes<10){
				minutes = '0'+minutes;
			}
			//秒
			if(seconds<10){
				seconds = '0'+seconds;
			}
			//当前时间
			var now = year+'-'+month+'-'+date+' '+hours+':'+minutes+':'+seconds;
			$('#now').html(now);
        }
    });
</script>
@endsection