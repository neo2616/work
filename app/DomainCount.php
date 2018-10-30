<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainCount extends Model
{
    protected $primaryKey = 'id';
	
	protected $table = 'domain_count';
	
    protected $fillable = [
    	'domian','fangke_count','gf_count','fk_id'
    ];

}
