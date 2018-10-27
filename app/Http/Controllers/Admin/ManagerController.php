<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ManagerRepository;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreManagerRequest;

class ManagerController extends Controller
{
	//私有属性
	protected $managerRepository;

	//构造方法
	public function __construct(ManagerRepository $managerRepository){

		$this->managerRepository = $managerRepository;
	}

    //跳转到登陆页面
    public function main()
    {
        return redirect('/login');
    }

    //获取登录页面
    public function getLogin(Request $request)
    {
        $error = $request->get('error');
    	return view('admin.manager.login',compact('error'));
    }

    //post提交登录数据
    public function store_login(StoreLoginRequest $request)
    {
    	//查询管理员是什么状态 是否被禁止(中间件)
    	//获取到当前的session id 判断是否重复登录(中间件)
        
    	if(Auth::guard('back')->attempt(['mg_name'=>$request['mg_name'],'password'=>$request['password']])){
    		//获取到ip地址
    		$ip = $request->getClientIps();
    		$this->managerRepository->updateManagerIp($ip);
    		return ['code'=>'1'];
    	};
    	return ['code'=>'0','error'=>'用户名或者密码错误!'];
    }

    //管理员退出
    public function logout(Request $request)
    {
        $this->managerRepository->last_login_time();
        Auth::guard('back')->logout();
        return redirect()->route('login');
    }

    //管理员ajax数据
    public function ajax(Request $request)
    {
        error_reporting(0);
        $page = $request->get('page') ? $request->get('page') : '0'; //当前页码
        $pagesize = $request->get('limit') ? $request->get('limit') :'7'; //显示的条数
        $keyword = $request->get('k') ? $request->get('k') :''; //显示的条数
        $d = $this->managerRepository->myPaginate($page,$pagesize);
        $data = $this->managerRepository->getManagers($d,$keyword);
        //dd($data);  
        return $data; 
    }
    //管理员显示列表
    public function index()
    {
        $count = $this->managerRepository->managerCount();
        return view('admin.manager.index',compact('count'));
    }

    //管理员添加页面显示
    public function getmanagerview()
    {
        $roleidAndRolename = $this->managerRepository->roleidAndRolename();
        return view('admin.manager.getmanagerview',compact('roleidAndRolename'));
    }

    //管理员数据保存
    public function storemanager(StoreManagerRequest $request)
    {   
        if($this->managerRepository->mg_nameUnique($request['mg_name'])){
            return ['code'=>0,'error'=>'用户名称重复了,使用其他的名称试试!'];
        };
        return $this->managerRepository->storeManager($request->all()) ? ['code'=>1] : ['code'=>0,'error'=>'添加失败'];
    }

    //管理员删除
    public function delmanager(Request $request)
    {
        $id = $request->get('id');
        return $this->managerRepository->delmanagerById($id) ? ['code'=>1] : ['code'=>0];
    }

    //修改管理员状态
    public function setstatus(Request $request)
    {
        $id = $request->get('id');
 
        $data = $this->managerRepository->resetStatus($id);
        //dd($data);
        return $data ? ['code'=>1,'status'=>$data] : ['code'=>0] ;
    }

    //管理员编辑页面
    public function getEditManagerView(Request $request,$id)
    {   
        $manager = $this->managerRepository->getManagerById($id);
     
        $roleidAndRolename = $this->managerRepository->roleidAndRolename();
        return view('admin.manager.geteditmanagerview',compact('roleidAndRolename','manager'));
    }

    //管理员数据保存
    public function editemanager(StoreManagerRequest $request)
    {
        $data = $request->all(); 
        
        $z = $this->managerRepository->editManagerById($data);
        return $z ? ['code'=>1] : ['code'=>0];
    }

    //用户密码修改
    public function resetuser(Request $request,$id)
    {   
        if($request->isMethod('post')){
            $pwdAndmgId = $request->only('mg_id','password');
            return $this->managerRepository->resetPwdById($pwdAndmgId) ? ['code'=>1] : ['code'=>0];
            
        }
        $manager = $this->managerRepository->getManagerById($id);
        return view('admin.manager.resetuser',compact('manager'));
    }
}
