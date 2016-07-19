<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentA extends Model
{
	protected $table = 'payment_a';
	
	public static function getMaxPaymentByContractId($rental_a_id){
		return PaymentA::where('rental_a_id', '=', $rental_a_id)->select('date_end')->orderBy('id', 'DESC')->first();
	}
	
	public static function archingAntiBeetwen($dateStart, $dateEnd){
		$granTotal = PaymentA::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('total');
		$totalPenality = PaymentA::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('penalty_fee');
		$totalLarder = PaymentA::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('payment_larder');
	
		return array(
				"granTotal" => $granTotal,
				"totalPenality" => $totalPenality,
				"totalLarder" => $totalLarder );
	}
}

