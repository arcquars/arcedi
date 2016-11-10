<?php

namespace App\Http\Controllers;

use App\Models\ArchingBath;
use App\Models\BathEntry;
use App\Models\BathSpending;
use App\Models\Extra;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Arching;
use App\Models\PaymentM;
use App\Models\PaymentA;
use App\Models\RentalTime;
use App\Models\Contract;
use App\Models\RentalAnti;
use App\Models\RentalMonth;
use App\Models\Expense;
use Auth;

class ArchingController extends Controller
{
	public function __construct() {
		$this->middleware ( 'is_admin' );
	}
	
	public function index(Request $request) {
		$method = $request->method();
		
		if ($request->isMethod('post')) {
			dd($request->input('i_arch_date_end'));
		}
		
		$arching = Arching::where('delete', "=", "0")->orderBy("arch_id", "desc")->first();
		
		//dd($arching->date_end);
		$query = DB::table("archings");
		$dateStart = "";
		$dateEnd = Carbon::now();
		if(isset($arching)){
			$dateStart = $arching->date_end;
		}
		
		//grid pagos de contrato alquiler mes 
		$grid = $this->getGridPaymentMonth($dateStart, $dateEnd);
		$totalPaymentMonth = PaymentM::archingMonthBeetwen($dateStart, $dateEnd);
		//grid pagos de contrato anticretico
		$gridAnti = $this->getGridPaymentAnti($dateStart, $dateEnd);
		$totalPaymentAnti = PaymentA::archingAntiBeetwen($dateStart, $dateEnd);
		//grid contratos por hora
		$gridContractTime = $this->getGridContractTime($dateStart, $dateEnd);
		$totalContractTime = RentalTime::archingContractTimeBeetwen($dateStart, $dateEnd);
		//grid contrato anticrisis
		$gridContractAnti = $this->getGridContractAnti($dateStart, $dateEnd);
		$totalContractAnti = RentalAnti::archingContractAntiBeetwen($dateStart, $dateEnd);
		//grid contrato mensual
		$gridContractMonth = $this->getGridContractMonth($dateStart, $dateEnd);
		$totalContractMonth = RentalMonth::archingContractMonthBeetwen($dateStart, $dateEnd);
		//grid gastos
		$gridOutgo = $this->getGridOutgo($dateStart, $dateEnd);
		$totalOutgo = Expense::archingOutgoBeetwen($dateStart, $dateEnd);
		//grid pagos extra de contratos

		$gridExtra = $this->getGridExtraPaymentContract($dateStart, $dateEnd);
		$totalExtra = Extra::totalExtraBeetwen($dateStart, $dateEnd);

		//return view('user.profile', ['user' => User::findOrFail($id)]);
		return view('arching.home', compact ( 
				'grid', 'gridAnti', 'gridContractTime',
				'gridExtra', 'totalExtra',
				'dateStart', 'dateEnd', 
				'totalPaymentMonth', 'totalPaymentAnti',
				'totalContractTime', 'gridContractAnti',
				'totalContractAnti', 'gridContractMonth',
				'totalContractMonth', 'gridOutgo',
				'totalOutgo'));
	}

	public function actionBath(Request $request) {
		$method = $request->method();

		if ($request->isMethod('post')) {
			dd($request->input('i_arch_date_end'));
		}

		$arching = ArchingBath::where('delete', "=", "0")->orderBy("ab_id", "desc")->first();

		//dd($arching->date_end);
		$dateStart = "";
		$dateEnd = Carbon::now();
		if(isset($arching)){
			$dateStart = $arching->date_end;
		}

		//grid pagos de contrato alquiler mes
		$grid = $this->getGridBathEntry($dateStart, $dateEnd);
		$totalEntry = BathEntry::bathEntryTotalBeetwenDate($dateStart, $dateEnd);
		//dd($dateStart."|||".$dateEnd);
		//grid pagos de contrato anticretico
		$gridSpending = $this->getGridBathSpending($dateStart, $dateEnd);
		$totalSpending = BathSpending::bathSpendingTotalBeetwenDate($dateStart, $dateEnd);

		return view('arching.bath', compact (
			'grid', 'gridSpending',
			'dateStart', 'dateEnd',
			'totalEntry', 'totalSpending'));
	}
	
	public function saveArching(Request $request) {
		$method = $request->method();
	
		if ($request->isMethod('post')) {
			$dateEnd = $request->input('i_arch_date_end');
			$dateStart = $request->input('i_arch_date_start');
			$total = $request->input('grantotal');

			$arching = new Arching();
			$arching->date_start = $dateStart;
			$arching->date_end = $dateEnd;
			$arching->user_id = $user = Auth::user()->id;
			$arching->total = $total;
			$arching->per_id = 1;
			
			$arching->save();
			
			//return redirect()->action('ReportsController@index');
			return "true";
		}
	}

	public function saveArchingBath(Request $request) {
		$method = $request->method();

		if ($request->isMethod('post')) {
			$dateEnd = $request->input('i_arch_date_end');
			$dateStart = $request->input('i_arch_date_start');

			$arching = new ArchingBath();
			$arching->date_start = $dateStart;
			$arching->date_end = $dateEnd;
			$arching->user_id = $user = Auth::user()->id;
			$arching->per_id = 1;

			$arching->save();
			return "true";
		}
	}

	private function getGridPaymentMonth($dateStart, $dateEnd){
		$filter = \DataFilter::source ( PaymentM::where ( [
				'environments.delete' => 0
		] )->where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)
				->join('contract', 'contract.rental_m_id', '=', 'payment_m.rental_m_id')
				->join('environments', 'environments.env_id', '=', 'contract.env_id')
				->select('environments.code as code',
						'payment_m.payment_date',
						'payment_m.total',
						'payment_m.month_total',
						'payment_m.payment_rental',
						'payment_m.penalty_fee',
						'payment_m.payment_larder',
						'payment_m.date_start',
						'payment_m.date_end')
				);
		
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'payment_date', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'code', 'Codigo' );
		$grid->add ( 'month_total', 'Meses pago' );
		$grid->add ( 'date_start', 'Fecha desde' );
		$grid->add ( 'date_end', 'Fecha hasta' );
		$grid->add ( 'penalty_fee', 'Multa' );
		$grid->add ( 'payment_larder', 'Despensa' );
		$grid->add ( 'payment_rental', 'Pago Mes' );
		$grid->add ( 'total', 'Total' );
		
		$grid->orderBy ( 'payment_date', 'asc' );
		//$grid->paginate ( 10 );
			
		return $grid;
	}

	private function getGridBathEntry($dateStart, $dateEnd){
		$filter = \DataFilter::source ( BathEntry::where ( [
			'delete' => 0
		] )->where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd)
			->select('created_at',
				'date_entry',
				'detail',
				'ci',
				'amount')
		);

		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'created_at', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'date_entry', 'Fecha Ingreso' );
		$grid->add ( 'detail', 'Observacion' );
		$grid->add ( 'ci', 'Ci' );
		$grid->add ( 'amount', 'Cantidad' );

		$grid->orderBy ( 'date_entry', 'asc' );
		//$grid->paginate ( 10 );

		return $grid;
	}

	private function getGridBathSpending($dateStart, $dateEnd){
		$filter = \DataFilter::source ( BathSpending::where ( [
			'delete' => 0
		] )->where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd)
			->select('created_at',
			'date_spending',
			'detail',
			'code_envoice',
			'outgo')
		);

		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'created_at', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'date_spending', 'Fecha Gasto' );
		$grid->add ( 'detail', 'Concepto' );
		$grid->add ( 'code_envoice', '# Factura' );
		$grid->add ( 'outgo', 'Gasto' );

		$grid->orderBy ( 'date_spending', 'asc' );
		//$grid->paginate ( 10 );

		return $grid;
	}
	
	private function getGridPaymentAnti($dateStart, $dateEnd){
		$filter = \DataFilter::source ( PaymentA::where ( [
				'contract.delete' => 0
		] )				//->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
				->where('payment_date', '>=', $dateStart)->where('payment_date', '<=', $dateEnd)
				//->join('rental_anti', 'rental_anti.ra_id', '=', 'payment_a.rental_a_id')
				->join('contract', 'contract.anticrisis_id', '=', 'payment_a.rental_a_id')
				->join('environments', 'environments.env_id', '=', 'contract.env_id')
				->select('environments.code as code', 
						'payment_a.payment_date',
						'payment_a.total',
						'payment_a.month_total',
						'payment_a.penalty_fee',
						'payment_a.payment_larder',
						'payment_a.date_start',
						'payment_a.date_end')
				);
	
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'payment_date', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'code', 'Codigo' );
		$grid->add ( 'month_total', 'Meses pago' );
		$grid->add ( 'date_start', 'Fecha desde' );
		$grid->add ( 'date_end', 'Fecha hasta' );
		$grid->add ( 'penalty_fee', 'Multa' );
		$grid->add ( 'payment_larder', 'Despensa' );
		$grid->add ( 'total', 'Total' );
	
		$grid->orderBy ( 'payment_date', 'asc' );
		//$grid->paginate ( 10 );
			
		return $grid;
	}
	
	private function getGridContractTime($dateStart, $dateEnd){
		$filter = \DataFilter::source ( RentalTime::where ( [
				'contract.delete' => 0
		] )				//->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
				->where('rental_time.created_at', '>=', $dateStart)->where('rental_time.created_at', '<=', $dateEnd)
				//->join('rental_anti', 'rental_anti.ra_id', '=', 'payment_a.rental_a_id')
				->join('contract', 'contract.rental_h_id', '=', 'rental_time.rt_id')
				->join('environments', 'environments.env_id', '=', 'contract.env_id')
				->select('environments.code as code',
						'rental_time.created_at',
						'rental_time.date_contract',
						'rental_time.created_at',
						'rental_time.rental_payment',
						'rental_time.time_total',
						'rental_time.detail_time')
				);
	
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'created_at', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'code', 'Codigo' );
		$grid->add ( 'date_contract', 'Fecha de Uso' );
		$grid->add ( 'time_total', 'Horas' );
		$grid->add ( 'rental_payment', 'Pago por hora' );
		$grid->add ( 'detail_time', 'Detalle Horas' );
		$grid->add ( 'total', 'Total' )->cell ( function ($value, $row) {
			return ($row->rental_payment * $row->time_total);
		} );
	
		$grid->orderBy ( 'created_at', 'asc' );
		//$grid->paginate ( 10 );
			
		return $grid;
	}
	
	private function getGridContractAnti($dateStart, $dateEnd){
		$filter = \DataFilter::source ( RentalAnti::where ( [
				'contract.delete' => 0, 'rental_anti.state' => 1
		] )				//->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
				->where('rental_anti.created_at', '>=', $dateStart)->where('rental_anti.created_at', '<=', $dateEnd)
				->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
				->join('environments', 'environments.env_id', '=', 'contract.env_id')
				->select('environments.code as code',
						'rental_anti.created_at',
						'rental_anti.date_admission',
						'rental_anti.date_end',
						'rental_anti.anticretico')
				);
	
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'created_at', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'code', 'Codigo' );
		$grid->add ( 'date_admission', 'Fecha Inicio' );
		$grid->add ( 'date_end', 'Fecha Fin' );
		$grid->add ( 'anticretico', 'Anticrisis' );
		
	
		$grid->orderBy ( 'created_at', 'asc' );
				
		return $grid;
	}
	
	private function getGridContractMonth($dateStart, $dateEnd){
		$filter = \DataFilter::source ( RentalMonth::where ( [
				'contract.delete' => 0, 'rental_month.state' => 1
		] )				//->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
				->where('rental_month.created_at', '>=', $dateStart)->where('rental_month.created_at', '<=', $dateEnd)
				->join('contract', 'contract.rental_m_id', '=', 'rental_month.rm_id')
				->join('environments', 'environments.env_id', '=', 'contract.env_id')
				->select('environments.code as code',
						'rental_month.created_at',
						'rental_month.date_admission',
						'rental_month.date_end',
						'rental_month.warranty')
				);
	
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'created_at', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'code', 'Codigo' );
		$grid->add ( 'date_admission', 'Fecha Inicio' );
		$grid->add ( 'date_end', 'Fecha Fin' );
		$grid->add ( 'warranty', 'Garantia' );
	
	
		$grid->orderBy ( 'created_at', 'asc' );
	
		return $grid;
	}

	private function getGridExtraPaymentContract($dateStart, $dateEnd){
		$filter = \DataFilter::source ( Extra::where ( [
			'contract.delete' => 0
		] )				//->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
		->where('date_extra', '>=', $dateStart)->where('date_extra', '<=', $dateEnd)
			->join('contract', 'contract.contract_id', '=', 'extra.contract_id')
			->join('environments', 'environments.env_id', '=', 'contract.env_id')
			->select('environments.code as code',
				'extra.date_extra',
				'extra.detail',
				'extra.total')
		);

		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'code', 'Codigo' );
		$grid->add ( 'date_extra', 'Fecha Inicio' );
		$grid->add ( 'total', 'Cantidad' );


		$grid->orderBy ( 'date_extra', 'asc' );

		return $grid;
	}
	
	private function getGridOutgo($dateStart, $dateEnd){
		$filter = \DataFilter::source ( Expense::where ( [
				'expenses.delete' => 0
		] )				//->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
				->where('expenses.date_expense', '>=', $dateStart)->where('expenses.date_expense', '<=', $dateEnd)
				->select(
						'expenses.date_expense',
						'expenses.concept',
						'expenses.expense',
						'expenses.amount',
						'expenses.total')
				);
	
		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'date_expense', 'Fecha', true )->style ( "width:100px" );
		$grid->add ( 'concept', 'Detalle' );
		$grid->add ( 'expense', 'Gasto' );
		$grid->add ( 'amount', 'Cantidad' );
		$grid->add ( 'total', 'Total' );
	
	
		$grid->orderBy ( 'date_expense', 'asc' );
	
		return $grid;
	}
}
