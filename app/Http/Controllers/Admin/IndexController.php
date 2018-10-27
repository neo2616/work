<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use App\Repositories\ManagerRepository;
use App\Repositories\NoteRepository;

class IndexController extends Controller
{
    protected $permissionRepository;
    protected $managerRepository;
    protected $noteRepository;

    public function __construct(PermissionRepository $permissionRepository,ManagerRepository $managerRepository,NoteRepository $noteRepository){

        $this->permissionRepository = $permissionRepository;
        $this->managerRepository = $managerRepository;
        $this->noteRepository = $noteRepository;

    }
    //显示后台主页面
    public function index()
    {
        //当前用户的id
        $mg_id = \Auth::guard('back')->user()->mg_id;
        try {
            $permission_a = $this->permissionRepository->getPermission_A($mg_id,'');
            $permission_b = $this->permissionRepository->getPermission_B($mg_id,'');
            
        } catch (\Exception $e) {
            //root 
            if($mg_id == '1'){
                $permission_a = $this->permissionRepository->getPermission_A($mg_id,'root');
                $permission_b = $this->permissionRepository->getPermission_B($mg_id,'root');
            }else{
                $permission_a = [];
                $permission_b = [];
            }
        }

    	return view('admin.index.index',compact('permission_a','permission_b'));
    }

    //显示welcome
    public function welcome()
    {
    	return view('admin.index.welcome');
    }

    //密码修改
    public function password(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'oldpwd'=>'required',
                'newpwd'=>'required',
                'pwdconfirm'=>'required',
            ];
            if($data['newpwd'] != $data['pwdconfirm']){
                return ['code'=>0,'error'=>'新密码和确认密码不一致!'];
            }
            $notice = [
                'oldpwd.required'=>'初始密码必须存在!',
                'newpwd.required'=>'新密码必须存在!',
                'pwdconfirm.required'=>'确认密码必须存在!',
            ];
            $validate = Validator::make($data,$rules,$notice);
            if($validate->fails()){
                $error = collect($validate->messages())->implode('0');
                return ['code'=>0,'error'=>$error];
            }

            $z = $this->managerRepository->checkOldpasswordFromDBAndsave($data);
            return $z ? ['code'=>1] : ['code'=>'0','error'=>'初始密码不符!'];
            
        }
        return view('admin.index.password');
    }

    //显示后台管理数据
    public function data()
    {
        $test = $this->noteRepository->getajaxdata();
        $data['manager'] = $test['manager'];

        $data['shuju'] = $this->noteRepository->getajaxshuju($test['ids']);
     
        return ['code'=>1,'data'=>$data];
    }

}
