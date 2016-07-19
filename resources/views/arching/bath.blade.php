@extends('layouts.admin') @section("content")
<div class="row">
	<div class="col-md-3" style="padding-right: 2px;">
		<div class="panel panel-default">
			@include('arching.menu_arching')
			<hr class="hr_arcedi">
			<div class="panel-body">
				<div class="panel panel-default panel-default-arcedi">
					<div class="panel-heading">Baños</div>
					<div class="panel-body">
						<table style="width: 100%;">
							<tr>
								<td>Ingreso: </td>
								<td style="text-align: right;">{!! $totalEntry  !!}</td>
							</tr>
							<tr>
								<td>Gastos: </td>
								<td style="text-align: right;">{!! $totalSpending !!}</td>
							</tr>
							<tr>
								<td>GRAN TOTAL: </td>
								<td style="text-align: right;">{!! ($totalEntry - $totalSpending) !!}</td>
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
				@include('arching.form_arching')
				<div>
					<div style="height: 5px;"></div>
					<ul id="ulBath" class="nav nav-pills nav-justified">
						<li role="presentation" class="active"><a href="#entry"
																  aria-controls="entry" role="tab" data-toggle="tab">Ingresos</a></li>
						<li role="presentation"><a href="#spending" aria-controls="spending"
												   role="tab" data-toggle="tab">Gastos</a></li>
					</ul>
					<div style="height: 5px;"></div>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="entry">
							<div style="padding: 5px, 10px">
								<div style="padding: 5px 5px; text-align: right;  ">
									Total Ingreso: <span>{!! $totalEntry !!}</span>
								</div>
								<hr class="hr_arcedi">
								{!! $grid !!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="spending">
							<div style="padding: 5px, 10px">
								<div style="padding: 5px 5px; text-align: right;  ">
									Total Gastos: <span>{!! $totalSpending !!}</span>
								</div>
								<hr class="hr_arcedi">
								{!! $gridSpending !!}
							</div>
						</div>
					</div>
				</div>
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

    setNavActive(5);
	setMenuArchingItemActive(1);

	saveArchingBath($("#fSaveArchingBath"));

});
</script>
@stop()
