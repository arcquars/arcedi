<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';



    public static function codeIsValid($value){
        return Product::where('code', 'like', $value)->first();
    }

    public static function nameIsValid($value){
        return Product::where('name', 'like', $value)->first();
    }

    public static function getProductByMovementsQuery($query=""){
        $data = DB::table('products')
            ->join('movements', 'products.product_id', '=', 'movements.product_id')
            ->select(
                'products.product_id as id',
                DB::raw("CONCAT(products.name,' || ',products.code)  AS name")
                )
            ->where('movements.active', '1')->where('products.name','like', '%'.$query.'%')->get();

        return $data;

    }

    public static function getProductByMovementsSaleQuery($query=""){
        $data = DB::table('products')
            ->join('movements', 'products.product_id', '=', 'movements.product_id')
            ->select(
                'products.product_id as id',
                DB::raw("CONCAT(products.name,' || ',products.code, ' || ', movements.total, ' || ', products.price_reference)  AS name")
            )
            ->where('movements.active', '1')->where('products.name','like', '%'.$query.'%')->where('movements.total','>', 0)->get();

        return $data;

    }

    public function movements()
    {
        return $this->hasMany('App\Models\Movements');
    }
}
