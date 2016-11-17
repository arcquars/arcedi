<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
	protected $table = 'persons';
	//protected $primaryKey = 'id';

	public function archings(){
		return $this->hasMany(Arching::class, 'per_id');
	}
	
	public function getPersonByCi($ci){
		return Person::where('ci', '=', $ci)->first();
	}
	
	public static function getPersonByCiS($ci){
		return Person::where('ci', '=', $ci)->first();
	}

	public static function searchAutoComplete($search){
		return Person::select(DB::raw('CONCAT(names, " ", last_name_f, " ", last_name_m) as fullname'), 'id')->
		where('names', 'LIKE', '%'.$search.'%')->orWhere('last_name_f', 'LIKE', '%'.$search.'%')->
		orderBy('last_name_f')->lists('fullname', 'id')->toArray();
	}

	public static function getPersonById($id){
		return Person::select(DB::raw('CONCAT(names, " ", last_name_f, " ", last_name_m) as fullname'), 'id')->
		where('id', '=', $id)->
		orderBy('last_name_f')->first();
	}

}
