<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    protected $primaryKey = 'q_id';
	
	protected $table = 'question';
	
    protected $fillable = [
    	'title','mg_id'
    ];

    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //建立答案一对多的关系
    public function answer(){

    	return $this->belongsToMany('App\Answer','question_answer','question_id','answer_id');
    }

    
}
