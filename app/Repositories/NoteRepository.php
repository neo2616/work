<?php 
	namespace App\Repositories;

	use App\Weixin;
	use App\Note;
	use App\Manager;

	class NoteRepository
	{

		//获取到所有用户
		public function getajaxdata()
		{	
			$data = [];
			foreach($this->getallmanager() as $v) {
				$data['manager'][] = $v->mg_name;
				$data['ids'][] = $v->mg_id;
			}
			return $data;
		}

		//根据用户获取需要的数据
		public function getajaxshuju($ids)
		{	
			//以为 admin123 是 [0];
			for($i=0; $i < count($ids); $i++) { 
				$gf[] = Note::select(\DB::raw('sum(gf_counts) as gf_sum'))
										->whereDate('created_at',date('Y-m-d',time()))
										->where('mg_id',$ids[$i])
										->get()
										->toArray();
				$rg[] = Note::select(\DB::raw('sum(rg_counts) as rg_sum'))
										->whereDate('created_at',date('Y-m-d',time()))
										->where('mg_id',$ids[$i])
										->get()
										->toArray();
				$moin[] = Note::select(\DB::raw('sum(money_in_counts) as moin'))
										->whereDate('created_at',date('Y-m-d',time()))
										->where('mg_id',$ids[$i])
										->get()
										->toArray();
			}
			$r_g = [];
			$g_f = [];
			$m_i = [];
			for ($i=0; $i < count($gf); $i++) { 
				$g_f[] = $gf[$i][0]['gf_sum'];
				$r_g[] = $rg[$i][0]['rg_sum'];
				$m_i[] = $moin[$i][0]['moin'];
			}

			$data = [
	            ['name'=>'好友人数','type'=>'bar','data'=>$g_f],
	            ['name'=>'注册人数','type'=>'bar','data'=>$r_g],
	            ['name'=>'存款人数','type'=>'bar','data'=>$m_i]
	        ];
			return $data;
		}

		//后台管理获取所有的管理员
		public function getallmanager()
		{
			return Manager::get();
		}
		//获取正常的微信号
		public function getWxsList()	
		{
			return Weixin::where('wx_status','正常')->get();
		}

		//创建笔记头部信息
		public function createNoteHeaderHtml(array $d,$k)
		{
			$header = '<div class="layui-collapse" wx_id="'.@$d['wx_id'].'"><div class="layui-colla-item"><h2 class="layui-colla-title">'.@$d['wx_name'].'</h2><div class="layui-colla-content" >';
			$header .= '<table class="layui-table" lay-even lay-size="sm" lay-skin="line"><colgroup><col width="50"><col width="100"><col width="100"><col width="100"><col width="150"><col width="150"><col width="150"></colgroup><thead><tr><th>ID</th><th>好友人数</th><th>注册人数</th><th>注册平台</th><th>存款人数</th><th>创建时间</th><th>操作</th></tr></thead><tbody>';

			if($k == 'show'){
				$header .= $this->showTdData($d);
			}elseif($k == 'input'){
				$header .= $this->postEditTdData($d,'input');
			}
			$header .= '</tbody></table>';
			$header .= '</div></div></div>';
			return $header;
		}
		//创建 td (input) 输入修改数据
		public function postEditTdData($d=array(),$k)
		{
			$td = '<tr>';
			$td .= '<td>'.@$d['note_id'].'</td>';
			$td .= '<td><input type="number" name="gf_counts" class="layui-input" value="'.@$d['gf_counts'].'"/></td>';
			$td .= '<td><input type="number" name="rg_counts" class="layui-input" value="'.@$d['rg_counts'].'"/></td>';
			$td .= '<td><input type="text" name="rg_platform" class="layui-input" value="'.@$d['rg_platform'].'"/></td>';
			$td .= '<td><input type="number" name="money_in_counts" class="layui-input" value="'.@$d['money_in_counts'].'"/></td>';
			$td .= '<td>默认当前时间</td>';
			$td .= '<td><div class="layui-inline">';
			$td .= '<button class="layui-btn layui-btn-mini layui-btn-warm save-btn" ><i class="layui-icon">&#xe605;</i>保存</button>';
			if($k == 'edit'){
				$td .= '';	//可以扩展功能
			}elseif($k == 'input'){
				$td .= '<button class="layui-btn layui-btn-mini layui-btn-danger cancel-btn" ><i class="layui-icon">&#xe603;</i>取消</button>';
			}
			$td .= '</div></td></tr>';
			return $td;
		}
		//创建 td 显示数据
		public function showTdData($d)
		{
			$td = '<tr>';
			$td .= '<td>'.@$d['note_id'].'</td>';
			$td .= '<td>'.@$d['gf_counts'].'</td>';
			$td .= '<td>'.@$d['rg_counts'].'</td>';
			$td .= '<td>'.@$d['rg_platform'].'</td>';
			$td .= '<td>'.@$d['money_in_counts'].'</td>';
			$td .= '<td>'.@$d['created_at'].'</td>';
			$td .= '<td><div class="layui-inline">';
			$td .= '<button class="layui-btn layui-btn-mini edit-btn" ><i class="layui-icon">&#xe642;</i>编辑</button>';
			$td .= '</div></td></tr>';
			return $td;
		}

		//保存笔记
		public function savenoteToDB($d)
		{
	
			$d['mg_id'] = \Auth::guard('back')->user()->mg_id;
			return Note::create($d);
		}

		//编辑笔记
		public function savenoteToDBByEdit($d)
		{
			return Note::where('note_id',$d['note_id'])->update([
						'gf_counts'=>$d['gf_counts'],
						'rg_counts'=>$d['rg_counts'],
						'rg_platform'=>$d['rg_platform'],
						'money_in_counts'=>$d['money_in_counts']
					]);
		}

		//自动加载未提交笔记 用户本人的 root全查
		public function loadingNotSubmitNote($mg_id)
		{
			/*if(is_root()){	//关闭了root
				return Note::select('weixin.wx_name','note.note_id','gf_counts','rg_counts','rg_platform','money_in_counts','note.created_at')
								->leftJoin('weixin','note.wx_id','weixin.wx_id')
								->where('is_submit','0')
								->get()
								->toArray();
			}*/
			
			return Note::select('weixin.wx_name','note.note_id','gf_counts','rg_counts','rg_platform','money_in_counts','note.created_at')
							->leftJoin('weixin','note.wx_id','weixin.wx_id')
							->where([['note.mg_id',$mg_id],['is_submit','0']])
							->get()
							->toArray();

		}

		//编辑note 输入框
		public function createNoteInputHtml($id)
		{
			$info = Note::where('note_id',$id)->first()->toArray();
			
			return $this->postEditTdData($info,'edit');
		}

		//确认提交笔记
		public function setIs_submit($note_ids)
		{
			for($i=0; $i < count($note_ids); $i++) { 
				$z = Note::where('note_id',$note_ids[$i])->update(['is_submit'=>'1']);
			}
			return $z;
		}
	}
?>