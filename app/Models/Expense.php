<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	protected $table = 'expenses';
	protected $primaryKey = 'exp_id';
	
	public static function archingOutgoBeetwen($dateStart, $dateEnd){
		$granTotal = Expense::where('date_expense', '>=', $dateStart)->where('date_expense', '<=', $dateEnd)->sum('total');
		return array(
				"granTotal" => $granTotal
	
		);
	}
}
