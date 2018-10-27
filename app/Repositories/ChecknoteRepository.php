<?php 
	namespace App\Repositories;

	use App\Note;
	use App\Manager;

	class ChecknoteRepository
	{
		//获取管理员对应微信信息
		public function getmgAndWxsById($mg_id)
		{
			return Manager::find($mg_id);
		}

		//获取到所有正常的用户
		public function getmgAndWxsByIdExcep()
		{
			return Manager::where('status','on')->get();
		}
		//获取笔记和微信
		public function getNoteWithWx($mg_id,$date)
		{
			/*dd($mg_id);*/
			$data = Note::select('note_id','gf_counts','rg_counts','rg_platform','money_in_counts','note.created_at','is_hidden','wx_name','wx_status')
						->leftJoin('weixin','note.wx_id','weixin.wx_id')
						->whereDate('note.created_at',$date)
						->where('note.mg_id',$mg_id)
						->get();

			return $data;
		}

		//拼接 折叠 字符串
		public function createCheckCollapse($d,$noteWithWx)
		{
			$collapse = '';
			$wx = '';
			foreach ($d->weixin as $v) {
				if($v->wx_status == '正常'){
					$wx .= '&nbsp;&nbsp;&nbsp;<span class="layui-badge layui-bg-orange">'.$v->wx_name.'</span>';
				}elseif ($v->wx_status == '停用') {
					$wx .= '&nbsp;&nbsp;&nbsp;<span class="layui-badge layui-bg-gray">'.$v->wx_name.'</span>';
				}elseif ($v->wx_status == '冻结') {
					$wx .= '&nbsp;&nbsp;&nbsp;<span class="layui-badge">'.$v->wx_name.'</span>';
				}
			}
			$collapse .= '<div class="layui-collapse" lay-accordion=""><div class="layui-colla-item"><h2 class="layui-colla-title">
			'.$d->mg_name. $wx .'</h2><div class="layui-colla-content"><div class="layui-form" id="table-list">
					<table class="layui-table" lay-even lay-skin="line"><colgroup><col width="50"><col width="150"><col width="150"><col width="150"><col width="150"><col width="150"><col width="150"><col width="200"></colgroup><thead><tr><th>NOTE_ID</th><th>微信号</th><th>微信状态</th><th>好友人数</th><th>注册人数</th><th>游戏平台</th><th>存款人数</th><th>创建时间</th><th>状态</th><th>操作</th></tr></thead><tbody>';
			for ($i=0; $i < count($noteWithWx); $i++) { 
				
				$collapse .= $this->createCheckTableTr($noteWithWx[$i]);
			}

	        $collapse .= '</tbody></table></div></div></div></div>';
			return $collapse;
		}

		//拼接 数据表内容
		public function createCheckTableTr($d)
		{
			//提交的笔记才可以查询到
			if($d['is_submit'] == 1){
				if($d['is_submit'] == '1'){
					$k = '已提交';
				}else{
					$k = '未提交';
				};
				$status = '';
				if($d['wx_status'] == '正常'){
					$status .= '<td><button class="layui-btn layui-btn-mini layui-btn-warm">'.$d['wx_status'].'</button></td>';
				}elseif($d['wx_status'] == '冻结'){
					$status .= '<td><button class="layui-btn layui-btn-mini layui-btn-danger">'.$d['wx_status'].'</button></td>';
				}elseif($d['wx_status'] == '停用'){
					$status .= '<td><button class="layui-btn layui-btn-mini layui-btn-disabled">'.$d['wx_status'].'</button></td>';
				}
				$tr = '<tr><td>'.$d['note_id'].'</td>';
				$tr .= '<td>'.$d['wx_name'].'</td>';
				$tr .= $status;
				$tr .= '<td>'.$d['gf_counts'].'</td>';
				$tr .= '<td>'.$d['rg_counts'].'</td>';
				$tr .= '<td>'.$d['rg_platform'].'</td>';
				$tr .= '<td>'.$d['money_in_counts'].'</td>';
				$tr .= '<td>'.$d['created_at'].'</td>';
				$tr .= '<td><button class="layui-btn layui-btn-mini layui-btn-warm">'.$k.'</button></td>';
				if(is_root()){
					$tr .= '<td><div class="layui-inline"><button class="layui-btn layui-btn-small layui-btn tui-btn" data-id="'.$d['note_id'].'"><i class="layui-icon">&#xe65c;</i>退回用户</button></div></td>';
				}else{
					$tr .= '<td>无</td>';
				}

				$tr .= '</tr>';
				return $tr;
			}
		}

		//修改is_submit 为 1
		public function setIssubmitTRUE($id)
		{
			return Note::where('note_id',$id)->update(['is_submit'=>'0']);
		}
	}

?>