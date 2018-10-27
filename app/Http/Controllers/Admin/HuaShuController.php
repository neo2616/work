<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;

class HuaShuController extends Controller
{
	protected $roleRepository;

	public function __construct(RoleRepository $roleRepository){

		$this->roleRepository = $roleRepository;
	} 
    //话术添加显示
    public function index()
    {
    	$data = $this->roleRepository->getHuaShuData();
    	return view('admin.huashu.index',compact('data'));
    }

    //显示话术页面
    public function getadd()
    {

    	return view('admin.huashu.getadd');
    }

    //保存话术
    public function savehuashu(Request $request)
    {
    	$z = $this->roleRepository->createHuaShu($request->all());
    	return $z ? ['code'=>'1']: ['code'=>0];
    }

    //显示编辑话术的页面
    public function getedit($id)
    {
    	$info = $this->roleRepository->getinfoById($id);
    	return view('admin.huashu.getedit',compact('info'));
    }

    //保存编辑话术内容
    public function updatehuashu(Request $request)
    {

    	$z = $this->roleRepository->updateHuaShu($request->all());
    	return $z ? ['code'=>1] : ['code'=>0];
    }
}
