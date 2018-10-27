<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    protected $primaryKey = 'a_id';
	
	protected $table = 'answer';
	
    protected $fillable = [
    	'content','is_hidden','is_comment','mg_id'
    ];

    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //答案对应用户是一对多的逆向
    public function manager(){

    	return $this->belongsTo('App\Manager','mg_id','mg_id');
    }
}
