<?php
//print_r($env_lates_anti);
?>
@extends('layouts.admin')
@section("content")
<div class="row">
  <div class="col-md-3" style="padding-right: 2px;">
    <div id="listEnvironments" class="list-group list-group-arcedi">
      <a href="#" class="list-group-item" style="color: #F7FF03; background-color: #474B03; text-align: center">
        Ambientes
      </a>
      <a href="#" onclick="clickA(this); return false;" class="list-group-item active" data-value="Departamento">Departamentos</a>
      <a href="#" onclick="clickA(this); return false;" class="list-group-item" data-value="Oficina">Oficinas</a>
      <a href="#" onclick="clickA(this); return false;" class="list-group-item" data-value="Tienda">Tiendas</a>
      <a href="#" onclick="clickA(this); return false;" class="list-group-item" data-value="Deposito">Depositos</a>
      <a href="#s" onclick="clickA(this); return false;" class="list-group-item" data-value="Area Social">Area Social</a>
    </div>
	  <ul class="list-group">
		  <?php if(count($env_lates_month) > 0){ ?>
		  <li class="list-group-item li_title">
			  <span>Atrasos contrato mes</span>
		  </li>
		  @foreach ($env_lates_month as $env_late)
			  <li class="list-group-item">
				  <span class="badge" style="color: red; background-color: #00b5ad;">{{ $env_late['fee'] }}</span>
				  {{ $env_late['code'] }} dias de mora:
			  </li>
		  @endforeach
		  <?php } ?>

			  <?php if(count($env_lates_anti) > 0){ ?>
			  <li class="list-group-item li_title">
				  <span>Atrasos contrato anticrisis</span>
			  </li>
			  @foreach ($env_lates_anti as $env_late)
				  <li class="list-group-item">
					  <span class="badge" style="color: red; background-color: #00b5ad;">{{ $env_late['fee'] }}</span>
					  {{ $env_late['code'] }} dias de mora:
				  </li>
			  @endforeach
			  <?php } ?>
	  </ul>
  </div>
  <div class="col-md-9" style="padding-left: 2px;">
    <div class="panel panel-default">
      <div class="panel-body">
      {!! $filter !!}
      {!! $grid !!}
      </div>
    </div>
  </div>
</div>
<div id="modalContract" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title arcedu_title_modal">Contrato Alquiler</h4>
      </div>
      <div class="modal-body" id="modalContractBody" style="padding: 2px 20px;">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalG"></div>
<div id="modal_main" class="modal fade" tabindex="-1" role="dialog"></div>

<div id="modalSelectTypeContract" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title arcedu_title_modal">Seleccione Tipo de Contrato</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
      	<input type="hidden" id="typeContractIdEnvironment" value="" >
      	<input type="hidden" id="typeContractCodeEnvironment" value="">
      	<div class="btn-group" role="group" aria-label="">
		  <button onclick="openDialogContract(1); return false;" type="button" class="btn btn-primary notEnviroment">Alquiler</button>
		  <button onclick="openDialogContract(2); return false;" type="button" class="btn btn-primary notEnviroment">Anticretico</button>
		  <button onclick="openDialogContract(3); return false;" type="button" class="btn btn-primary enviroment">Hora</button>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop()
@section("script")
	{!! Html::style( asset('assets/bower/FlexSlider/flexslider.css')) !!}
	{{ HTML::script(asset('assets/bower/FlexSlider/jquery.flexslider.js')) }}
<script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
<script type="text/javascript" src="/assets/js/arcedu_chora.js"></script>
<script type="text/javascript" src="/assets/js/arcedu_env_image.js"></script>

	<script type="text/javascript" src="/assets/js/models/arcedu_extra_payment_m.js"></script>
	<script type="text/javascript" src="/assets/js/templates/arcedu_extra_payment_t.js"></script>
	<script type="text/javascript" src="/assets/js/views/arcedu_extra_payment_v.js"></script>

<script>
$( document ).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('#datetimepicker1').datetimepicker();
    
    if($("#type").val() === ""){
      removeClassSelectedListGroup();
    }else{
      setSelectedListGroup($("#type").val());
    }
    /*
    var cliente = new Cliente({nombre:'Alfonso', apellidos:'Mar��n Mar��n'});
    var ficha = new FichaCliente({el:$('#ficha'), model: cliente});
    ficha.render();
    */

});

function removeClassSelectedListGroup(){
  links = $("#listEnvironments > a");
  $.each( links, function( key, value ) {
    $(value).removeClass("active");
  });
}

function setSelectedListGroup(environment){
  links = $("#listEnvironments > a");
  $.each( links, function( key, value ) {
    if($(value).attr("data-value") === environment){
      $(value).addClass("active");
    }
    else
      $(value).removeClass("active");
  });
}

function clickA(link){
  $("#type").val($(link).attr("data-value"));
  $("#searchId").submit();
}

function doContract(link){
	$('#modalSelectTypeContract').modal('show');
	$('#modalSelectTypeContract').on('shown.bs.modal', function (e) {
		$("#typeContractIdEnvironment").val($(link).attr("data-id"));
		$("#typeContractCodeEnvironment").val($(link).attr("data-code"));
		enableAreaSocial($(link).attr("data-type"));
	});
	/*
  $('#modalContract').modal('show');
  $('#modalContract').on('shown.bs.modal', function (e) {
    var contractMonth = new ContractMonth({environmentName: $(link).attr('data-code')});
    var contractMonthView = new ContractMonthView({el:$('#modalContractBody'), model: contractMonth});
    contractMonthView.render();
    $('.datetimepicker1').datetimepicker({
    	locale: moment.locale('es'),
    	format: 'DD-MM-YYYY'
    });
  });
	  */
}

function enableAreaSocial(env_type){
	if(env_type === "Area Social"){
		$(".notEnviroment").prop( "disabled", true );
		$(".enviroment").prop( "disabled", false );
	}else{
		$(".notEnviroment").prop( "disabled", false );
		$(".enviroment").prop( "disabled", true );
	}
	
}

function openDialogContract(option){
	switch(option) {
	    case 1:
	    	$('#modalContract').modal('show');
			$('#modalContract').on('shown.bs.modal', function (e) {
	    	    var contractMonth = new ContractMonth({
		    	    environmentName: $("#typeContractCodeEnvironment").val(),
		    	    environmentId: $("#typeContractIdEnvironment").val()});

	    	    var contractMonthView = new ContractMonthView({el:$('#modalContractBody'), model: contractMonth});
	    	    Backbone.Validation.bind(contractMonthView);
	    	    contractMonthView.render();
				$('.datetimepickerContract').datetimepicker({
					locale: moment.locale('es'),
					format: 'YYYY-MM-DD',
					//viewMode: "months",
					defaultDate: moment()
				});
	    	    $('.datetimepickerStart').datetimepicker({
	    	    	locale: moment.locale('es'),
	    	    	format: 'YYYY-MM-DD',
	    	    	//
	    	    	viewMode: "months",
	    	    	defaultDate: moment()
	    	    	//startView: "month"
	    	    });
	    	    $('.datetimepickerEnd').datetimepicker({
	    	    	locale: moment.locale('es'),
	    	    	format: 'YYYY-MM',
	    	    	viewMode: "months",
	    	    	defaultDate: moment().add(1, 'years')
	    	    	//startView: "month"
	    	    });
			});
			$('#modalSelectTypeContract').modal('hide');
	        break;
	    case 2:
	    	var contractAntiModel = new ContractAnti({
	    	    environmentName: $("#typeContractCodeEnvironment").val(),
	    	    environmentId: $("#typeContractIdEnvironment").val(),
	    	    dateStart: "<?php echo date("Y-m-d"); ?>"
			});
	    	var modalView = new ContractAntiView({model: contractAntiModel});
			Backbone.Validation.bind(modalView);
			modalView.show();
	        break;
	    case 3:
	    	var contracttimeModel = new ContractTimeModel({
	    		environmentName: $("#typeContractCodeEnvironment").val(),
	    	    environmentId: $("#typeContractIdEnvironment").val(),
	    	    dateStart: "<?php echo date("Y-m-d"); ?>"
		    	});
	    	var modalView = new ContractTimeView({model: contracttimeModel});
			Backbone.Validation.bind(modalView);
			modalView.show();
	        break;
	    default:
	    	alert("default");
	}
}

function paymentMonth(link){
	$.ajax({
		url: "/admin/typeRental/"+$(link).attr('data-id'),
		type: "get",
		dataType: "json",
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			openByTypeRental(data.type_contrat, $(link).attr('data-id'));
		}
  	 });
		
	
}

function openByTypeRental(type, env_id){
	switch (type.rental)
    {
		case 1:
			dataPaymentMonth(env_id);
       		break;
		case 2: 
			dataPaymentAnti(env_id);
			break;
       	case 3: 
    	   alert("modal para hora");
			break;
    }
}

function dataPaymentMonth(env_id){
	var paymentMonthModal = new PaymentMonth();
	$.ajax({
		url: "/admin/dataRentMonth/"+env_id,
		type: "get",
		dataType: "json",
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			if(data.data.rental_state != "0"){
				openPaymentMonth(data);
			}else{
				openPaymentWarrantyMonth(data);
			}
		}
  	 });
}

function dataPaymentAnti(env_id){
	var paymentMonthModal = new PaymentMonth();
	$.ajax({
		url: "/admin/dataRentAnti/"+env_id,
		type: "get",
		dataType: "json",
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			if(data.data.rental_state != "0"){
				openPaymentAnti(data);
			}else{
				openPaymentWarrantyAnti(data);
			}
		}
  	 });
}

	function viewEnvImages(link){
		var env_id = $(link).attr("data-id");
		$.ajax({
			url: "/admin/getEnvImages/"+env_id,
			type: "get",
			dataType: "json",
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			success:function (data) {
				var envImage = new EnvImage({items: data.data});
				var modalView = new EnvImageView({model: envImage});
				modalView.show();
			}
		});
	}

	function endContract(link){
		var env_id = $(link).attr("data-id");
		$.ajax({
			url: "/admin/endContract/"+env_id,
			type: "get",
			dataType: "json",
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			success:function (data) {
				//alert(data);
				location.reload();
			}
		});
	}

function cobroExtra(link){
	var env_id = $(link).attr("data-id");

	$.ajax({
		url: "/admin/dataContrac/"+env_id,
		type: "get",
		dataType: "json",
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			var model = new ExtraPayment();
			model.set('env_id', env_id);
			model.set('ci', data.contract.ci);
			model.set('names', data.contract.last_name_f);
			model.set('env_code', data.contract.code);
			model.set('contract_id', data.contract.contract_id);
			var view = new ExtraPaymentView({el: $("#modal_main"), 'model': model});
			Backbone.Validation.bind(view);
			view.show();

		}
	});
}

</script>
@stop()