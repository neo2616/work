<?php 
	/***********递归方式获取上下级权限信息****************/
	function generateTree($data){
	    $items = array();
	    foreach($data as $v){
	        $items[$v['ps_id']] = $v;
	    }
	    $tree = array();
	    foreach($items as $k => $item){
	        if(isset($items[$item['ps_pid']])){
	            $items[$item['ps_pid']]['son'][] = &$items[$k];
	        }else{
	            $tree[] = &$items[$k];
	        }
	    }
	    return getTreeData($tree);
	}
	function getTreeData($tree,$level=0){
	    static $arr = array();
	    foreach($tree as $t){
	        $tmp = $t;
	        unset($tmp['son']);
	        //$tmp['level'] = $level;
	        $arr[] = $tmp;
	        if(isset($t['son'])){
	            getTreeData($t['son'],$level+1);
	        }
	    }
	    return $arr;
	}

	function text(){
		echo "func";
	}
	/***********递归方式获取上下级权限信息****************/
	/**
	 * 获取当前控制器名
	 */
	function getCurrentControllerName()
	{
	    return getCurrentAction()['controller'];
	}

	/**
	 * 获取当前方法名
	 */
	function getCurrentMethodName()
	{
	    return getCurrentAction()['method'];
	}


	/**
	 * 获取当前控制器与操作方法的通用函数
	 */
	function getCurrentAction()
	{
	    $action = \Route::current()->getActionName();
	    //dd($action);exit;
	    //dd($action);
	    list($class, $method) = explode('@', $action);
	    //$classes = explode(DIRECTORY_SEPARATOR,$class);
	    $class = str_replace('Controller','',substr(strrchr($class,DIRECTORY_SEPARATOR),1));

	    return ['controller' => $class, 'method' => $method];
	}

	//是否为超级用户
	function is_root()
	{
		return (\Auth::guard('back')->user()->mg_id == 1);
	}

	//修改状态的函数
	function status($int,$t1,$t2)	//绿灰</span>
	{
		if($int == 1){
			return '<span class="layui-badge layui-bg-green">'.$t1.'</span>';
		}
		if($int == 2){
			return '<span class="layui-badge layui-bg-gray">'.$t2.'</span>';
		}
	}

	//修改状态的函数
	function mg_status($int,$t1,$t2)
	{
		if($int == 'on'){
			return '<span class="layui-badge layui-bg-green">'.$t1.'</span>';
		}
		if($int == 'off'){
			return '<span class="layui-badge layui-bg-gray">'.$t2.'</span>';
		}
	}
?>