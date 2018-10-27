<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    protected $primaryKey = 'note_id';
	
	protected $table = 'note';
	
    protected $fillable = [
    	'gf_counts','rg_counts','rg_platform','money_in_counts','wx_id','mg_id'
    ];

    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //建立微信号和笔记的关系,,一对一
    public function weixin()
    {
    	return $this->hasOne('App\Weixin','wx_id','wx_id');
    }

    //建立笔记 与 管理员的关系
    public function manager()
    {
        return $this->hasOne('App\Manager','mg_id','mg_id');
    }
}
