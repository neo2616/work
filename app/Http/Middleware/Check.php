<?php

namespace App\Http\Middleware;

use Closure;
use App\Manager;

class Check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        //判断访问的设备禁止使用手机移动设备
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_phone = (strpos($agent, "iphone"))? true : false ;
        $is_ipad = strpos($agent,"ipad")? true :false ;
        $is_android = strpos($agent,'android')?true :false ;

        if($is_phone || $is_ipad || $is_android){   //禁止使用的移动设备进行登录
            return redirect()->route('login',['error'=>'禁止使用的移动设备进行登录']);
        }
        //你被禁止访问,请你联系管理员
        try{ 
            $mg_id = \Auth::guard('back')->user()->mg_id;
            $status = Manager::find($mg_id)->status;
            if($status != 'on'){
                return redirect()->route('login',['error'=>'你被禁止访问,请你联系管理员']);
            };
        }catch(\Exception $e) {
            
           return redirect()->route('login'); 
        }
        return $next($request);
    }
}
