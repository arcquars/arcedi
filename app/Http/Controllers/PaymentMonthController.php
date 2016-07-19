<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PaymentMount;

class PaymentMonthController extends Controller
{
	protected $paymentMonth;
    
	/**
	 * Inject the User Repository
	 */
	public function __construct(PaymentMount $paymentMonth)
	{
		$this->middleware('auth');
		$this->paymentMonth = $paymentMonth;
	}
	
	public function getLastPayment($payment){
		
	}
}
