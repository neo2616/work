<?php 
	namespace App\Repositories;

	use DB;
	use Auth;
	use App\Weixin;
	use App\Manager;

	class WechatRepository
	{
		//获取所有微信的数据
		public function getWechatFeeds($k)	// 1 => 超级root 
		{
			$data = [
				'mg_id'=>Auth::guard('back')->user()->mg_id,
				'k'=>$k
			];

			$resource = Weixin::with('manager')
							->where(function($query) use($data){
								if($data['mg_id'] != 1){
									$query->where('mg_id',$data['mg_id']);
								}
								if(!empty($data['k'])){
									$query->where('wx_name',$data['k']);
								}
							})
							->orderBy('created_at','desc')
							->paginate(13);
			return $resource;
		}

		//获取到微信名称和id 
		public function getWechatFields()
		{
			$data = [
				'mg_id'=>Auth::guard('back')->user()->mg_id,

			];
			$resource = Weixin::where(function($query) use($data){
								if($data['mg_id'] != 1){
									$query->where('mg_id',$data['mg_id']);
								}
								$query->where('wx_status',1);
							})
							->orderBy('created_at','desc')
							->pluck('wx_name','wx_id');
			return $resource;
		}

		//删除指定的微信信息
		public function delete($id)
		{
			return Weixin::where('wx_id',$id)->delete();
		}

		//获取指定一条微信的数据
		public function getWechat($id)
		{
			return Weixin::find($id);
		}

		//获取管理员名称和id
		public function getMgAndMgId()
		{
			return Manager::pluck('mg_name','mg_id');
		}

		//更新微信数据
		public function wechatUpdate($d,$id)
		{
			return Weixin::where('wx_id',$id)->update(array_except($d,['wx_id']));
		}

		//快速导入系统
		public function saveWechat($d)
		{
			$mgId = Auth::guard('back')->user()->mg_id;
			$created_at = date('Y-m-d H:i:s',time());
			
			foreach ($d as $k => $v) {
				DB::insert(" REPLACE INTO `w_weixin`(`wx_name`, `mg_id`,`created_at`) VALUES('{$v}', '{$mgId}','{$created_at}');");
			}
			return true;
		}
	}
?>