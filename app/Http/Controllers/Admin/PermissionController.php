<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use App\Http\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
	//私有属性
	protected $permissionRepository;

	//构造函数
    public function __construct(PermissionRepository $permissionRepository){

        $this->permissionRepository = $permissionRepository;

    }

    //权限列表的显示
    public function index()
    {
    	$data = $this->permissionRepository->getAllPermission();
    	$tree = generateTree($data);

    	return view('admin.permission.index',compact('tree'));
    }

    //显示添加权限view
    public function getPermissionView()
    {
    	$data = $this->permissionRepository->getAllPermission();
    	$tree = generateTree($data);
    	return view('admin.permission.getpermissionview',compact('tree'));
    }

    //保存权限信息
    public function storePermission(StorePermissionRequest $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$z = $this->permissionRepository->storePermission($data);

    		return $z ? ['code'=>1] : ['code'=>0];
    	}
    }

    //显示编辑权限视图
    public function getStorePermissionView($id)
    {
    	$data = $this->permissionRepository->getAllPermission();
    	$tree = generateTree($data);
    	$info = $this->permissionRepository->getPermissionById($id);

    	return view('admin.permission.getstorepermissionview',compact('tree','info'));
    }

    //保存编辑权限
    public function editPermission(StorePermissionRequest $request)
    {
    	$data = $request->all();
    	$z = $this->permissionRepository->editPermission($data);

    	return $z ? ['code'=>1] : ['code'=>0];
    }

    //删除权限信息
    public function delPermission(Request $request)
    {
    	$id = $request->get('id');
    	$z = $this->permissionRepository->delPermission($id);
    	return $z ? ['code'=>1] : ['code'=>0];
    }


}
