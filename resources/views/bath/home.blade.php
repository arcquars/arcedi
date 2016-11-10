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
			  		<button onclick="openBathModal(); return false;" class="btn btn-primary" aria-label="Bold" type="button">
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
						Total ingresos: <span>{!! $totalEntry !!}</span>
					</div>
					<hr class="hr_arcedi">
					{!! $grid !!}
				</div>
			</div>
	  	</div>
	</div>
@stop()
@section("script")
<script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
<script type="text/javascript" src="/assets/js/arcedu_bath.js"></script>
<script>
$( document ).ready(function() {
	setNavActive(4);
	setMenuItemActive(0);
	
});

function openBathModal(){

	var bathMode = new BathModel({
		date_entry: "<?php echo $date_insert_next; ?>"
	});

	var modalView = new BathView({model: bathMode});
	Backbone.Validation.bind(modalView);
	modalView.show();

}
</script>

@stop()