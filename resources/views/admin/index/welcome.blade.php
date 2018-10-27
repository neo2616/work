@extends('admin/common/master')
@section('title','welcome')
@section('class','body')
@section('content')
<!-- <div class="layui-row layui-col-space10 my-index-main">
    <div class="layui-col-xs43 layui-col-sm3 layui-col-md3">
        <div class="my-nav-btn layui-clear" data-href="./demo/btn.html">
            <div class="layui-col-md5">
                <button class="layui-btn layui-btn-big layui-btn-danger layui-icon">&#xe756;</button>
            </div>
            <div class="layui-col-md7 tc">
                <p class="my-nav-text">40</p>
                <p class="my-nav-text layui-elip">微信数量</p>
            </div>
        </div>
    </div>
    <div class="layui-col-xs43 layui-col-sm3 layui-col-md3">
        <div class="my-nav-btn layui-clear" data-href="./demo/form.html">
            <div class="layui-col-md5">
                <button class="layui-btn layui-btn-big layui-btn-warm layui-icon">&#xe770;</button>
            </div>
            <div class="layui-col-md7 tc">
                <p class="my-nav-text">40</p>
                <p class="my-nav-text layui-elip">本月好友人数</p>
            </div>
        </div>
    </div>
    <div class="layui-col-xs43 layui-col-sm3 layui-col-md3">
        <div class="my-nav-btn layui-clear" data-href="./demo/table.html">
            <div class="layui-col-md5">
                <button class="layui-btn layui-btn-big layui-icon">&#xe735;</button>
            </div>
            <div class="layui-col-md7 tc">
                <p class="my-nav-text">40</p>
                <p class="my-nav-text layui-elip">本月注册人数</p>
            </div>
        </div>
    </div>
    <div class="layui-col-xs43 layui-col-sm3 layui-col-md3" >
        <div class="my-nav-btn layui-clear" data-href="./demo/table.html">
            <div class="layui-col-md5">
                <button class="layui-btn layui-btn-big layui-icon">&#xe65e;</button>
            </div>
            <div class="layui-col-md7 tc">
                <p class="my-nav-text">40</p>
                <p class="my-nav-text layui-elip">本月存款人数</p>
            </div>
        </div>
    </div>
</div> -->
<br/><br/><br/><br/><br/><br/>
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="main-line" style="width: 100%;height:400px;"></div>


@endsection
@section('my-js')
<script type="text/javascript" src="/admin/frame/echarts/echarts.min.js"></script>
<script type="text/javascript">

    layui.use(['element'], function(){
        var element = layui.element
            ,$      = layui.jquery;
        
        // you code ...
        $(function(){
            //ajax
            $.ajax({
                url:'{{url("welcome/data")}}',
                data:'',
                dataType:'json',
                type:'post',
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                success:function(msg){
                    if(msg.code == 1){
                        var data = msg.data.manager;
                        var shuju = msg.data.shuju;
                        //debugger;
                        // 基于准备好的dom，初始化echarts实例
                        var myChart = echarts.init(document.getElementById('main-line'));
                        
                        myChart.setOption({
                            title: {
                                text: '当日'
                            },
                            xAxis: {
                                data: data
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            yAxis: {},
                            series: shuju
                        });
                    }
                }
            })
        });

    });
</script>
@endsection
