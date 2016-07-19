@extends('layouts.admin')
@section("content")
	<div class="row" style="margin-left: 0; margin-right: 0;">
		<div class="col-md-3 cols_padd">
			<div class="panel panel-default">
			  	<div class="panel-body">
			    	<div class="panel panel-default">
					  	<div class="panel-heading">Notificaciones</div>
					  	<div class="panel-body">
					    	Panel content
					  	</div>
					</div>
					<div class="panel panel-default">
					  	<div class="panel-heading">Notificaciones</div>
					  	<div class="panel-body">
					    	Panel content
					  	</div>
					</div>
			  	</div>
			</div>
	  	</div>
	  	<div class="col-md-9 cols_padd">
			<div class="panel panel-default">
			  	<div class="panel-body">
			  		<div style="text-align: right; width: 100%;">
			  			<button onclick="openExpenseModal(); return false;" class="btn btn-primary" aria-label="Bold" type="button">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
			  		</div>
					<div style="height: 5px;"></div>
					<form id="f_expenses_month" class="form-inline">
						 <div class="form-group">
    						<label for="exampleInputEmail2"> Del: </label>
    						<input type="text" class="form-control" disabled id="" value="{!! $dateStart !!}">
  						</div>
  						<div class="form-group">
    						<label for="exampleInputEmail2"> Al: </label>
    						<input type="text" class="form-control" disabled id="" value="{!! $dateEnd !!}">
  						</div>
					</form>
			  	</div>
			  	<div style="margin: 15px 15px;">
			  		{!! $filter !!}
      				{!! $grid !!}	
				</div>
			  	
			</div>
	  	</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="modal_delete_expense">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Borrar Pago</h4>
      			</div>
	      		<div class="modal-body">
	      		<input type="hidden" id="inputHiddenExpId" >
	        		<p>Se eliminara el pago: "<span id="p_delete_concept"></span>"</p>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        		<button type="button" onclick="actionDeleteExpense();" class="btn btn-primary">Borrar</button>
	      		</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop()
@section("script")
<script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
<script type="text/javascript" src="/assets/js/arcedu_expense.js"></script>
<script>
$( document ).ready(function() {
	setNavActive(1);
});
function openExpenseModal(){
	var expenseMode = new ExpenseModel({
	    date_expense: "<?php echo date("Y-m-d H:i:s"); ?>"
    	});
	var modalView = new ExpenseView({model: expenseMode});
	Backbone.Validation.bind(modalView);
	modalView.show();
}

function opentModelDeleteExpense(link){
	var id = $(link).attr("data-id");
	var concept =  $(link).attr("data-concept");
	$("#modal_delete_expense").modal("show");

	$("#modal_delete_expense").on('shown.bs.modal', function (e) {
		$("#p_delete_concept").empty();
		$("#p_delete_concept").text(concept);
		$("#inputHiddenExpId").val(id);
		
	});
}

function actionDeleteExpense(){
	var id= $("#inputHiddenExpId").val();
	$.ajax({
		url: "/expenses/delete/"+id,
		type: "get",
		dataType: "json",
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			location.reload();
		}
	 });
}

</script>

@stop()