<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Admin\ManagerController@main');

//后台管理--获取登录页面
Route::get('/login','Admin\ManagerController@getLogin')->name('login');
//后台管理--post提交登录数据
Route::post('/store_login','Admin\ManagerController@store_login');
//后台管理--管理员退出登录
Route::get('/logout','Admin\ManagerController@logout');


Route::group(['middleware'=>'check'],function(){

	//后台管理--显示后台主页面
	Route::get('/index/index','Admin\IndexController@index');
	//后台管理--显示welcome
	Route::get('/welcome','Admin\IndexController@welcome');
	//后台管理--显示数据
	Route::post('/welcome/data','Admin\IndexController@data');
	//自己的密码修改
	Route::match(['get','post'],'/password','Admin\IndexController@password');
	//禁止翻墙
	Route::group(['middleware'=>'fanqiang'],function(){

		//后台管理--管理员列表的显示
		Route::get('/manager/index','Admin\ManagerController@index');
		//后台管理--管理员ajax分页查询
		Route::post('/manager/ajax','Admin\ManagerController@ajax');
		//后台管理--管理员添加页面显示
		Route::get('/manager/getmanagerview','Admin\ManagerController@getmanagerview');
		//后台管理--管理员数据保存
		Route::post('/manager/storemanager','Admin\ManagerController@storemanager');
		//后台管理--管理员删除
		Route::post('/manager/delmanager','Admin\ManagerController@delmanager');
		//后台管理--管理员状态
		Route::post('/manager/setstatus','Admin\ManagerController@setstatus');
		//后台管理--管理员编辑页面显示
		Route::get('/manager/geteditmanagerview/{mg_id}','Admin\ManagerController@geteditmanagerview');
		//后台管理--管理员编辑保存数据
		Route::post('/manager/editemanager','Admin\ManagerController@editemanager');
		//后台管理--用户密码修改
		Route::match(['get','post'],'/manager/resetuser/{mg_id}','Admin\ManagerController@resetuser');

		//后台管理--权限列表的显示
		Route::get('/permission/index','Admin\PermissionController@index');
		//后台管理--显示添加权限
		Route::get('/permission/getpermissionview','Admin\PermissionController@getPermissionView');
		//后台管理--添加权限数据保存
		Route::post('/permission/storepermission','Admin\PermissionController@storePermission');
		//后台管理--删除权限数据
		Route::post('/permission/delpermission','Admin\PermissionController@delPermission');
		//后台管理--显示编辑权限视图
		Route::get('/permission/getstorepermissionview/{ps_id}','Admin\PermissionController@getStorePermissionView');
		//后台管理--保存编辑权限
		Route::post('/permission/editpermission','Admin\PermissionController@editPermission');

		//后台管理--角色列表显示
		Route::get('/role/index','Admin\RoleController@index');
		//后台管理--角色删除
		Route::post('role/del','Admin\RoleController@del');
		//后台管理--显示角色添加
		Route::get('/role/getroleview','Admin\RoleController@getroleview');
		//后台管理--角色添加数据处理
		Route::post('/role/storerole','Admin\RoleController@storerole');
		//后台管理--权限分配页面显示
		Route::get('/role/fp_permission/{role_id}','Admin\RoleController@fp_permission');
		//后台管理--权限分配保存
		Route::post('/role/fp_savepermission','Admin\RoleController@fp_savePermission');

		////////////////////////////////////////////////// 微信管理10/25 /////////////////////////////////////////////////////
		//微信资源路由
		Route::resource('/wechat','Admin\WechatController');

		////////////////////////////////////////////////// 微信管理10/25 /////////////////////////////////////////////////////

		////////////////////////////////////////////////// 笔记修定10/25 /////////////////////////////////////////////////////
		//笔记显示列表
		Route::get('/notebook/index','Admin\NotebookController@index');
		//更新数据
	    Route::post('/notebook/update','Admin\NotebookController@update');
	    //显示note 数据
	    Route::post('/notebook/show','Admin\NotebookController@show');
		//定时器定期生成记录
		Route::get('/notebook/store','Admin\NotebookController@store');
		////////////////////////////////////////////////// 笔记修定10/25 /////////////////////////////////////////////////////


		////////////////////////////////////////////////// 笔记搜索10/25 /////////////////////////////////////////////////////
		//后台管理--搜索笔记信息
		Route::get('/searchnote/index','Admin\SearchNoteController@index');

		//后台管理--查看提交笔记信息
		Route::get('/checknote/index','Admin\ChecknoteController@index');
		//后台管理--获取提交笔记数据
		Route::post('/checknote/datainit','Admin\ChecknoteController@datainit');
		//后台管理--退回提交
		Route::post('/checknote/tuihui','Admin\ChecknoteController@tuihui');
		////////////////////////////////////////////////// 笔记搜索10/25 /////////////////////////////////////////////////////


		//后台管理--话术列表显示
		Route::get('/huashu/index','Admin\HuaShuController@index');
		//后台管理--显示话术页面
		Route::get('/huashu/getadd','Admin\HuaShuController@getadd');
		//后台管理--显示编辑话术页面
		Route::get('/huashu/getedit/{id}','Admin\HuaShuController@getedit');
		//后台管理--保存编辑话术
		Route::post('/huashu/updatehuashu','Admin\HuaShuController@updatehuashu');
		//后台管理--保存话术
		Route::post('/huashu/savehuashu','Admin\HuaShuController@savehuashu');

		//后台管理--问题显示
		Route::get('/question/index','Admin\QuestionController@index');
		//后台管理--问题添加显示
		Route::get('/question/getaddview','Admin\QuestionController@getaddview');
		//后台管理--问题创建
		Route::post('/question/createquestion','Admin\QuestionController@createquestion');
		//后台管理--显示回答问题页面
		Route::get('/question/getanswerview/{q_id}','Admin\QuestionController@getanswerview');
		//后台管理--保存答案
		Route::post('/question/createanswer','Admin\QuestionController@createanswer');
	});
});



