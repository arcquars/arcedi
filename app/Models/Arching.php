<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arching extends Model
{
	protected $table = 'archings';
	protected $primaryKey = 'arch_id';

	public function person(){
		return $this->belongsTo('App\Models\Person', 'per_id');
	}
	
}
