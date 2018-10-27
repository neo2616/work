<?php 
	namespace App\Repositories;

	use Auth;
	use App\Note;
	use App\Weixin;
	use App\Manager;

	class NotebookRepository
	{

		//获取当前用户,当日的bote 记录
		public function getNoteFeeds()
		{
			$mgId = Auth::guard('back')->user()->mg_id;

			$resource = Note::with('weixin')
						->where('mg_id',$mgId)
						->whereDate('created_at',date('Y-m-d'))
						->orderBy('created_at','desc')
						->get();

			return $resource;
		}
		//生成笔记记录
		public function storeNote()
		{
			$mgId = Auth::guard('back')->user()->mg_id;
			if($mgId != 1){
				$wx_ids = $this->mgWxIds($mgId);
				foreach ($wx_ids as $k => $wx_id) {
					$data = [
						'wx_id'=>$wx_id,
						'mg_id'=>$mgId,
					];
					Note::create($data);
				}
				return ['code'=>config('code.success')];
			}
		}

		//获取当前用户微信号的ids 集合
		public function mgWxIds($mgId)
		{
			return Weixin::where([
						['mg_id',$mgId],
						['wx_status','1']
					])->pluck('wx_id');
		}

		//更新数据
		public function updateNote($d)
		{
			switch ($d['index']) {
				case '2':
					Note::where('note_id',$d['id'])->update(['gf_counts'=>$d['d']]);
					break;
				case '3':
					Note::where('note_id',$d['id'])->update(['rg_counts'=>$d['d']]);
					break;
				case '4':	//4,注册平台
					Note::where('note_id',$d['id'])->update(['rg_platform'=>$d['d']]);
					break;
				case '5':
					Note::where('note_id',$d['id'])->update(['money_in_counts'=>$d['d']]);
					break;
			}
			return true;
		}


		 //格式化数据
	    public function format($d)
	    {
	        $wx = Weixin::pluck('wx_name','wx_id')->toArray();
	        foreach ($d as $k => $v) {
	           $d[$k]->wx_name = $wx[$v->wx_id];
	        }
	        
	        return $d;
	    }

	    //检查笔记是否新建了
	    public function checkCreated()
	    {
	    	$mgId = Auth::guard('back')->user()->mg_id;

	    	return Note::where('mg_id',$mgId)
				    	->whereDate('created_at',date('Y-m-d',time()))
				    	->count();
	    }

	    //删除
	    public function deleteNote()
	    {
	    	$mgId = Auth::guard('back')->user()->mg_id;
	    	
	    	return Note::where('mg_id',$mgId)
				    	->whereDate('created_at',date('Y-m-d',time()))
				    	->delete();
	    }
		
	}