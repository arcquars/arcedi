<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RentalMonth extends Model
{
	protected $table = 'rental_month';
	protected $primaryKey = 'rm_id';
	
	public static function getById($rental_m_id){
		return RentalMonth::where('rm_id', '=', $rental_m_id)->first();
	}
	
	public static function archingContractMonthBeetwen($dateStart, $dateEnd){
		$granTotal = RentalMonth::where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd)->where('state', '=', 1)->sum('warranty');
		return array(
				"granTotal" => $granTotal
	
		);
	}

	public static function getRentalMonthById($rm_id){
		$data = DB::table('rental_month')
			->join('contract', 'contract.rental_m_id', '=', 'rental_month.rm_id')
			->join('environments', 'environments.env_id', '=', 'contract.env_id')
			->select(
				'contract.per_id',
				'contract.contract_id',
				'rental_month.warranty',
			'rental_month.date_payment_warranty',
				'environments.code',
				'environments.type')
			->where('rental_month.rm_id', $rm_id)->first();

		return $data;

	}
}
