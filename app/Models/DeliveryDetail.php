<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryDetail extends Model
{
    protected $table = 'delivery_detail';
    protected $primaryKey = 'dd_id';

    public static function getDeliveryDetailWithProduct($delivery_id){
        $data = DB::table('delivery_detail')
            ->join('products', 'delivery_detail.product_id', '=', 'products.product_id')
            ->select(
                'products.name',
                'delivery_detail.amount')
            ->where('delivery_detail.delivery_id', $delivery_id)->get();

        return $data;

    }
}
