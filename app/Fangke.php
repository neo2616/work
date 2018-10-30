<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fangke extends Model
{
    protected $primaryKey = 'id';
	
	protected $table = 'fangke';
	
    protected $fillable = [
    	'cookie','form_url','to_url','type'
    ];

}
