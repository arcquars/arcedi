<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Expense;
use Illuminate\Support\Facades\Input as input;
use App\Models\Arching;
use Carbon;

class ExpenseController extends Controller {
	public function __construct() {
		$this->middleware ( 'is_admin' );
	}
	public function index() {
		$arching = Arching::where('delete', "0")->orderBy("arch_id", "desc")->first();
		
		//dd($arching->date_end);
		$query = DB::table("archings");
		$dateStart = "";
		$dateEnd = \Carbon\Carbon::now();
		if(isset($arching)){
			$dateStart = $arching->date_end;
		}
		
		$filter = \DataFilter::source ( Expense::where ( [ 
				'delete' => 0 
		] )->where('date_expense', '>=', $dateStart)->where('date_expense', '<=', $dateEnd));
					
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'date_expense', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'concept', 'Concepto' );
		$grid->add ( 'amount', 'Cantidad' );
		$grid->add ( 'expense', 'Gasto' );
		$grid->add ( 'total', 'Total' );
		$grid->add ( 'action', 'Acciones' )->cell ( function ($value, $row) {
			return '
				<a href="#" onclick="opentModelDeleteExpense(this); return false;" data-toggle="tooltip" title="Borrar" data-id="' . $row->exp_id . '" data-concept="' . $row->concept . '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                <a href="#" onclick="actionEditExpense(this); return false;" data-toggle="tooltip" title="Editar Pago" data-id="' . $row->exp_id . '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                ';
		} );
		
		$grid->orderBy ( 'date_expense', 'asc' );
		$grid->paginate ( 10 );
		
		return view ( 'expense.home', compact ( 'filter', 'grid', 'dateStart', 'dateEnd' ) );
	}
	public function postExpenseSave(Request $request) {
		$datos = input::all ();
		
		if ($datos ['exp_id'] !== "") {
			$expense = Expense::where ( 'exp_id', '=', $datos ['exp_id'] )->first ();
			$this->populateExpenseUpdate ( $expense, $datos );
			$expense->save ();
		} else {
			$expense = new Expense ();
			$this->populateExpense ( $expense, $datos );
			$expense->save ();
		}
		return $expense->exp_id;
	}
	public function getExpense($exp_id) {
		try {
			$expense = Expense::where ( 'exp_id', '=', $exp_id )->select ( 'exp_id', 'concept', 'amount', 'expense', 'code_envoice', 'total' )->first ();
			$statusCode = 200;
			
			$response = [ 
					"data" => $expense 
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
	public function getDeleteExpense($exp_id) {
		try {
			$expense = Expense::where ( 'exp_id', '=', $exp_id )->first ();
			$expense->delete();
			$statusCode = 200;
				
			$response = [
					"data" => true
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
	private function populateExpense($expense, $datos) {
		if (isset ( $datos ['exp_id'] ))
			$expense->exp_id = $datos ['exp_id'];
		if (isset ( $datos ['concept'] ))
			$expense->concept = $datos ['concept'];
		if (isset ( $datos ['amount'] ))
			$expense->amount = $datos ['amount'];
		if (isset ( $datos ['expense'] ))
			$expense->expense = $datos ['expense'];
		if (isset ( $datos ['code_envoice'] ))
			$expense->code_envoice = $datos ['code_envoice'];
		$expense->total = $expense->expense * $expense->amount;
		$expense->user_id = Auth::user ()->id;
		$expense->date_expense = DB::raw ( 'now()' );
	}
	private function populateExpenseUpdate($expense, $datos) {
		if (isset ( $datos ['concept'] ))
			$expense->concept = $datos ['concept'];
		if (isset ( $datos ['amount'] ))
			$expense->amount = $datos ['amount'];
		if (isset ( $datos ['expense'] ))
			$expense->expense = $datos ['expense'];
		if (isset ( $datos ['code_envoice'] ))
			$expense->code_envoice = $datos ['code_envoice'];
		$expense->total = $expense->expense * $expense->amount;
	}
}
