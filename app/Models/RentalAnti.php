<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RentalAnti extends Model
{
   	protected $table = 'rental_anti';
   	protected $primaryKey = 'ra_id';
   	
   	public static function archingContractAntiBeetwen($dateStart, $dateEnd){
   		$granTotal = RentalAnti::where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd)->where('state', '=', 1)->sum('anticretico');
   		return array(
   				"granTotal" => $granTotal
   	
   		);
   	}

	public static function getRentalAntiById($ra_id){
		$data = DB::table('rental_anti')
			->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
			->join('environments', 'environments.env_id', '=', 'contract.env_id')
			->select(
				'contract.per_id',
				'contract.contract_id',
				'rental_anti.anticretico',
				'rental_anti.date_payment_warranty',
				'environments.code')
			->where('rental_anti.ra_id', $ra_id)->first();

		return $data;

	}
}
