<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMonth extends Model
{
	protected $table = 'payment_month';
	
	public static function getLastPaymentByRentalId($rental_m_id){
		return PaymentMonth::where('rental_m_id', '=', $rental_m_id)->orderBy('date', 'DESC')->first();
	}
	
	public static function getCalcPenalty($datePaymentMonth, $penaltyFee){
		$dayPenalty = Config::get('arcedu.dayPenalty');
		
		$unixtime = strtotime($datePaymentMonth);
		
		$monthPayment = date('Y-m', $unixtime); //month
		$monthNow = date("Y-m");
		
		$paymentPenalty = 0;
		if($monthPayment == $monthNow){
			$dayM = date('d', $unixtime);
			if($dayM >= $dayPenalty){
				$paymentPenalty = ($dayM - $dayPenalty)* $penaltyFee;
			}
		}
		
		return $paymentPenalty;
	}
}
