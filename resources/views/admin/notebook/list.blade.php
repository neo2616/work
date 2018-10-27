<div class="layui-form" id="table-list">
	<table class="layui-table" lay-even lay-skin="line">
		<colgroup>
			
			<col width="50">
			<col width="100">
			<col width="100">
			<col width="100">
			<col width="150">
			<col width="150">
			<col width="150">
			<col width="350">
		</colgroup>
		<thead>
			<tr>
				
				<th>ID</th>
				<th>微信号</th>
				<th>好友人数</th>
				<th>注册人数</th>
				<th>注册平台</th>
				<th>存款人数</th>
				<th>创建时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($notes as $k => $v)
			<tr>
				
				<td>{{$k+1}}</td>
				<td>{{$v->weixin->wx_name}}</td>
				<td>{{$v->gf_counts}}</td>
				<td>{{$v->rg_counts}}</td>
				<td>{{$v->rg_platform}}</td>
				<td>{{$v->money_in_counts}}</td>
				<td>{{$v->created_at}}</td>
				<td>
					<div class="layui-inline">
						<button class="layui-btn layui-btn-mini layui-btn-disabled " data-id="{{$v->note_id}}" ><i class="layui-icon">&#xe609;</i>保存</button>
						<!-- <button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="1" data-url="article-detail.html"><i class="layui-icon">&#xe640;</i>删除</button> -->
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="page-wrap">
		
	</div>
</div>