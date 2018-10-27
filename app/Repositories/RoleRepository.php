<?php 
	namespace App\Repositories;

	use DB;
	use App\Role;
	use App\Permission;

	class RoleRepository
	{
		//获取用户组成员
		function getRoleMember()
		{
			return Role::get();
		}
		//删除指定的用户
		function delRoleById($id)
		{
			return Role::where('role_id',$id)->delete();
		}
		//新增用户组
		function storeRole(array $data)
		{
			return Role::create($data);
		}

		//获取到指定的用户
		function getRoleById($id)
		{
			return Role::find($id);
		}

		//保存IDS 和 CA
		function storeIdsAndCa(array $d)
		{
			$pdIdsString = implode(',',$d['quanxian']);		// ps_id 字符串
			$ps_ca = Permission::whereIn('ps_id',$d['quanxian'])
							->select(\DB::raw("concat(ps_c,'-',ps_a) as ca"))
							->whereIn('ps_level',['1','2'])
							->pluck('ca');
			$ps_ca_string = implode(',', $ps_ca->toArray());

			return Role::where('role_id',$d['role_id'])->update(['ps_ids'=>$pdIdsString,'ps_ca'=>$ps_ca_string]);
		}

		//新建话术
		function createHuaShu($d)
		{
			$mg_id = \Auth::guard('back')->user()->mg_id;
			$now = date('Y-m-d H:i:s',time());
			return DB::table('huashu')->insert(['content'=>$d['content'],'mg_id'=>$mg_id,'created_at'=>$now]);
		}

		//获取所有的话术信息
		function getHuaShuData()
		{
			return DB::table('huashu')->simplePaginate(11);
		}

		//编辑话术
		function updateHuaShu($d)
		{
			return DB::table('huashu')->where('huashu_id',$d['id'])->update(['content'=>$d['content']]);
		}

		//获取一条话术
		function getinfoById($id)
		{
			return DB::table('huashu')->where('huashu_id',$id)->first();
		}
	}

?>