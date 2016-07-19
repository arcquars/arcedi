<?php

namespace App\Http\Controllers;

use App\Models\Arching;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportsController extends Controller
{
	public function __construct() {
		$this->middleware ( 'is_admin' );
	}
	
	public function index() {
		$filter = \DataFilter::source ( Arching::where ( [
			'delete' => 1
		] )				//->join('contract', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
			->select('arch_id',
				'date_start',
				'date_end')
		);

		$grid = \DataGrid::source ( $filter );
		$grid->add ( 'arch_id', 'Id' );
		$grid->add ( 'date_start', 'Fecha Inicio' );
		$grid->add ( 'date_end', 'Fecha Fin' );


		$grid->orderBy ( 'arch_id', 'desc' );

		$grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
			return '<a href="#" onclick="openArchingReport(this); return false;" data-toggle="tooltip" title="Historial de contratos" data-id="' . $row->arch_id . '"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span></a>';
		});

		return view('reports.home', compact('grid'));
	}
}
