<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WechatRepository;
use App\Repositories\ManagerRepository;
use App\Repositories\NotebookRepository;

class NotebookController extends Controller
{
    //私有属性
    protected $wechatRepository;
    protected $managerRepository;
    protected $notebookRepository;
    
    //构造函数
    public function __construct(WechatRepository $wechatRepository,NotebookRepository $notebookRepository,ManagerRepository $managerRepository)
    {
        $this->wechatRepository = $wechatRepository;
        $this->managerRepository = $managerRepository;
        $this->notebookRepository = $notebookRepository;
    }
   
    //note列表
    public function index()
    {
        //获取到微信号
        error_reporting(0);
        $wechatFields = $this->wechatRepository->getWechatFields();
        $notes = $this->notebookRepository->getNoteFeeds();
        $count = $wechatFields->count();

        $managers = $this->managerRepository->Managers();

        return view('admin.notebook.index',compact('wechatFields','count','notes','managers'));
    }

    //定时器功能
    public function store()
    {
        if($this->notebookRepository->checkCreated()){
            //return ['code'=>config('code.error'),'error'=>'已经创建了数据的哦'];
            $this->notebookRepository->deleteNote();
        }

        $this->notebookRepository->storeNote();
        return ['code'=>config('code.success')];
    }

    //更新数据到数据库
    public function update(Request $request)
    {
        $this->notebookRepository->updateNote($request->all());

        return ['code'=>config('code.success')];
    }

    //获取到指定的管理员下面的当日的所有记录
    public function show(Request $request)
    {
        $manager = $this->managerRepository->getManagerById($request->get('mgId'));
        $notes = $this->notebookRepository->format($manager->notes);
        
        if(!$notes->count()){
            return ['code'=>config('code.error'),'error'=>'没有数据的呢'];
        }
        return ['code'=>config('code.success'),'data'=>$notes];
    }


}
