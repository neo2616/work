<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    protected $primaryKey = 'ps_id';
	
	protected $table = 'permission';
	
    protected $fillable = [
    	'ps_name','ps_pid','ps_c','ps_a','ps_route','ps_level'
    ];

    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];
}
