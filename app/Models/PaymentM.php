<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PaymentM extends Model
{
	protected $table = 'payment_m';
	
	public static function getMaxPaymentByContractId($rental_m_id){
		return PaymentM::where('rental_m_id', '=', $rental_m_id)->select('date_end')->orderBy('id', 'DESC')->first();
	}
	
	public static function getDataFoVoucher($rental_m_id){
		$data = DB::table('contract')
		->join('environments', 'contract.env_id', '=', 'environments.env_id')
		->select(
				'contract.contract_id',
				'environments.code')
				->where('contract.rental_m_id', $rental_m_id)->first();
	
		return $data;
	
	}
	
	public static function archingMonthBeetwen($dateStart, $dateEnd){
		$granTotal = PaymentM::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('total');
		$totalPenality = PaymentM::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('penalty_fee');
		$totalRenta = PaymentM::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('payment_rental');
		$totalLarder = PaymentM::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('payment_larder');
		
		return array(
				"granTotal" => $granTotal, 
				"totalPenality" => $totalPenality, 
				"totalRenta" => $totalRenta, 
				"totalLarder" => $totalLarder );
	}
}
