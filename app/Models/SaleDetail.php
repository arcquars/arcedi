<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaleDetail extends Model
{
    protected $table = 'sale_detail';
    protected $primaryKey = 'sd_id';

    public static function getSaleDetailWithProduct($sale_id){
        $data = DB::table('sale_detail')
            ->join('products', 'sale_detail.product_id', '=', 'products.product_id')
            ->select(
                'products.name',
                'sale_detail.price_sale',
                'sale_detail.amount')
            ->where('sale_detail.sale_id', $sale_id)->get();

        return $data;

    }
}
