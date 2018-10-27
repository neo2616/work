<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weixin extends Model
{
    protected $primaryKey = 'wx_id';
	
	protected $table = 'weixin';
	
    protected $fillable = [
    	'wx_name','mg_id','wx_status','desc'
    ];


    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //微信和管理员关系 一对一
    public function manager()
    {
    	return $this->hasOne('App\Manager','mg_id','mg_id');
    }


}
