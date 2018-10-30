<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Fangke;
use App\DomainCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{

    //显示主页
    public function index(Request $request)
    {
        error_reporting(0);
        $url = !empty($request->get('url')) ? $request->get('url') :'';
        $created_at = !empty($request->get('date')) ? $request->get('date') :date('Y-m-d');

        $whereData = [
            'url'=>$url,
            'created_at'=>$created_at
        ];

        $data = Fangke::where(function($query) use($whereData){
                        if(!empty($whereData['url'])){
                            $query->where('form_url',$whereData['url'])
                                  ->orWhere('to_url',$whereData['url']);
                        }
                    })
                    ->whereDate('created_at',$created_at)
                    ->orderBy('created_at','desc')
                    ->paginate(13);

        $count = Fangke::where(function($query) use($whereData){
                        if(!empty($whereData['url'])){
                            $query->where('form_url',$whereData['url'])
                                  ->orWhere('to_url',$whereData['url']);
                        }
                    })
                    ->whereDate('created_at',$created_at)
                    ->count();

        return view('api/test/index',compact('data','count','whereData'));
    }


    //显示网址统计数据
    public function tourl(Request $request)
    {
        error_reporting(0);
        $date = !empty($request->get('date')) ? $request->get('date'):date('Y-m-d');

        $d = Fangke::groupBy('to_url')->get();

        foreach ($d as $k => $v) {
            $d[$k]->fk_count = $this->fk_count($date,$v);
            $d[$k]->gf_count = $this->gf_count($date,$v);
        }
    
        return view('api/test/tourl',compact('d','date'));
    }

    //访客的统计
    public function fk_count($date,$v)
    {
        return Fangke::whereDate('created_at',$date)
                        ->where([ ['type','1'], ['to_url',$v['to_url']] ])
                        ->count();
    }

    //好友的统计
    public function gf_count($date,$v)
    {
        return Fangke::whereDate('created_at',$date)
                        ->where([ ['type','2'], ['to_url',$v['to_url']] ])
                        ->count();
    }


    //接口
    public function gather(Request $request)
    {
    	//url地址	类型 1 => 访客 2 =>加好友
        $cookie = md5($request->route('cookie'));
        $type = $request->route('type');

        !empty($request->route('form_url'))? $request->route('form_url'):'';
        !empty($request->route('domain'))? $request->route('domain'):'';
        !empty($cookie)? $cookie:'';
        !empty($type)? $type:'1';


    	$data = [
    		'form_url'=>$request->route('form_url'), //http:txws19.com
    		'to_url'=>$request->route('domain'),  //a.miao45.com
    		'cookie'=>$cookie,  //http:txws19.com=1540800665551    md5 加密
            'type'=>$request->route('type') // 1 为游览器 2 为加好友
    	];

        //事务处理
        DB::beginTransaction();
        try {
            //本地域名是否在数据库内保存
            if(($fk = Fangke::where('cookie',$cookie)->first()) && $type == '2'){   //加好友情况
                Fangke::where('cookie',$cookie)->update(['type'=>2]);  //修改状态
                return ;
            }
            if(!(Fangke::where('cookie',$cookie)->count()) && $type == '1'){
                $fk = Fangke::create($data);
                return ;
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
        DB::commit();
    }
}
