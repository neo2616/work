<?php 
	namespace App\Repositories;

	use App\Note;
	use App\Manager;

	class SearchnoteRepository
	{
		//获取所有状态的note
		public function getNoteFeeds($whereData)
		{
			$mg_id = \Auth::guard('back')->user()->mg_id;

			$data = Note::with('manager','weixin')
								->where(function($query) use($whereData,$mg_id){
										if($mg_id != 1){
											$query->where('mg_id',$mg_id);
										}
										if(!empty($whereData['mg_id'])){
											$query->where('mg_id',$whereData['mg_id']);
										}
									})
								->whereDate('created_at',$whereData['date'])
								->paginate(15);
			return $data;
		}

		//
		public function getMgId($mg_name)
		{
			return Manager::where('mg_name',$mg_name)->value('mg_id');
		}
	}
