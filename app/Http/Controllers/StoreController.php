<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEditProductPostRequest;
use App\Http\Requests\StoreProductPostRequest;
use App\Models\BuyDetail;
use App\Models\Delivery;
use App\Models\DeliveryDetail;
use App\Models\Movements;
use App\Models\Product;
use App\Models\Refund;
use App\Models\RefundDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\StoreMovements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as input;
use App\Models\Buy;

//use App\Http\Requests;

class StoreController extends Controller
{
    public function __construct() {
        $this->middleware ( 'is_admin' );
    }

    public function index() {
        $filter = \DataFilter::source ( Product::where ( [
            'products.delete' => 0
        ] )->where('movements.active', '1')
            ->join('movements', 'movements.product_id', '=', 'products.product_id')
            ->select('products.product_id',
                'products.name',
                'products.code',
                'products.price_reference',
                'movements.total'
            )
        );

        $grid = \DataGrid::source ( $filter );
        $grid->attributes(array("class"=>"table table-striped arcedi_table"));
        $grid->add ( 'product_id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'name', 'Nombre' );
        $grid->add ( 'code', 'Codigo' );
        $grid->add ( 'price_reference', 'Precio' );
        $grid->add ( 'total', 'Cantidad' );
        $grid->add ( 'busy', 'Acciones' )->cell( function ($value, $row) {
            return
                '
                    <a href="#" onclick="openModelProductEdit('.$row->product_id.')" data-toggle="tooltip" title="Editar Producto"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                ';
        })->style("text-align: center;");

        $grid->row(function ($row) {
            $row->cell('busy')->style("text-align: center;");
            $row->cell('total')->style("text-align: right;");
        });

        $grid->orderBy ( 'product_id', 'asc' );
        $grid->paginate ( 10 );

        return view ( 'store.home', compact ( 'filter', 'grid' ) );

    }

    public function buyProducts() {
        return view ( 'store.buyProducts', compact ( 'filter', 'grid' ) );
    }

    public function saleProducts() {
        return view ( 'store.saleProducts');
    }

    public function deliveryProducts() {
        return view ( 'store.deliveryProducts');
    }

    public function refundProducts() {
        return view ( 'store.refundProducts');
    }

    public function postNewProduct(StoreProductPostRequest $request1) {
        $datos = input::all();
        try {
            $errors = null;

            if(var_dump(method_exists($request1, 'fails')) && $request1->fails())
                $errors = $request1->messages();
            else{
                // Crear Producto
                $product = new Product();
                $this->populateProduct( $product, $datos );
                $product->save();

                // Crear Movimiento
                $movement = new Movements();
                $movement->amount = 0;
                $movement->total = 0;
                $movement->product_id = $product->product_id;
                $movement->save();
                $statusCode = 200;

                $response = [
                    "errors" => $errors
                ];
            }

        } catch ( Exception $e ) {
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function postEditProduct(StoreEditProductPostRequest $request) {
        $datos = input::all();
        try {
            $errors = null;

            if(var_dump(method_exists($request, 'fails')) && $request->fails())
                $errors = $request->messages();
            else{
                // Get Producto
                $product = Product::find($request->product_id);
                $product->name = $request->name;
                $product->code = $request->code;
                $product->price_reference = $request->price_reference;
                $product->category = $request->category;
                $product->factory = $request->factory;
                $product->description = $request->description;
                $product->save();

                $statusCode = 200;

                $response = [
                    "errors" => $errors
                ];
            }

        } catch ( Exception $e ) {
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function validCodeProduct($value) {
        try {
            $product = Product::codeIsValid($value);
            $valid = true;
            //dd($product);
            if($product != null){
                $valid = false;
            }
            $statusCode = 200;

            $response = [
                "data" => $valid,
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

    public function validNameProduct($value) {
        try {
            $product = Product::nameIsValid($value);
            $valid = true;
            if($product != null){
                $valid = false;
            }
            $statusCode = 200;

            $response = [
                "data" => $valid,
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

    public function buyByIds($ids) {

        return view ( 'store.buy', compact ( 'ids') );
    }

    public function getProduct($product_id) {
        try {
            $product = Product::find($product_id);

            $statusCode = 200;

            $response = [
                "product" => $product,
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

    public function findTypehead(Request $request)
    {
        try {

            $statusCode = 200;

            $source1 = Product::getProductByMovementsQuery($request->input('search'));
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

    public function findTypeheadSale(Request $request)
    {
        try {

            $statusCode = 200;

            $source1 = Product::getProductByMovementsSaleQuery($request->input('search'));
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

    public function findTypeAheadStoreMovements(Request $request)
    {
        try {

            $statusCode = 200;

            $source1 = Product::getProductByStoreMovements($request->input('search'));
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

    private function populateProduct($product, $datos) {
        if (isset ( $datos ['code'] ))
            $product->code = $datos ['code'];
        if (isset ( $datos ['name'] ))
            $product->name = $datos ['name'];
        if (isset ( $datos ['price_reference'] ))
            $product->price_reference = $datos ['price_reference'];
        if (isset ( $datos ['category'] ))
            $product->category = $datos ['category'];
        if (isset ( $datos ['factory'] ))
            $product->factory = $datos ['factory'];
        if (isset ( $datos ['description'] ))
            $product->description = $datos ['description'];
    }

    public function postSaveBuy(Request $request) {
        try {
            $valid = true;
            $statusCode = 200;

            $datos = input::all();

            $products = json_decode($datos['lista'], true);

            $buy = new Buy();
            $buy->date_buy = $datos['dateBuy'];
            $buy->nit = $datos['nit'];
            $buy->razon_social = $datos['proveedor'];
            $buy->total = $datos['total'];
            $buy->num_doc = $datos['numDoc'];
            $buy->user_id = Auth::id();

            $buy->save();

            $buyDetail = null;
            foreach($products as $product){
                $buyDetail = new BuyDetail();

                $buyDetail->price = $product['coste'];
                $buyDetail->amount = $product['quantity'];
                $buyDetail->available = $product['quantity'];
                $buyDetail->product_id = $product['id'];
                $buyDetail->buy_id = $buy->buy_id;

                $buyDetail->save();

                $movement = Movements::where('product_id', $product['id'])->where('active', 1)->first();
                $movement->active = 0;
                $movement->save();

                $movementNew = new Movements();
                $movementNew->shopping_detail = $buyDetail->bd_id;
                $movementNew->amount = $product['quantity'];
                $movementNew->total = $movement->total + $product['quantity'];
                $movementNew->active = 1;
                $movementNew->product_id = $product['id'];
                $movementNew->save();
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

    public function postSaveSale(Request $request) {
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

                            $movement = Movements::where('product_id', $product['id'])->where('active', 1)->first();
                            $movement->active = 0;
                            $movement->save();

                            $movementNew = new Movements();
                            $movementNew->sale_detail = $saleDetail->sd_id;
                            $movementNew->amount = $amount; // important
                            $movementNew->total = $movement->total - $amount; // important
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

                            $movement = Movements::where('product_id', $product['id'])->where('active', 1)->first();
                            $movement->active = 0;
                            $movement->save();

                            $movementNew = new Movements();
                            $movementNew->sale_detail = $saleDetail->sd_id;
                            $movementNew->amount = $buyDetail->available; // important
                            $movementNew->total = $movement->total - $buyDetail->available;
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

    public function postSaveDelivery(Request $request) {
        try {
            $valid = true;
            $statusCode = 200;

            $datos = input::all();

            $products = json_decode($datos['lista'], true);

            $delivery = new Delivery();
            $delivery->date_delivery = $datos['dateDelivery'];
            $delivery->detail = $datos['detail'];
            $delivery->ci = $datos['ci'];
            $delivery->user_id = Auth::id();
            $delivery->save();

            foreach($products as $product){
                $deliveryDetail = new DeliveryDetail();

                $deliveryDetail->amount = $product['quantity'];
                $deliveryDetail->product_id = $product['id'];
                $deliveryDetail->delivery_id = $delivery->delivery_id;

                $deliveryDetail->save();

                $movement = Movements::where('product_id', $product['id'])->where('active', 1)->first();
                $q = 0;
                if(isset($movement)){
                    $q = $movement->total;
                    $movement->active = 0;
                    $movement->save();
                }

                $movementNew = new Movements();
                $movementNew->delivery_detail = $deliveryDetail->dd_id;
                $movementNew->amount = $product['quantity'];
                $movementNew->total = $q - $product['quantity'];
                $movementNew->active = 1;
                $movementNew->product_id = $product['id'];
                $movementNew->save();

                $storeM = StoreMovements::where('product_id', $product['id'])->where('active', 1)->first();
                $qSm = 0;
                if(isset($storeM)){
                    $qSm = $storeM->total;
                    $storeM->active = 0;
                    $storeM->save();
                }

                $sm = new StoreMovements();
                $sm->delivery_detail = $deliveryDetail->dd_id;
                $sm->amount = $product['quantity'];
                $sm->total = $qSm + $product['quantity'];
                $sm->active = 1;
                $sm->product_id = $product['id'];
                $sm->save();

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

    public function postSaveRefund(Request $request) {
        try {
            $valid = true;
            $statusCode = 200;

            $datos = input::all();

            $products = json_decode($datos['lista'], true);

            $refund = new Refund();
            $refund->date_refund = $datos['dateDelivery'];
            $refund->detail = $datos['detail'];
            $refund->ci = $datos['ci'];
            $refund->user_id = Auth::id();
            $refund->save();

            foreach($products as $product){
                $refundDetail = new RefundDetail();

                $refundDetail->amount = $product['quantity'];
                $refundDetail->product_id = $product['id'];
                $refundDetail->refund_id = $refund->refund_id;
                $refundDetail->save();

                $movement = Movements::where('product_id', $product['id'])->where('active', 1)->first();
                $q = 0;
                if(isset($movement)){
                    $q = $movement->total;
                    $movement->active = 0;
                    $movement->save();
                }

                $movementNew = new Movements();
                $movementNew->refund_detail = $refundDetail->rd_id;
                $movementNew->amount = $product['quantity'];
                $movementNew->total = $q + $product['quantity'];
                $movementNew->active = 1;
                $movementNew->product_id = $product['id'];
                $movementNew->save();

                $storeM = StoreMovements::where('product_id', $product['id'])->where('active', 1)->first();
                $qSm = 0;
                if(isset($storeM)){
                    $qSm = $storeM->total;
                    $storeM->active = 0;
                    $storeM->save();
                }

                $sm = new StoreMovements();
                $sm->refund_detail = $refundDetail->rd_id;
                $sm->amount = $product['quantity'];
                $sm->total = $qSm - $product['quantity'];
                $sm->active = 1;
                $sm->product_id = $product['id'];
                $sm->save();

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

    public function buyHistoric() {
        $filter = \DataFilter::source ( Buy::where ( [
            'delete' => 0
        ] ) );

        $filter->add('date_buy','YYYY-MM-dd','daterange')->format('Y-m-d', 'en');
        $filter->submit('buscar');
        $filter->reset('limpiar');
        $filter->build();

        $grid = \DataGrid::source ( $filter );
        $grid->attributes(array("class"=>"table table-striped arcedi_table"));
        $grid->add ( 'buy_id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'date_buy|strtotime|date[Y-m-d]', 'Fecha Compra' );
        $grid->add ( 'nit', 'NIT' );
        $grid->add ( 'razon_social', 'R. Social' );
        $grid->add ( 'num_doc', '# documento' );
        $grid->add ( 'total', 'Total' );
        $grid->add ( 'busy', 'Acciones' )->cell( function ($value, $row) {
            return
                '
                    <a href="#" onclick="openViewBuyDetail('.$row->buy_id.')" data-toggle="tooltip" title="Ver Detalle de compra"><span class="fa fa-arrows-alt" aria-hidden="true"></span></a>
                ';
        })->style("text-align: center;");

        $grid->row(function ($row) {
            $row->cell('busy')->style("text-align: center;");
        });

        $grid->orderBy ( 'buy_id', 'asc' );
        $grid->paginate ( 10 );

        return view ( 'store.buyHistoric', compact ( 'filter', 'grid' ) );

    }

    public function saleHistoric() {
        $filter = \DataFilter::source ( Sale::where ( [
            'delete' => 0
        ] )->whereNull("store_id") );

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

        return view ( 'store.saleHistoric', compact ( 'filter', 'grid' ) );

    }

    public function deliveryHistoric() {
        $filter = \DataFilter::source ( Delivery::where ( [
            'delete' => 0
        ] ) );

        $filter->add('date_delivery','YYYY-MM-dd','daterange')->format('Y-m-d', 'en');
        $filter->submit('buscar');
        $filter->reset('limpiar');
        $filter->build();

        $grid = \DataGrid::source ( $filter );
        $grid->attributes(array("class"=>"table table-striped arcedi_table"));
        $grid->add ( 'delivery_id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'date_delivery|strtotime|date[Y-m-d]', 'Fecha Entrega' );
        $grid->add ( 'detail', 'Detalle' );
        $grid->add ( 'ci', 'CI' );
        $grid->add ( 'busy', 'Acciones' )->cell( function ($value, $row) {
            return
                '
                    <a href="#" onclick="openViewDeliveryDetail('.$row->delivery_id.')" data-toggle="tooltip" title="Ver Detalle de entrega"><span class="fa fa-arrows-alt" aria-hidden="true"></span></a>
                ';
        })->style("text-align: center;");

        $grid->row(function ($row) {
            $row->cell('busy')->style("text-align: center;");
        });

        $grid->orderBy ( 'delivery_id', 'asc' );
        $grid->paginate ( 10 );

        return view ( 'store.deliveryHistoric', compact ( 'filter', 'grid' ) );

    }

    public function refundHistoric() {
        $filter = \DataFilter::source ( Refund::where ( [
            'delete' => 0
        ] ) );

        $filter->add('date_refund','YYYY-MM-dd','daterange')->format('Y-m-d', 'en');
        $filter->submit('buscar');
        $filter->reset('limpiar');
        $filter->build();

        $grid = \DataGrid::source ( $filter );
        $grid->attributes(array("class"=>"table table-striped arcedi_table"));
        $grid->add ( 'refund_id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'date_refund|strtotime|date[Y-m-d]', 'Fecha Devolucion' );
        $grid->add ( 'detail', 'Detalle' );
        $grid->add ( 'ci', 'CI' );
        $grid->add ( 'busy', 'Acciones' )->cell( function ($value, $row) {
            return
                '
                    <a href="#" onclick="openViewRefundDetail('.$row->refund_id.')" data-toggle="tooltip" title="Ver Detalle de devolucion"><span class="fa fa-arrows-alt" aria-hidden="true"></span></a>
                ';
        })->style("text-align: center;");

        $grid->row(function ($row) {
            $row->cell('busy')->style("text-align: center;");
        });

        $grid->orderBy ( 'refund_id', 'asc' );
        $grid->paginate ( 10 );

        return view ( 'store.refundHistoric', compact ( 'filter', 'grid' ) );

    }

    public function getDetailBuyAjax(Request $request) {
        $datos = input::all ();
        try {
            $statusCode = 200;
            $buyId = $datos['buy_id'];
            $buy = Buy::find($buyId);

            $buyDetail = BuyDetail::getBuyDetailWithProduct($buyId);
            $response = [
                "buy" => $buy,
                "buyDetail" => $buyDetail
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

    public function getDetailSaleAjax(Request $request) {
        $datos = input::all ();
        try {
            $statusCode = 200;
            $saleId = $datos['sale_id'];
            $sale = Sale::find($saleId);

            $saleDetail = SaleDetail::getSaleDetailWithProduct($saleId);
            $response = [
                "sale" => $sale,
                "saleDetail" => $saleDetail
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

    public function getDetailDeliveryAjax(Request $request) {
        $datos = input::all ();
        try {
            $statusCode = 200;
            $deliveryId = $datos['delivery_id'];
            $delivery = Delivery::find($deliveryId);

            $deliveryDetail = DeliveryDetail::getDeliveryDetailWithProduct($deliveryId);
            $response = [
                "delivery" => $delivery,
                "deliveryDetail" => $deliveryDetail
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

    public function getDetailRefundAjax(Request $request) {
        $datos = input::all ();
        try {
            $statusCode = 200;
            $refundId = $datos['refund_id'];
            $refund = Refund::find($refundId);

            $refundDetail = RefundDetail::getRefundDetailWithProduct($refundId);
            $response = [
                "refund" => $refund,
                "refundDetail" => $refundDetail
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
}
