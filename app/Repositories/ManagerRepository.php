<?php 
	namespace App\Repositories;

	use App\Role;
	use App\Manager;
	use Illuminate\Support\Facades\Hash;

	class ManagerRepository
	{
		//更新当前登录者的ip地址
		function updateManagerIp(array $ip)
		{	
			$id = \Auth::guard('back')->user()->mg_id;
			return Manager::where('mg_id',$id)->update(['login_ip'=>$ip[0]]);
		}

		//后期所有的管理员
		function getManagers(array $d,$k)
		{
			return Manager::select(\DB::raw('w_manager.*,w_role.role_name'))
							->leftJoin('role','manager.role_id','role.role_id')
							->where(function($query) use($k){
								if(!empty($k)){
									$query->where('mg_name',$k);
								}
							})
							->offset($d['offset'])			//偏移量
							->limit($d['limit'])		//显示数量
							->get();
		}

		//用户组的全部数据
		function roleidAndRolename()
		{
			return Role::pluck('role_name','role_id');
		}

		//保存用户数据
		function storeManager($data)
		{
			$data['password'] = Hash::make($data['password']);
			return Manager::create($data);
		}

		//用户唯一性
		function mg_nameUnique($mg_name)
		{
			return Manager::where('mg_name',$mg_name)->first();
		}

		//获取manager 总数
		function managerCount()
		{
			return Manager::count();
		}

		//获取到管理员信息
		function Managers()
		{
			return Manager::with(['weixin'=>function($query){
								$query->where('wx_status',1);
							}])
						->where('status','on')
						->get();
		}

		//分页
		function myPaginate($page,$pagesize)
		{
		    $total_num = Manager::count();
		    $page_num = ceil($total_num/$pagesize);
		    if($page < 1){
		        $page = 1;
		    };
		    if($page >= $page_num){
		        $page = $page_num;
		    };
		    $offset = ($page-1)*$pagesize;
		    return $d = [
		    	'offset'=>$offset,
		    	'limit'=>$pagesize,
		    ];
		}

		//删除管理员
		function delmanagerById($id)
		{
			return Manager::where('mg_id',$id)->delete();
		}

		//获取管理员通过id
		function getManagerById($id)
		{
			return Manager::with(['notes'=>function($query){
								$query->whereDate('created_at',date('Ymd'));
							}])
							->find($id);
		}
		//修改管理员状态
		function resetStatus($id)
		{
			$status = '';
			$now_stauts = Manager::where('mg_id',$id)->value('status');
			if($now_stauts == 'on'){
				$status = 'off';
			}else{
				$status = 'on';
			}
			Manager::where('mg_id',$id)->update(['status'=>$status]);
			return $status;
		}

		//通过id编辑用户
		function editManagerById($data)
		{
			return Manager::where('mg_id',$data['mg_id'])
						->update([
							'mg_name'=>$data['mg_name'],
							'role_id'=>$data['role_id'],
							'status'=>$data['status'],
							'desc'=>$data['desc'],
						]);
		}

		//用户密码修改
		function resetPwdById(array $d)
		{
			$d['password'] = Hash::make($d['password']);
			return Manager::where('mg_id',$d['mg_id'])->update(['password'=>$d['password']]);
		}

		//记录最后一次登录的时间
		function last_login_time()
		{
			$mg_id = \Auth::guard('back')->user()->mg_id;
			$time = date('Y-m-d H:i:s',time());
			return Manager::where('mg_id',$mg_id)->update(['last_login_time'=>$time]);
		}

		//初始密码是否对,保存数据
		function checkOldpasswordFromDBAndsave($d)
		{
			$mg_id = \Auth::guard('back')->user()->mg_id;
			$hashedpwd = Manager::find($mg_id)->password;
		
			if(!Hash::check($d['oldpwd'],$hashedpwd)){
				return false;
			};
			
			return Manager::where('mg_id',$mg_id)->update(['password'=>Hash::make($d['newpwd'])]);
			
		}


	}
?>