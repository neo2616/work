<?php

namespace App\Http\Middleware;

use Closure;
use App\Manager;

class Fanqiang
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
        
        $mg_id = \Auth::guard('back')->user()->mg_id;
        if($mg_id != 1){
            $ps_ca = Manager::find($mg_id)->role->ps_ca;
            //获取到当前的ca 
            $nowCA = strtolower(getCurrentControllerName() . '-' . strtolower(getCurrentMethodName()));
            /*var_dump($nowCA);
            
            var_dump($ps_ca);*/
            if(strpos($ps_ca,$nowCA) === false){
                exit('你没有该权限!'.$mg_id);
            }
        };
        return $next($request);
    }
}
