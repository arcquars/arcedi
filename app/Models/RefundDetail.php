<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefundDetail extends Model
{
    protected $table = 'refund_detail';
    protected $primaryKey = 'rd_id';

    public static function getRefundDetailWithProduct($refund_id){
        $data = DB::table('refund_detail')
            ->join('products', 'refund_detail.product_id', '=', 'products.product_id')
            ->select(
                'products.name',
                'refund_detail.amount')
            ->where('refund_detail.refund_id', $refund_id)->get();

        return $data;

    }
}
