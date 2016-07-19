<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	protected $table = 'persons';
	//protected $primaryKey = 'id';
	
	public function getPersonByCi($ci){
		return Person::where('ci', '=', $ci)->first();
	}
	
	public static function getPersonByCiS($ci){
		return Person::where('ci', '=', $ci)->first();
	}
}
