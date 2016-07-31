<?php

namespace App\Http\Controllers;

use App\Models\BuyDetail;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use App\Models\SaleDetail;
use App\Models\StoreMovements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use App\Http\Requests;

class StoreDetailController extends Controller
{
    public function __construct() {
        $this->middleware ( 'is_admin' );
    }

    public function index() {
        $filter = \DataFilter::source ( Product::where ( [
            'products.delete' => 0
        ] )->where('store_movements.active', '1')
            ->join('store_movements', 'store_movements.product_id', '=', 'products.product_id')
            ->select('products.product_id',
                'products.name',
                'products.code',
                'products.price_reference',
                'store_movements.total'
            )
        );

        $grid = \DataGrid::source ( $filter );
        $grid->attributes(array("class"=>"table table-striped arcedi_table"));
        $grid->add ( 'product_id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'name', 'Nombre' );
        $grid->add ( 'code', 'Codigo' );
        $grid->add ( 'price_reference', 'Precio' );
        $grid->add ( 'total', 'Cantidad' );

        $grid->row(function ($row) {
            $row->cell('total')->style("text-align: right;");
        });

        $grid->orderBy ( 'product_id', 'asc' );
        $grid->paginate ( 10 );

        return view ( 'storedetail.home', compact ( 'filter', 'grid' ) );

    }

    public function saleProducts() {
        return view ( 'storedetail.saleProducts');
    }

    public function findTypeheadSale(Request $request)
    {
        try {

            $statusCode = 200;

            $source1 = Product::getProductByStoryMovementsSaleQuery($request->input('search'));
            $response = [
                "source" => $source1,
            ];
        } catch ( Exception $e ) {
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function postSaveSaledetail(Request $request) {
        try {
            $valid = true;
            $statusCode = 200;

            $datos = input::all();

            $products = json_decode($datos['lista'], true);

            $sale = new Sale();
            $sale->date_sale = $datos['dateSale'];
            $sale->detail = $datos['detail'];
            $sale->total = $datos['total'];
            $sale->ci = $datos['ci'];
            $sale->store_id = 1;
            $sale->user_id = Auth::id();
            $sale->save();

            foreach($products as $product){
                $buyDetails = BuyDetail::where("product_id", $product['id'])->where("available", ">", 0)->get();
                $amount = $product['quantity'];
                foreach($buyDetails as $buyDetail){
                    if($amount > 0){
                        if($amount <= $buyDetail->available){
                            $saleDetail = new SaleDetail();
                            $saleDetail->price_sale = $product['coste'];
                            $saleDetail->price_buy = $buyDetail->price;
                            $saleDetail->amount = $amount; // important
                            $saleDetail->sale_id = $sale->sale_id;
                            $saleDetail->product_id = $product['id'];
                            $saleDetail->save();

                            $storeM = StoreMovements::where('product_id', $product['id'])->where('active', 1)->first();
                            $storeM->active = 0;
                            $storeM->save();

                            $movementNew = new StoreMovements();
                            $movementNew->sale_detail = $saleDetail->sd_id;
                            $movementNew->amount = $amount; // important
                            $movementNew->total = $storeM->total - $amount; // important
                            $movementNew->active = 1;
                            $movementNew->product_id = $product['id'];
                            $movementNew->save();

                            $buyDetail->available = $buyDetail->available - $amount; // important
                            $buyDetail->save();

                            $amount = 0;
                        }else{
                            $saleDetail = new SaleDetail();
                            $saleDetail->price_sale = $product['coste'];
                            $saleDetail->price_buy = $buyDetail->price;
                            $saleDetail->amount = $buyDetail->available; // important
                            $saleDetail->sale_id = $sale->sale_id;
                            $saleDetail->product_id = $product['id'];
                            $saleDetail->save();

                            $storeM = StoreMovements::where('product_id', $product['id'])->where('active', 1)->first();
                            $storeM->active = 0;
                            $storeM->save();

                            $movementNew = new StoreMovements();
                            $movementNew->sale_detail = $saleDetail->sd_id;
                            $movementNew->amount = $buyDetail->available; // important
                            $movementNew->total = $storeM->total - $buyDetail->available;
                            $movementNew->active = 1;
                            $movementNew->product_id = $product['id'];
                            $movementNew->save();

                            $amount = $amount - $buyDetail->available; // important
                            $buyDetail->available = 0;
                            $buyDetail->save();

                        }
                    }
                }

            }

            $response = [
                "data" => $valid
            ];

        } catch ( Exception $e ) {
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function saleHistoric() {
        $filter = \DataFilter::source ( Sale::where ( [
            'delete' => 0
        ] )->whereNotNull("store_id") );

        $filter->add('date_sale','YYYY-MM-dd','daterange')->format('Y-m-d', 'en');
        $filter->submit('buscar');
        $filter->reset('limpiar');
        $filter->build();

        $grid = \DataGrid::source ( $filter );
        $grid->attributes(array("class"=>"table table-striped arcedi_table"));
        $grid->add ( 'sale_id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'date_sale|strtotime|date[Y-m-d]', 'Fecha Venta' );
        $grid->add ( 'ci', 'CI' );
        $grid->add ( 'total', 'Total' );
        $grid->add ( 'busy', 'Acciones' )->cell( function ($value, $row) {
            return
                '
                    <a href="#" onclick="openViewSaleDetail('.$row->sale_id.')" data-toggle="tooltip" title="Ver Detalle de compra"><span class="fa fa-arrows-alt" aria-hidden="true"></span></a>
                ';
        })->style("text-align: center;");

        $grid->row(function ($row) {
            $row->cell('busy')->style("text-align: center;");
        });

        $grid->orderBy ( 'sale_id', 'asc' );
        $grid->paginate ( 10 );

        return view ( 'storedetail.saleHistoric', compact ( 'filter', 'grid' ) );

    }
}
