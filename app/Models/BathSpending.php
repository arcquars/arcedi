<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BathSpending extends Model
{
    protected $table = 'bacth_spending';
    protected $primaryKey = 'bs_id';

    public static function bathSpendingTotalBeetwenDate($dateStart, $dateEnd){
        $granTotal = BathSpending::where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd)->sum('outgo');

        return $granTotal;
    }
}
