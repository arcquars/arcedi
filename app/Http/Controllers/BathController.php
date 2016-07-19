<?php

namespace App\Http\Controllers;

use App\Models\Arching;
use App\Models\ArchingBath;
use App\Models\BathEntry;
use App\Models\BathSpending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Session;

class BathController extends Controller
{
	public function __construct() {
		$this->middleware ( 'is_admin' );
	}
	
	public function index() {
		$arching = ArchingBath::where('delete', "=", "0")->orderBy("ab_id", "desc")->first();

		//dd($arching->date_end);
		$query = DB::table("archings");
		$dateStart = "";
		$dateEnd = Carbon::now();
		if(isset($arching)){
			$dateStart = $arching->date_end;
		}

		$totalEntry = BathEntry::bathEntryTotalBeetwenDate($dateStart, $dateEnd);

		$grid = $this->getGridBacthEnrty($dateStart, $dateEnd);
		$date_insert_next = $this->getDayEntryRegistryLocal();
		return view ('bath.home', compact (
			'dateStart', 'date_insert_next',
			'grid', 'totalEntry'
		));
	}
	
	public function outgo() {
		$arching = ArchingBath::where('delete', "=", "0")->orderBy("ab_id", "desc")->first();

		//dd($arching->date_end);
		$query = DB::table("archings");
		$dateStart = "";
		$dateEnd = Carbon::now();
		if(isset($arching)){
			$dateStart = $arching->date_end;
		}

		$totalOutgo = BathSpending::bathSpendingTotalBeetwenDate($dateStart, $dateEnd);

		$grid = $this->getGridBathSpending($dateStart, $dateEnd);
		$date_now = Carbon::now();
		return view ('bath.outgo', compact (
			'dateStart', 'date_now',
			'grid', 'totalOutgo'
		));

	}

	public function getDayEntryRegistry() {
		try {
			$maxBath = BathEntry::where('delete', 0)->orderBy('date_entry', 'desc')->first();
			$date_last = Carbon::now()->toDateString();

			if(isset($maxBath)){
				$e = Carbon::createFromFormat('Y-m-d', $maxBath->date_entry);
				$date_last = $e->addDay()->toDateString();

			}

			$statusCode = 200;

			$response = [
				'date_last' => $date_last
			];
		} catch ( Exception $e ) {
			$response = [
				"error" => "Error al obtener fecha."
			];
			$statusCode = 404;
		} finally{
			return response ()->json ( $response, $statusCode );
		}
	}

	public function postBathSave(Request $request) {
		$datos = input::all ();

		if ($datos ['be_id'] !== "") {
			$bathEntry = BathEntry::where ( 'be_id', '=', $datos ['be_id'] )->first ();
			$this->populateBath ( $bathEntry, $datos );
			$bathEntry->save ();
		} else {
			$bathEntry = new BathEntry();
			$this->populateBath ( $bathEntry, $datos );
			$bathEntry->save ();
		}
		return $bathEntry->be_id;
	}

	public function postBathSpendingSave(Request $request) {
		$datos = input::all ();

		if ($datos ['bs_id'] !== "") {
			$bathSpending = BathSpending::where ( 'bs_id', '=', $datos ['bs_id'] )->first ();

		} else {
			$bathSpending = new BathSpending();
		}
		$this->populateBathSpending( $bathSpending, $datos );
		$bathSpending->save ();
		return $bathSpending->bs_id;
	}

	public function destroyBathSpending($id)
	{
		$bathSpending = BathSpending::findOrFail($id);

		$bathSpending->delete();

		Session::flash('flash_message', 'Task successfully deleted!');

		return "true";
	}

	private function populateBath($bath, $datos) {
		if (isset ( $datos ['date_entry'] ))
			$bath->date_entry = $datos ['date_entry'];
		if (isset ( $datos ['amount'] ))
			$bath->amount = $datos ['amount'];
		if (isset ( $datos ['ci'] ))
			$bath->ci = $datos ['ci'];
		if (isset ( $datos ['detail'] ))
			$bath->detail = $datos ['detail'];
		$bath->user_id = Auth::user ()->id;
	}

	private function populateBathSpending($bath, $datos) {
		if (isset ( $datos ['date_spending'] ))
			$bath->date_spending = $datos ['date_spending'];
		if (isset ( $datos ['outgo'] ))
			$bath->outgo = $datos ['outgo'];
		if (isset ( $datos ['detail'] ))
			$bath->detail = $datos ['detail'];
		if (isset ( $datos ['code_envoice'] ))
			$bath->code_envoice = $datos ['code_envoice'];
		$bath->user_id = Auth::user ()->id;
	}

	private function getGridBacthEnrty($dateStart, $dateEnd){
		$filter = \DataFilter::source ( BathEntry::where ( [
			'delete' => 0
		] )->where('created_at', '>=', $dateStart));

		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'date_entry', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'ci', 'Ci' );
		$grid->add ( 'detail', 'Observaciones' );
		$grid->add ( 'amount', 'Ingreso' );

		$grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
			return '<a href="#" onclick="actionEditBath(this); return false;" data-toggle="tooltip" title="Hacer Contrato" data-id="' . $row->be_id . '" data-amount="' . $row->amount . '" data-date_entry="' . $row->date_entry . '" data-ci="' . $row->ci . '" data-detail="' . $row->detail . '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
		} );

		$grid->orderBy ( 'date_entry', 'asc' );
		$grid->paginate ( 10 );

		return $grid;
	}

	private function getGridBathSpending($dateStart, $dateEnd){
		$filter = \DataFilter::source ( BathSpending::where ( [
			'delete' => 0
		] )->where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd));

		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'date_spending', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'detail', 'Concepto' );
		$grid->add ( 'outgo', 'Gasto' );

		$grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
			$re = '<a href="#" onclick="actionDeleteBathSpending(this); return false;" data-toggle="tooltip" title="Borrar gasto" data-id="' . $row->bs_id . '" data-outgo="' . $row->outgo . '" data-date_spending="' . $row->date_spending . '" data-code_envoice="' . $row->code_envoice . '" data-detail="' . $row->detail . '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
			$re .= '<a href="#" onclick="actionEditBathSpending(this); return false;" data-toggle="tooltip" title="Editar gasto" data-id="' . $row->bs_id . '" data-outgo="' . $row->outgo . '" data-date_spending="' . $row->date_spending . '" data-code_envoice="' . $row->code_envoice . '" data-detail="' . $row->detail . '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
			return $re;
		} );

		$grid->orderBy ( 'date_spending', 'asc' );
		$grid->paginate ( 10 );

		return $grid;
	}

	private function getDayEntryRegistryLocal() {
		$maxBath = BathEntry::where('delete', 0)->orderBy('date_entry', 'desc')->first();
		$date_last = Carbon::now()->toDateString();

		if(isset($maxBath)){
			$e = Carbon::createFromFormat('Y-m-d', $maxBath->date_entry);
			$date_last = $e->addDay()->toDateString();

		}

		return $date_last;
	}
}
