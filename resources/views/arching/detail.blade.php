@extends('layouts.admin') @section("content")
<div class="row">
	<div class="col-md-3" style="padding-right: 2px;">
		<div class="panel panel-default">

			<hr class="hr_arcedi">
			<div class="panel-body">
				<div class="panel panel-default panel-default-arcedi">
					<div class="panel-heading">Ambientes</div>
					<div class="panel-body">
						<table style="width: 100%;">
							<tr>
								<td colspan="2"><p class="tr_sub_text">Alquileres mensuales</p><hr class="hr_arc_edi"></td>
							</tr>
							<tr>
								<td>Multas: </td>
								<td style="text-align: right;">{!! $totalPaymentMonth['totalPenality'] !!}</td>
							</tr>
							<tr>
								<td>Despensas: </td>
								<td style="text-align: right;">{!! $totalPaymentMonth['totalLarder'] !!}</td>
							</tr>
							<tr>
								<td>Alquiler: </td>
								<td style="text-align: right;">{!! $totalPaymentMonth['totalRenta'] !!}</td>
							</tr>
							<tr>
								<td colspan="2"><p class="tr_sub_text">Anticretico</p><hr class="hr_arc_edi"></td>
							</tr>
							<tr>
								<td>Multas: </td>
								<td style="text-align: right;">{!! $totalPaymentAnti['totalPenality'] !!}</td>
							</tr>
							<tr>
								<td>Despensas: </td>
								<td style="text-align: right;">{!! $totalPaymentAnti['totalLarder'] !!}</td>
							</tr>
							<tr>
								<td colspan="2"><p class="tr_sub_text">Contrato Horas</p><hr class="hr_arc_edi"></td>
							</tr>
							<tr>
								<td>Alquiler: </td>
								<td style="text-align: right;">{!! $totalContractTime['granTotal'] !!}</td>
							</tr>
							<tr>
								<td colspan="2"><p class="tr_sub_text">Contrato Anticreticos</p><hr class="hr_arc_edi"></td>
							</tr>
							<tr>
								<td>Anticretico: </td>
								<td style="text-align: right;">{!! $totalContractAnti['granTotal'] !!}</td>
							</tr>
							<tr>
								<td colspan="2"><p class="tr_sub_text">Contrato Alquiler</p><hr class="hr_arc_edi"></td>
							</tr>
							<tr>
								<td>Garantias: </td>
								<td style="text-align: right;">{!! $totalContractMonth['granTotal'] !!}</td>
							</tr>
							<tr>
								<td colspan="2"><p class="tr_sub_text">Pagos Extra</p><hr class="hr_arc_edi"></td>
							</tr>
							<tr>
								<td>Total: </td>
								<td style="text-align: right;">{!! $totalExtra['granTotal'] !!}</td>
							</tr>
							<tr>
								<td colspan="2"><p class="tr_sub_text">Gastos</p><hr class="hr_arc_edi"></td>
							</tr>
							<tr>
								<td>Gastos: </td>
								<td style="text-align: right;">- {!! $totalOutgo['granTotal'] !!}</td>
							</tr>
							<tr>
								<td>GRAN TOTAL: </td>
								<td style="text-align: right;">{!! (
								$totalPaymentAnti['totalLarder']+
								$totalPaymentAnti['totalPenality']+
								$totalPaymentMonth['totalRenta']+
								$totalPaymentMonth['totalLarder']+
								$totalPaymentMonth['totalPenality']+
								$totalContractTime['granTotal'] + 
								$totalContractAnti['granTotal'] +
								$totalExtra['granTotal'] +
								$totalContractMonth['granTotal'] - 
								$totalOutgo['granTotal']) !!}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9" style="padding-left: 2px;">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3><i class="fa fa-university" aria-hidden="true"></i> Detalle de Arquero</h3>
				<div style="height: 5px;"></div>
				@include('arching.form_arching_disable')
				<div>
					<div style="height: 5px;"></div>
					<ul id="ulAmbientes" class="nav nav-pills nav-justified">
						<li role="presentation" class="active"><a href="#meses"
																  aria-controls="meses" role="tab" data-toggle="tab">Meses</a></li>
						<li role="presentation"><a href="#anti" aria-controls="anti"
												   role="tab" data-toggle="tab">Anticretico</a></li>
						<li role="presentation"><a href="#contractTime"
												   aria-controls="contractTime" role="tab" data-toggle="tab">Contratos
								Hora</a></li>
						<li role="presentation"><a href="#contractAnti"
												   aria-controls="contractAnti" role="tab" data-toggle="tab">Contratos
								Anti.</a></li>
						<li role="presentation"><a href="#contractMonth"
												   aria-controls="contractMonth" role="tab" data-toggle="tab">Contratos
								Mes</a></li>
						<li role="presentation"><a href="#extraPayment"
												   aria-controls="extraPayment" role="tab" data-toggle="tab">Pagos Extra</a></li>
						<li role="presentation"><a href="#outgo" aria-controls="outgo"
												   role="tab" data-toggle="tab">Gastos</a></li>
					</ul>
					<div style="height: 5px;"></div>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="meses">
							<div style="padding: 5px 10px">
								<div style="padding: 5px 5px;">
									<table style="width: 100%;">
										<tr>
											<td><p>
													Total Multas: <span>{!!
																$totalPaymentMonth['totalPenality'] !!}</span>
												</p></td>
											<td><p>
													Total Despensas: <span>{!!
																$totalPaymentMonth['totalLarder'] !!}</span>
												</p></td>
											<td><p>
													Total Alquileres: <span>{!!
																$totalPaymentMonth['totalRenta'] !!}</span>
												</p></td>
											<td style="text-align: right;"><p>
													Gran Total: <span>{!! $totalPaymentMonth['granTotal'] !!}</span>
												</p></td>
										</tr>
									</table>
								</div>
								<hr class="hr_arcedi">
								{!! $grid !!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="anti">
							<div style="padding: 5px 10px">
								<div style="padding: 5px 5px;">
									<table style="width: 100%;">
										<tr>
											<td><p>
													Total Multas: <span>{!!
																$totalPaymentAnti['totalPenality'] !!}</span>
												</p></td>
											<td><p>
													Total Despensas: <span>{!!
																$totalPaymentAnti['totalLarder'] !!}</span>
												</p></td>
											<td style="text-align: right;"><p>
													Gran Total: <span>{!! $totalPaymentAnti['granTotal'] !!}</span>
												</p></td>
										</tr>
									</table>
								</div>
								<hr class="hr_arcedi">
								{!! $gridAnti !!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="contractTime">
							<div style="padding: 5px 10px">
								<div style="padding: 5px 5px;">
									<table style="width: 100%;">
										<tr>
											<td style="text-align: right;"><p>
													Gran Total: <span>{!! $totalContractTime['granTotal'] !!}</span>
												</p></td>
										</tr>
									</table>
								</div>
								<hr class="hr_arcedi">
								{!! $gridContractTime !!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="contractAnti">
							<div style="padding: 5px 10px">
								<div style="padding: 5px 5px;">
									<table style="width: 100%;">
										<tr>
											<td style="text-align: right;"><p>
													Gran Total: <span>{!! $totalContractAnti['granTotal'] !!}</span>
												</p></td>
										</tr>
									</table>
								</div>
								<hr class="hr_arcedi">
								{!! $gridContractAnti !!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="contractMonth">
							<div style="padding: 5px 10px">
								<div style="padding: 5px 5px;">
									<table style="width: 100%;">
										<tr>
											<td style="text-align: right;"><p>
													Gran Total: <span>{!! $totalContractMonth['granTotal']
																!!}</span>
												</p></td>
										</tr>
									</table>
								</div>
								<hr class="hr_arcedi">
								{!! $gridContractMonth !!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="extraPayment">
							<div style="padding: 5px 10px">
								<div style="padding: 5px 5px;">
									<table style="width: 100%;">
										<tr>
											<td style="text-align: right;"><p>
													Gran Total: <span>{!! $totalExtra['granTotal']
																!!}</span>
												</p></td>
										</tr>
									</table>
								</div>
								<hr class="hr_arcedi">
								{!! $gridExtra !!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="outgo">
							<div style="padding: 5px 10px">
								<div style="padding: 5px 5px;">
									<table style="width: 100%;">
										<tr>
											<td style="text-align: right;"><p>
													Gran Total: <span>{!! $totalOutgo['granTotal'] !!}</span>
												</p></td>
										</tr>
									</table>
								</div>
								<hr class="hr_arcedi">
								{!! $gridOutgo !!}
							</div>
						</div>
					</div>
					<div class="panel panel-default" style="display: none;">
						<div class="panel-body">Basic panel example</div>
					</div>
				</div>
				<a href="{{ url('reports/') }}" class="btn btn-primary">Atras</a>
			</div>
		</div>
	</div>
</div>

@stop() @section("script")
<script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
<script>
$( document ).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('#datetimepicker1').datetimepicker();

    setNavActive(6);
	setMenuArchingItemActive(0);

	saveArchingEnvironment($("#fSaveArchingBath"));

	//poniendo el gran total para que vaya al form
	$('#ih_granTotal').val({!! (
								$totalPaymentAnti['totalLarder']+
								$totalPaymentAnti['totalPenality']+
								$totalPaymentMonth['totalRenta']+
								$totalPaymentMonth['totalLarder']+
								$totalPaymentMonth['totalPenality']+
								$totalContractTime['granTotal'] +
								$totalContractAnti['granTotal'] +
								$totalExtra['granTotal'] +
								$totalContractMonth['granTotal'] -
								$totalOutgo['granTotal']) !!});
});
</script>
@stop()
