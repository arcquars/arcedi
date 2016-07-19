<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BuyDetail extends Model
{
    protected $table = 'buy_detail';
    protected $primaryKey = 'bd_id';

    public static function getBuyDetailWithProduct($buy_id){
        $data = DB::table('buy_detail')
            ->join('products', 'buy_detail.product_id', '=', 'products.product_id')
            ->select(
                'products.name',
                'buy_detail.price',
                'buy_detail.amount',
                'buy_detail.available')
            ->where('buy_detail.buy_id', $buy_id)->get();

        return $data;

    }
}
