<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
	//私有属性
    protected $roleRepository;
	protected $permissionRepository;

	//构造函数
	public function __construct(RoleRepository $roleRepository,PermissionRepository $permissionRepository){

        $this->roleRepository = $roleRepository;
		$this->permissionRepository = $permissionRepository;
	}

    //角色列表显示
    public function index()
    {
    	$role = $this->roleRepository->getRoleMember();
    	return view('admin.role.index',compact('role'));
    }

    //角色删除
    public function del(Request $request)
    {
    	if($request->isMethod('post')){
    		$role_id = $request->get('id');

    		return $this->roleRepository->delRoleById($role_id) ? ['code'=>1] : ['code'=>0];
    	}
    }

    //显示角色添加
    public function getroleview()
    {
    	return view('admin.role.roleview');
    }

    //角色添加数据处理
    public function storerole(StoreRoleRequest $request)
    {
    	if($request->isMethod('post')){

    		return $this->roleRepository->storeRole($request->all()) ? ['code'=>1] : ['code'=>0,'error'=>'添加失败!'];
    	}
    }

    //权限分配页面显示
    public function fp_permission($id)
    {
        $info = $this->roleRepository->getRoleById($id);
        $mg_id = \Auth::guard('back')->user()->mg_id;

        $permission_a = $this->permissionRepository->getPermission_A('1','root');
        $permission_b = $this->permissionRepository->getPermission_B('1','root');
        $permission_c = $this->permissionRepository->getPermission_C('1','root');
        $ps_ids_arr = explode(',',$this->roleRepository->getRoleById($id)->ps_ids);
        
        return view('admin.role.fp_permission',compact('info','permission_a','permission_b','permission_c','ps_ids_arr'));
    }

    //权限分配保存
    public function fp_savePermission(Request $request)
    {
        $data = $request->all();
        return $this->roleRepository->storeIdsAndCa($data)? ['code'=>1] : ['code'=>0];
    }

}
