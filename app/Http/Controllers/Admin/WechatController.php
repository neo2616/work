<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WechatRepository;

class WechatController extends Controller
{
    //私有属性
    protected $wechatRepository;

    //构造函数
    public function __construct(WechatRepository $wechatRepository)
    {
        $this->wechatRepository = $wechatRepository;
    }
        
    //Wechat管理列表
    public function index(Request $request)
    {
        error_reporting(0);
        $k = !empty($request->get('k')) ? $request->get('k') : '';
        $wechat = $this->wechatRepository->getWechatFeeds($k);
        
        return view('admin.wechat.index',compact('wechat','k'));
    }

    //微信创建页面
    public function create()
    {
        return view('admin.wechat.create');
    }

    //存入微信到数据库
    public function store(Request $request)
    {
        $data = explode(',',rtrim($request->get('wx_names'),','));
        $this->wechatRepository->saveWechat($data);
        
        return ['code'=>config('code.success')];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    //显示编辑的页面
    public function edit($id)
    {
        $wechat = $this->wechatRepository->getWechat($id);
        $mgAndMgId = $this->wechatRepository->getMgAndMgId();

        return view('admin.wechat.edit',compact('wechat','mgAndMgId'));
    }

    //更新数据
    public function update(Request $request, $id)
    {
        $this->wechatRepository->wechatUpdate($request->all(),$id);

        return ['code'=>config('code.success'),'url'=>$_SERVER['HTTP_REFERER']];
    }

    //删除指定的微信信息
    public function destroy($id)
    {
        $this->wechatRepository->delete($id);

        return ['code'=>config('code.success')];
    }
}
