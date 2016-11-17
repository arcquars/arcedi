<?php

namespace App\Http\Controllers;

use App\Arcedi\Utils;
use App\Models\EnvImages;
use App\Models\Extra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

class AdminController extends Controller {

	public function __construct() {
		$this->middleware ( 'is_admin' );
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$filter = \DataFilter::source ( Environment::where ( [ 
				'delete' => 0 
		] ) );
		
		$filter->add ( 'type', 'Tipo', 'select' )->options ( array (
				"" => "Todos",
				"Departamento" => "Departamentos",
				"Oficina" => "Oficinas",
				"Tienda" => "Tiendas",
				"Deposito" => "Depositos",
				"Area Social" => "Area Social" 
		) );
		$filter->attributes ( [ 
				'env_id' => 'searchId',
				'id' => 'searchId' 
		] );
		$filter->submit ( 'search' );
		$filter->reset ( 'reset' );
		$filter->build ();
		
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'env_id', 'ID', true )->style ( "width:100px" );
		$grid->add ( 'type', 'Type' );
		$grid->add ( 'code', 'Codigo' );
		/*
		 * $grid->add('
		 * <a href="#" title="pagos" data-id="{{ $id }}"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></a>
		 * <a href="#" title="Ver contrato" data-id="{{ $id }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>
		 * <a href="#" title="Historial de pagos" data-id="{{ $id }}"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a>
		 * <a href="#" title="Ver ambientes" data-id="{{ $id }}"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
		 * <a href="#" title="Terminar contrato" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
		 * ', 'Acciones');
		 */
		$grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
			return ($value != 0) ? '
                    <a href="#" onclick="openModelHistoryEnv('.$row->env_id.', \''.$row->code.'\')" data-toggle="tooltip" title="Historial de pagos" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a>
                    <a href="#" onclick="viewEnvImages(this); return false;" data-toggle="tooltip" title="Ver ambientes" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                    <a href="'.action("PdfController@contract", ['env_id' => $row->env_id]).'" target="_blank" data-toggle="tooltip" title="Ver contrato" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></a>
                    <a href="#" onclick="paymentMonth(this)" data-toggle="tooltip" title="pagos" data-code="' . $row->code . '" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></a>
                    <a href="#" onclick="cobroExtra(this)" data-toggle="tooltip" title="Cobros Extra" data-id="' . $row->env_id . '"><span class="fa fa-btc" aria-hidden="true"></span></a>
                    <a href="#" onclick="endContract(this)" data-toggle="tooltip" title="Terminar contrato" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                ' : 
			// "no revisions for art. {$row->id}";
			'
                    <a href="#" onclick="openModelHistoryEnv('.$row->env_id.', \''.$row->code.'\')" data-toggle="tooltip" title="Historial de pagos" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a>
                    <a href="#" data-toggle="tooltip" title="Ver ambientes" data-id="' . $row->env_id . '"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                    <a href="#" onclick="doContract(this); return false;" data-toggle="tooltip" title="Hacer Contrato" data-id="' . $row->env_id . '" data-code="' . $row->code . '" data-type="' . $row->type . '"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>
                ';
		} );
		
		// $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
		// $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
		// $grid->edit('/admin/edit', 'Acciones','show|modify|delete');
		$grid->attributes(array("class" => "table table-striped arcedi_table"));
		$grid->orderBy ( 'env_id', 'asc' );
		$grid->paginate ( 10 );

		$env_lates_month = Utils::getDiasRetrazadosContratoMes();

		$env_lates_anti = Utils::getDiasRetrazadosContratoAnti();
		return view ( 'admin.home', compact ( 'filter', 'grid', 'env_lates_month', 'env_lates_anti' ) );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
	
	// restfull post
	public function postContrato(Request $request) {
		$datos = input::all ();
		// Crear o actualizar persona
		$person = Person::getPersonByCiS ( $datos ['ci'] );
		if (isset ( $person )) {
			$this->populatePerson ( $person, $datos );
		} else {
			$person = new Person ();
			$this->populatePerson ( $person, $datos );
		}
		$person->save ();
		// Crear Mes
		$rentalMonth = new RentalMonth ();
		$this->populateRentalMonth ( $rentalMonth, $datos );
		$rentalMonth->save ();
		// Crear Contrato por mes
		$contract = new Contract ();
		$this->populateContract ( $contract, $datos, $person->id, $rentalMonth->rm_id, 0 );
		$contract->save ();
		// Actualizar estado de hambiente
		$environment = Environment::getByIdS ( $datos ['environmentId'] );
		$environment->busy = true;
		$environment->save ();
		
		return "true";
	}
	public function postContratoAnti(Request $request) {
		$datos = input::all ();
		// Crear o actualizar persona
		$person = Person::getPersonByCiS ( $datos ['ci'] );
		if (isset ( $person )) {
			$this->populatePerson ( $person, $datos );
		} else {
			$person = new Person ();
			$this->populatePerson ( $person, $datos );
		}
		$person->save ();
		// Crear rental anticretico
		$rentalAnti = new RentalAnti ();
		$this->populateRentalAnti ( $rentalAnti, $datos );
		$rentalAnti->save ();
		// Crear Contrato anticrisis
		$contract = new Contract ();
		$this->populateContract ( $contract, $datos, $person->id, $rentalAnti->ra_id, 1 );
		$contract->save ();
		// Actualizar estado de hambiente
		$environment = Environment::getByIdS ( $datos ['environmentId'] );
		$environment->busy = true;
		$environment->save ();
		
		return "true";
	}
	
	public function postContratoTime(Request $request) {
		$datos = input::all ();
		// Crear o actualizar persona
		$person = Person::getPersonByCiS ( $datos ['ci'] );
		if (isset ( $person )) {
			$this->populatePerson ( $person, $datos );
		} else {
			$person = new Person ();
			$this->populatePerson ( $person, $datos );
		}
		$person->save ();
		
		
		// Crear rental anticretico
		$rentalTime = new RentalTime();
		$this->populateRentalTime ( $rentalTime, $datos );
		$rentalTime->save ();
		// Crear Contrato anticrisis
		$contract = new Contract ();
		$this->populateContract ( $contract, $datos, $person->id, $rentalTime->id, 2 );
		$contract->save ();
		// Actualizar estado de hambiente
// 		$environment = Environment::getByIdS ( $datos ['environmentId'] );
// 		$environment->busy = true;
// 		$environment->save ();
	
		return $contract->contract_id;
	}
	public function postPaymentMonth(Request $request) {
		$datos = input::all ();
		// Crear o actualizar persona
		$person = Person::getPersonByCiS ( $datos ['ci'] );
		if (! isset ( $person )) {
			$person = new Person ();
		}
		$this->populatePerson ( $person, $datos );
		$person->save ();
		
		// Creando registro de pago de alquiler por mes
		$paymentM = new PaymentM ();
		$this->populatePaymentM ( $paymentM, $datos );
		$paymentM->save();
		return $paymentM->id;
	}

	public function postPaymentWMonth(Request $request) {
		$datos = input::all ();
		// Crear o actualizar persona
		$rentalMonth = RentalMonth::find( $datos ['rm_id'] );
		$rentalMonth->state = true;
		$rentalMonth->date_payment_warranty = Carbon::now();
		$rentalMonth->save();
		return "true";
	}

	public function postPaymentWAnti(Request $request) {
		$datos = input::all ();
		// Crear o actualizar persona
		$rentalMonth = RentalAnti::find( $datos ['ra_id'] );
		$rentalMonth->state = true;
		$rentalMonth->date_payment_warranty = Carbon::now();
		$rentalMonth->save();
		return "true";
	}

	public function postPaymentAnti(Request $request) {
		$datos = input::all ();
		// Crear o actualizar persona
		$person = Person::getPersonByCiS ( $datos ['ci'] );
		if (! isset ( $person )) {
			$person = new Person ();
		}
		$this->populatePerson ( $person, $datos );
		$person->save ();

		// Creando registro de pago de alquiler por mes
		$paymentA = new PaymentA();
		$this->populatePaymentA ( $paymentA, $datos );
		$paymentA->save ();
		return $paymentA->id;
	}

	public function postPaymentExtra(Request $request) {
		$datos = input::all ();

		$extra = new Extra();
		$extra->detail = $datos ['concept'];
		$extra->total = $datos ['total'];
		$extra->contract_id = $datos ['contract_id'];
		$extra->user_id = Auth::user()->id;
		$extra->date_extra = \Illuminate\Support\Facades\DB::raw ( 'now()' );

		$extra->save();

		return $extra->extra_id;
		//return 2;
	}
	public function getRentalPayment($env_id) {
		try {
			$contract = Contract::getByContractByEnvId ( $env_id );
			
			$statusCode = 200;
			$rental = 0;
			$response = null;
			if (isset ( $contract->rental_m_id )) {
				$rental = 1;
			}
			if (isset ( $contract->anticrisis_id )) {
				$rental = 2;
			}
			if (isset ( $contract->rental_h_id )) {
				$rental = 3;
			}
			$response = [ 
					"type_contrat" => [ 
							'rental' => $rental 
					] 
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

	public function getDataContracByEnvId($env_id) {
		try {
			$contract = Contract::getDataContract( $env_id );

			$statusCode = 200;
			$response = null;
			$response = [
				'contract' => $contract
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
	
	public function getPaymentContractMonth($env_id) {
		try {
			$dataPaymentMonth = Contract::getDataPaymentMonth ( $env_id );
			$lastPaymentM = PaymentM::getMaxPaymentByContractId ( $dataPaymentMonth->rental_m_id );
			$fee = "0";
			
			$dateNow = new \DateTime ();
			if (isset ( $lastPaymentM )) {
				$dateAux = new \DateTime ( $lastPaymentM->date_end );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = $this->diffdates ( $lastPaymentM->date_end );
			} else {
				$dateAux = new \DateTime ( $dataPaymentMonth->date_admission );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = $this->diffdates ( $dataPaymentMonth->date_admission );
			}
			
			$statusCode = 200;
			
			$response = [ 
					"data" => $dataPaymentMonth,
					"lastPaymentM" => $lastPaymentM,
					"fee" => $fee,
					"dateNow" => $dateNow->format ( 'Y-m-d' )
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

	public function getEnvImages($env_id) {
		try {
			$images = EnvImages::where('env_id', $env_id)
				->orderBy('weight', 'asc')
				->take(10)
				->get();

			$statusCode = 200;

			$response = [
				"data" => $images,
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

	public function actionEndContract($env_id) {
		try {
			$environment = Environment::find($env_id);
			$contract = Contract::where("env_id", $env_id)->where("status", "Vigente")->update(['status' => 'Cancelado']);

			$environment->busy = false;

			$environment->save();

			$statusCode = 200;

			$response = [
				//"data" => $images,
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
	
	public function getPaymentContractTime($env_id, $date) {
		try {
			$dataPaymentTimes = Contract::getDataPaymentTime ( $env_id, $date );
			$timeIds = "";
			$rental = 0;
			if(count($dataPaymentTimes)){
				foreach ($dataPaymentTimes as $dataPaymentTime) {
					$timeIds .= $dataPaymentTime->detail_time;
					$rental = $dataPaymentTime->rental;
				}	
			}else{
				$enviroment = Environment::getByIdS($env_id);
				$rental = $enviroment->rental;
			}
			
			$statusCode = 200;
			$response = [
					"rental" => $rental,
					//"detail_time" => "-4-5-6-12-13-14",
					"detail_time" => $timeIds,
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
	
	public function getPaymentContractAnti($env_id) {
		try {
			$dataPaymentAnti = Contract::getDataPaymentAnti ( $env_id );
			$lastPaymentA = PaymentA::getMaxPaymentByContractId ( $dataPaymentAnti->anticrisis_id );
			$fee = "0";
			
			$dateNow = new \DateTime ();
			if (isset ( $lastPaymentA )) {
				$dateAux = new \DateTime ( $lastPaymentA->date_end );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = $this->diffdates ( $lastPaymentA->date_end );
			} else {
				$dateAux = new \DateTime ( $dataPaymentAnti->date_admission );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = $this->diffdates ( $dataPaymentAnti->date_admission );
			}
			
			$statusCode = 200;
			
			$response = [ 
					"data" => $dataPaymentAnti,
					"lastPaymentA" => $lastPaymentA,
					"fee" => $fee,
					"dateNow" => $dateNow->format ( 'Y-m-d' ) 
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
	private function populatePerson($person, $datos) {
		if (isset ( $datos ['ci'] ))
			$person->ci = $datos ['ci'];
		if (isset ( $datos ['names'] ))
			$person->names = $datos ['names'];
		if (isset ( $datos ['expedido'] ))
			$person->expedido = $datos ['expedido'];
		if (isset ( $datos ['last_name_f'] ))
			$person->last_name_f = $datos ['last_name_f'];
		if (isset ( $datos ['last_name_m'] ))
			$person->last_name_m = $datos ['last_name_m'];
		if (isset ( $datos ['phone'] ))
			$person->phone = $datos ['phone'];
		if (isset ( $datos ['phone_cel'] ))
			$person->phone_cel = $datos ['phone_cel'];
		if (isset ( $datos ['email'] ))
			$person->email = $datos ['email'];
	}
	private function populatePaymentM($paymentM, $datos) {
		if (isset ( $datos ['ci'] ))
			$paymentM->ci = $datos ['ci'];
		if (isset ( $datos ['total'] ))
			$paymentM->total = $datos ['total'];
		if (isset ( $datos ['month_total'] ))
			$paymentM->month_total = $datos ['month_total'];
		if (isset ( $datos ['penalty_fee'] ))
			$paymentM->penalty_fee = $datos ['penalty_fee'];
		if (isset ( $datos ['payment_rental'] ))
			$paymentM->payment_rental = $datos ['payment_rental'];
		if (isset ( $datos ['payment_larder'] ))
			$paymentM->payment_larder = $datos ['payment_larder'];
		if (isset ( $datos ['dateStart'] ))
			$paymentM->date_start = $datos ['dateStart'];
		if (isset ( $datos ['dateEnd'] ))
			$paymentM->date_end = $datos ['dateEnd'] . "-01";
		if (isset ( $datos ['rental_m_id'] ))
			$paymentM->rental_m_id = $datos ['rental_m_id'];
		
		$paymentM->payment_date = DB::raw ( 'NOW()' );
	}
	private function populatePaymentA($paymentA, $datos) {
		if (isset ( $datos ['ci'] ))
			$paymentA->ci = $datos ['ci'];
		if (isset ( $datos ['total'] ))
			$paymentA->total = $datos ['total'];
		if (isset ( $datos ['month_total'] ))
			$paymentA->month_total = $datos ['month_total'];
		if (isset ( $datos ['penalty_fee'] ))
			$paymentA->penalty_fee = $datos ['penalty_fee'];
		if (isset ( $datos ['fee'] ))
			$paymentA->penalty_day = $datos ['fee'];
		if (isset ( $datos ['payment_larder'] ))
			$paymentA->payment_larder = $datos ['payment_larder'];
		if (isset ( $datos ['dateStart'] ))
			$paymentA->date_start = $datos ['dateStart'];
		if (isset ( $datos ['dateEnd'] ))
			$paymentA->date_end = $datos ['dateEnd'] . "-01";
		if (isset ( $datos ['anticrisis_id'] ))
			$paymentA->rental_a_id = $datos['anticrisis_id'];
		
		$paymentA->payment_date = DB::raw ( 'NOW()' );
	}
	private function populateContract($contract, $datos, $perId, $id, $tipoContract) {
		$contract->env_id = $datos ['environmentId'];
		$contract->per_id = $perId;
		if ($tipoContract == 0)
			$contract->rental_m_id = $id;
		if ($tipoContract == 1)
			$contract->anticrisis_id = $id;
		if ($tipoContract == 2)
			$contract->rental_h_id = $id;
		$contract->status = "Vigente";
		$contract->date_contract = $datos['dateContract'];
	}
	private function populateRentalMonth($rentalMonth, $datos) {
		$rentalMonth->date_admission = date_create_from_format ( 'Y-m-d', $datos ['dateStart'] );
		$rentalMonth->date_end = date_create_from_format ( 'Y-m-d', $datos ['dateEnd'] . '-01' );
		$rentalMonth->warranty = $datos ['warranty'];
		$rentalMonth->penalty_fee = $datos ['penalty_fee'];
		$rentalMonth->payment = $datos ['monthPayment'];
		$rentalMonth->larder = $datos ['despensas'];
	}
	private function populateRentalAnti($rentalAnti, $datos) {
		$rentalAnti->date_admission = date_create_from_format ( 'Y-m-d', $datos ['dateStart'] );
		$rentalAnti->date_end = date_create_from_format ( 'Y-m-d', $datos ['dateEnd'] );
		$rentalAnti->penalty_fee = $datos ['penalty_fee'];
		$rentalAnti->anticretico = $datos ['anticretico'];
		$rentalAnti->larder = $datos ['despensas'];
	}
	private function populateRentalTime($rentalTime, $datos) {
		$rentalTime->date_contract = date_create_from_format ( 'Y-m-d', $datos ['dateStart'] );
		$rentalTime->rental_payment = $datos ['alq_hora'];
		$rentalTime->time_total = $datos ['alq_hora_total'];
		$rentalTime->warranty = $datos ['warranty'];
		$rentalTime->payment = $datos ['alq_hora_total'] * $datos ['alq_hora'];
		$rentalTime->detail_time = $datos ['alq_hora_detail'];
	}
	private function diffdates($date_2) {
		$date = new \DateTime ();
		$date2 = new \DateTime ( $date_2 );
		$date2->modify ( '+6 day' );
		if ($date <= $date2) {
			return 0;
		} else {
			$interval = $date->diff ( $date2 ); // Restamos la Fecha1 menos la Fecha2
			$seg = $date->getTimestamp () - $date2->getTimestamp ();

			// return $interval->d;
			return floor ( $seg / (60 * 60 * 24) );
		}
	}
	public function getGrid() {
		// dd(\App\Models\Environment::all()->get());
		// dd(Environment::all());
		$grid = \DataGrid::source ( Environment::where ( 'delete', 0 ) );
		
		$grid->add ( 'env_id', 'ID', true )->style ( "width:100px" );
		$grid->add ( 'type', 'Type' );
		/*
		 * $grid->edit('/rapyd-demo/edit', 'Edit','show|modify');
		 * $grid->link('/rapyd-demo/edit',"New Article", "TR");
		 */
		$grid->orderBy ( 'env_id', 'desc' );
		$grid->paginate ( 10 );
		// dd(\App\Models\Environment::with('area')->get());
		return view ( 'admin.grid', compact ( 'grid' ) );
	}

}

