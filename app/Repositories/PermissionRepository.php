<?php 
	namespace App\Repositories;

	use App\Permission;
	use App\Manager;

	class PermissionRepository
	{
		//获取到 a级 权限
		function getPermission_A($mg_id,$root)
		{	
			if($root == 'root'){
				return Permission::where('ps_level','0')->get();
			}
			$ps_ids = $this->get_ps_ids($mg_id);
			return Permission::whereIn('ps_id',$ps_ids)->where('ps_level','0')->get();
		}
		//获取到 b级 权限
		function getPermission_B($mg_id,$root)
		{	
			if($root == 'root'){
				return Permission::where('ps_level','1')->get();
			}
			$ps_ids = $this->get_ps_ids($mg_id);
			return Permission::whereIn('ps_id',$ps_ids)->where('ps_level','1')->get();
		}
		//获取到 c级 权限
		function getPermission_C($mg_id,$root)
		{	
			if($root == 'root'){
				return Permission::where('ps_level','2')->get();
			}
			$ps_ids = $this->get_ps_ids($mg_id);
			return Permission::whereIn('ps_id',$ps_ids)->where('ps_level','2')->get();
		}
		//获取 ps_ids
		function get_ps_ids($mg_id)
		{
			$ps_ids = Manager::where('mg_id',$mg_id)->first()->role->ps_ids;
			return explode(',', $ps_ids);
		} 

		//获取到所有的权限
		function getAllPermission()
		{
			return Permission::get()->toArray();
		}

		//保存权限信息
		function storePermission($d)
		{
			if($d['ps_pid'] != 0){
				$info = Permission::find($d['ps_pid']);
				$d['ps_level'] = (string)($info->ps_level+1);
			}else{
				$d['ps_level'] = '0';
			}
			return Permission::create($d);
		}

		//编辑权限信息
		function editPermission($d)
		{
			if($d['ps_pid'] != 0){
				$info = Permission::find($d['ps_pid']);
				$d['ps_level'] = (string)($info->ps_level+1);
			}else{
				$d['ps_level'] = '0';
			}
			//dd($d);
			return Permission::where('ps_id',$d['ps_id'])
							->update([
								'ps_name'=>$d['ps_name'],
								'ps_pid'=>$d['ps_pid'],
								'ps_c'=>$d['ps_c'],
								'ps_a'=>$d['ps_a'],
								'ps_route'=>$d['ps_route'],
								'ps_level'=>$d['ps_level']
							]);
		}

		//删除权限信息
		function delPermission($id)
		{
			$z = Permission::where('ps_pid',$id)->first();
			if($z){
				return false;
			}
			return Permission::where('ps_id',$id)->delete();
		}

		//获取一条权限信息
		function getPermissionById($id)
		{	
			return Permission::where('ps_id',$id)->first();
		}
	}
?>