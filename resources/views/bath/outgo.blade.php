@extends('layouts.admin')
@section("content")
	<div class="row" style="margin-left: 0; margin-right: 0;">
		<div class="col-md-3 cols_padd">
			<div class="panel panel-default">
				<div id="d_menu_bath" class="list-group">
					<a href="{{ url('/bath') }}" class="list-group-item">
						Ingresos Diarios
					</a>
					<a href="{{ url('/bath/outgo') }}" class="list-group-item">Gastos Diarios</a>
				</div>
			</div>
		</div>
		<div class="col-md-9 cols_padd">
			<div class="panel panel-default">
				<div class="panel-body">
					<div style="text-align: right; width: 100%;">
						<button onclick="openBathSpendingModal(); return false;" class="btn btn-primary" aria-label="Bold" type="button">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
					</div>
					<form class="form-inline" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="i_arch_date_start">Ultimo Arqueo: </label>
							<div style="display: inline;">
								<div class='input-group date datetimepickerStart'>
									<input type='text' name="i_arch_date_start" class="form-control" style="font-size: 12px;"
										   value="<?php echo $dateStart;?>" readonly
										   id="i_arch_date_start" /> <span class="input-group-addon"> <span
												class="glyphicon glyphicon-calendar"></span>
								</span>
								</div>
							</div>
						</div>
					</form>
					<div style="text-align: right;">
						Total gastos: <span>{!! $totalOutgo !!}</span>
					</div>
					<hr class="hr_arcedi">
					{!! $grid !!}
				</div>
			</div>
		</div>
	</div>
	<div id="modalDeleteBathS" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Borrar Gasto</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger" role="alert">
						<p>Se borrara el gasto:</p>
						<p style="padding-left: 10px;"><b><span id="sDateSpending"></span> - <span id="sDetail"></span> - <span id="sOutgo"></span></b></p>
						<input type="hidden" value="{{ csrf_token() }}" id="hToken">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id="bDeleteBathSpending" class="btn btn-primary">Borrar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop()
@section("script")
<script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
<script type="text/javascript" src="/assets/js/arcedu_bath_spending.js"></script>
<script>
$( document ).ready(function() {
	setNavActive(4);
	setMenuItemActive(1);
	
});

function openBathSpendingModal(){

	var bathSpendingMode = new BathSpendingModel({
		date_spending: "<?php echo $date_now; ?>"
	});

	var modalView = new BathSpendingView({model: bathSpendingMode});
	Backbone.Validation.bind(modalView);
	modalView.show();

}
</script>

@stop()