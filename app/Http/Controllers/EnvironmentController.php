<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnvironmentPostRequest;
use App\Models\EnvImages;
use App\Models\Extra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Http\Response;
use App\Models\Environment;
use App\Models\Person;
use App\Models\RentalMonth;
use App\Models\RentalTime;
use App\Models\RentalAnti;
use App\Models\Contract;
use App\Models\PaymentM;
use App\Models\PaymentA;
use Carbon\Carbon;
use DB;

class EnvironmentController extends Controller
{
    public function __construct() {
        $this->middleware ( 'is_admin' );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = \DataFilter::source(Environment::where([
            'delete' => 0
        ]));

        $filter->add('type', 'Tipo', 'select')->options(array(
            "" => "Todos",
            "Departamento" => "Departamentos",
            "Oficina" => "Oficinas",
            "Tienda" => "Tiendas",
            "Deposito" => "Depositos",
            "Area Social" => "Area Social"
        ));
        $filter->attributes([
            'env_id' => 'searchId',
            'id' => 'searchId'
        ]);
        $filter->submit('Buscar');
        $filter->reset('Limpiar');
        $filter->build();

        $grid = \DataGrid::source($filter);
        $grid->add('env_id', 'ID', true)->style("width:100px");
        $grid->add('type', 'Tipo');
        $grid->add('code', 'Codigo');
        $grid->add('area', 'Area');
        $grid->add('rental', 'Alquiler');
        $grid->add('busy', 'Estado')->cell(function ($value, $row) {
            return ($value == 0) ? 'Desocupado' : 'Ocupado';
        });
        $grid->add('actions', 'Acciones')->cell(function ($value, $row) {
            return '
                <a href="'.url('env/edit', ['env_id' => $row->env_id]).'" data-toggle="tooltip" title="Editar" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <a href="#" onclick="openViewDeleteEnv(' . $row->env_id . '); return false;" data-toggle="tooltip" title="Ver ambientes" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                ';
        });
        $grid->orderBy('env_id', 'asc');
        $grid->paginate(10);

        return view('environment.home', compact('filter', 'grid'));
    }

    public function editEnv($env_id) {
        $env1 = Environment::find($env_id);
        $arcedi_type = \Config::get('arcedu.arcedi_type');
        $arcedi_type_use = \Config::get('arcedu.arcedi_type_use');

        $envImages = EnvImages::where("env_id", "=", $env_id)->get();

        $type_use = $this->getSpanishTypeUse($env1->type_use);
        $isEdit=true;
        return view('environment.edit', compact("env1", "arcedi_type", "arcedi_type_use", "envImages", "isEdit", "type_use"));
    }

    public function newEnv() {
        $env = new Environment();
        $arcedi_type = \Config::get('arcedu.arcedi_type');
        $arcedi_type_use = \Config::get('arcedu.arcedi_type_use');

        return view('environment.new', compact("env", "arcedi_type", "arcedi_type_use"));
    }

    public function store(StoreEnvironmentPostRequest $request){
        if($request->env_id !== ""){
            $env = Environment::find($request->env_id);
        }else{
            $env = new Environment();
        }
        $typeUse = \Config::get('arcedu.arcedi_type_use');
        if($typeUse['living_place'] == $request->type_use)
            $env->type_use = 'living_place';
        if($typeUse['commercial'] == $request->type_use)
            $env->type_use = 'commercial';
        if($typeUse['time'] == $request->type_use)
            $env->type_use = 'time';

        $env->type = $request->type;
        $env->area = $request->area;
        $env->flat = $request->flat;
        $env->code = $request->code;
        $env->rental = $request->rental;
        $env->detail_env = $request->detail_env;

        $env->save();

        return redirect()->action('EnvironmentController@index');
    }

    public function uploadFile()
    {
        $files = Input::file('files');
        $env_id = Input::get("env_id");
        $json = array(
            'files' => array()
        );

        foreach( $files as $file ):

            //$filename = $file->getClientOriginalName().".".$file->getClientOriginalExtension();
            $filename = "arcedi_".$env_id."_".$file->getClientOriginalName();

            $json['files'][] = array(
                'name' => $filename,
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
                'url' => '/assets/images/arcedi/environments/'.$env_id."/".$filename,
                'deleteType' => 'DELETE',
                //'deleteUrl' => self::$route.'/deleteFile/'.$filename,
            );
            $pathAux = public_path().'/assets/images/arcedi/environments/'.$env_id;
            $pathAuxThumb = $pathAux."/"."arcedi_".$env_id."_thumb_".$file->getClientOriginalName();
            if (!file_exists($pathAux)) {
                mkdir($pathAux);
            }
            $upload = $file->move( $pathAux, $filename );

            $envImage = new EnvImages();
            $envImage->url_image = 'arcedi/environments/'.$env_id."/"."arcedi_".$env_id."_".$file->getClientOriginalName();
            $envImage->url_image_thumbnail = 'arcedi/environments/'.$env_id."/"."arcedi_".$env_id."_thumb_".$file->getClientOriginalName();
            $envImage->env_id = $env_id;
            $envImage->delete = 0;
            $envImage->weight = 0;
            $envImage->save();

            $thumb = new \Imagick($pathAux."/".$filename);

            $thumb->resizeImage(200,200,\Imagick::FILTER_LANCZOS,1);
            $thumb->writeImage($pathAuxThumb);

            $thumb->destroy();


        endforeach;

        return response ()->json($json);
    }

    public function destroy($env_image_id) {
        try {
            $statusCode = 200;
            $envImage = EnvImages::findOrFail($env_image_id);

            $response = [
                "env_id" => $envImage->env_id
            ];
            $envImage->delete();
        } catch ( Exception $e ) {
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function getEnvImages($env_id) {
        try {
            $statusCode = 200;
            $envImage = EnvImages::where("env_id", "=", $env_id)->get();

            $response = [
                "envImages" => $envImage
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

    public function getEnvContract($env_id) {
        try {
            $statusCode = 200;
            $contract = Contract::where("env_id", "=", $env_id)->orderBy("contract_id", "desc")->
            select("contract_id", "status", "rental_m_id", "rental_h_id", "anticrisis_id")->get();

            $response = [
                "contract" => $contract
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

    public function redirectContract($contract_id){
        $contract = Contract::find($contract_id);
        if(isset($contract->rental_m_id)){
            return redirect()->action('EnvironmentController@paymentContractMonth', [$contract_id, $contract->rental_m_id]);
        }
        if(isset($contract->rental_h_id)){
            return redirect()->action('EnvironmentController@paymentContractAnti', [$contract_id, $contract->anticrisis_id]);
        }
        if(isset($contract->anticrisis_id)){
            return redirect()->action('EnvironmentController@paymentContractAnti', [$contract_id, $contract->anticrisis_id]);
        }

    }

    public function paymentContractMonth($contract, $rental_m_id){
        $filter = \DataFilter::source ( PaymentM::where ( [
            'rental_m_id' => $rental_m_id, 'delete' => '0'
        ] ) );

        $grid = \DataGrid::source ( $filter );
        $grid->add ( 'id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'payment_date', 'Fecha de pago' );
        $grid->add ( 'date_start', 'Del' );
        $grid->add ( 'date_end', 'Al' );
        $grid->add ( 'month_total', 'Meses' );
        $grid->add ( 'payment_rental', 'Pago X mes' );
        $grid->add ( 'payment_larder', 'Pago X desp.' );
        $grid->add ( 'penalty_fee', 'Pago X multa' );
        $grid->add ( 'total', 'TOTAL' );

        $grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
            return
            '<a target="_blank" href="'.url('pdf/voucher', ['payment_m' => $row->id]).'" data-toggle="tooltip" title="Ver Recibo"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>';
        } );

        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->edit('/admin/edit', 'Acciones','show|modify|delete');
        $grid->orderBy ( 'id', 'asc' );
        $grid->paginate ( 10 );


        $contractModel = Contract::find($contract);
        $environment = Environment::find($contractModel->env_id);
        $person = Person::find($contractModel->per_id);
        $rental_m = RentalMonth::find($rental_m_id);
        return view ( 'environment.contractM', compact("contractModel", "environment", "person", "rental_m", "grid"));
    }

    public function paymentContractExtra($contract){
        $filter = \DataFilter::source ( Extra::where ( [
            'contract_id' => $contract
        ] ) );

        $grid = \DataGrid::source ( $filter );
        $grid->add ( 'extra_id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'date_extra', 'Fecha de pago' );
        $grid->add ( 'detail', 'Concepto' );
        $grid->add ( 'total', 'TOTAL' );

        $grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
            return
                '<a target="_blank" href="'.url('pdf/voucherExtra/'.$row->extra_id).'" data-toggle="tooltip" title="Ver Recibo"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>';
        } );

        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->edit('/admin/edit', 'Acciones','show|modify|delete');
        $grid->orderBy ( 'extra_id', 'asc' );
        $grid->paginate ( 10 );


        $contractModel = Contract::find($contract);
        $environment = Environment::find($contractModel->env_id);
        $person = Person::find($contractModel->per_id);
        return view ( 'environment.contractExtra', compact("contractModel", "environment", "person", "grid"));
    }

    public function paymentContractAnti($contract, $rental_a_id){
        $filter = \DataFilter::source ( PaymentA::where ( [
            'rental_a_id' => $rental_a_id, 'delete' => '0'
        ] ) );

        $grid = \DataGrid::source ( $filter );
        $grid->add ( 'id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'payment_date', 'Fecha de pago' );
        $grid->add ( 'date_start', 'Del' );
        $grid->add ( 'date_end', 'Al' );
        $grid->add ( 'month_total', 'Meses' );
        $grid->add ( 'payment_larder', 'Pago X desp.' );
        $grid->add ( 'penalty_fee', 'dias Multa' );
        $grid->add ( 'penalty_day', 'Multa X dia' );
        $grid->add ( 'total', 'TOTAL' );

        $grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
            return
                '<a target="_blank" href="'.url('pdf/voucherAnti', ['payment_anti' => $row->id]).'" data-toggle="tooltip" title="Ver Recibo"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>';
        } );

        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->edit('/admin/edit', 'Acciones','show|modify|delete');
        $grid->orderBy ( 'id', 'asc' );
        $grid->paginate ( 10 );


        $contractModel = Contract::find($contract);
        $environment = Environment::find($contractModel->env_id);
        $person = Person::find($contractModel->per_id);
        $rental_a = RentalAnti::find($rental_a_id);
        return view ( 'environment.contractA', compact("contractModel", "environment", "person", "rental_a", "grid"));
    }

    public function destroyEnv($env_id) {
        try {
            $statusCode = 200;
            //$envImage = EnvImages::findOrFail($env_image_id);
            $countContract = Contract::where("env_id", $env_id)->get()->count();

            $message = "";
            if($countContract > 0){
                $message = "¡No se puede borrar el ambiente por que tiene contratos! ";
            }else{
                $message = "true";
                $env = Environment::find($env_id);
                $env->delete();

            }
            $response = [
                //"env_id" => $envImage->env_id
                "message" => $message
            ];
            //$envImage->delete();
        } catch ( Exception $e ) {
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function getSpanishTypeUse($typeUse){
        if($typeUse == "living_place"){
            return "Vivienda";
        }
        if($typeUse == "commercial"){
            return "Comercial";
        }
        if($typeUse == "time"){
            return "Por Hora";
        }

        return "";
    }
}
