<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $primaryKey = 'role_id';
	
	protected $table = 'role';
	
    protected $fillable = [
    	'role_name','ps_ids','ps_ca'
    ];

    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];
}
