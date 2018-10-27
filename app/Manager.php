<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
	protected $primaryKey = 'mg_id';
	
	protected $table = 'manager';
	
    protected $fillable = [
    	'mg_name','password','role_id','sesstion_id','status','login_ip','last_login_time','desc'
    ];

    //建立与角色一对一关系
    public function role(){
    	return $this->hasOne('App\Role','role_id','role_id');
    }

    //建立与微信一对多的关系
    public function weixin(){
        return $this->hasMany('App\Weixin','mg_id','mg_id');
    }

    //建立与note 一对多的关系
    public function notes()
    {
        return $this->hasMany('App\Note','mg_id','mg_id');
    }


    use SoftDeletes;
    protected $dates      = ['deleted_at'];
}
