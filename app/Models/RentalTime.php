<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalTime extends Model
{
	protected $table = 'rental_time';
	
	public static function getById($rental_t_id){
		return RentalTime::where('rt_id', '=', $rental_t_id)->first();
	}
	
	public static function archingContractTimeBeetwen($dateStart, $dateEnd){
		$granTotal = RentalTime::where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd)->sum('payment');
		return array(
				"granTotal" => $granTotal
				
		);
	}
}
