<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentA extends Model
{
	protected $table = 'payment_a';
	
	public static function getMaxPaymentByContractId($rental_a_id){
		return PaymentA::where('rental_a_id', '=', $rental_a_id)->select('date_end')->orderBy('id', 'DESC')->first();
	}
	
	public static function archingAntiBeetwen($dateStart, $dateEnd){
		$granTotal = PaymentA::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('total');
		$totalPenality = PaymentA::select(DB::raw('sum(penalty_fee*penalty_day) as penalty_fee'))->where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->first();
		$totalLarder = PaymentA::where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)->sum('payment_larder');
	
		return array(
				"granTotal" => $granTotal,
				"totalPenality" => $totalPenality->penalty_fee,
				"totalLarder" => $totalLarder );
	}
}

