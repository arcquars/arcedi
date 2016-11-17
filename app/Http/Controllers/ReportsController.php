<?php

namespace App\Http\Controllers;

use App\Models\Arching;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
	public function __construct() {
		$this->middleware ( 'is_admin' );
	}
	
	public function index() {
		$filter = \DataFilter::source ( Arching::where ( [
			'archings.delete' => 0
		] )				->join('persons', 'persons.id', '=', 'archings.per_id')
			->select('archings.arch_id',
				'archings.total',
				'archings.date_start',
				DB::raw('concat(persons.names, ", ", persons.last_name_f) as fullnames'),
				'archings.date_end')
		);

		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'arch_id', 'Id' );
		$grid->add ( 'date_start', 'Fecha Inicio' );
		$grid->add ( 'date_end', 'Fecha Fin' );
		$grid->add('fullnames', 'Algo');
		$grid->add ( 'total', 'Total' );

		$grid->attributes(array("class" => "table table-striped arcedi_table"));
		$grid->orderBy ( 'arch_id', 'desc' );

		$grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
			return '<a href="#" onclick="openArchingReport(this); return false;" data-id="'.$row->arch_id.'" data-toggle="tooltip" title="Detalle de contratos" data-id="' . $row->arch_id . '"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span></a>'.
			'<a href="#" onclick="openViewReport(this); return false;" data-id="'.$row->arch_id.'" data-toggle="tooltip" title="Detalle de contratos" data-id="' . $row->arch_id . '"><span class="fa fa-arrow-circle-right" aria-hidden="true"></span></a>';
		});

		return view('reports.home', compact('grid'));
	}
}
