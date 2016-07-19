@extends('layouts.admin')
@section("content")
<div class="row">
  <div class="col-md-3" style="padding-right: 2px;">
      @include('store.menu_store')
  </div>
  <div class="col-md-9" style="padding-left: 2px;">
    <div class="panel panel-default">
      <div class="panel-body">
          <h4>Historial de Compras</h4>
          <div style="height: 10px;"></div>
          <input type="hidden" id="ihBuyId">
      {!! $grid !!}
      </div>
    </div>
  </div>
</div>

<div id="mDetailBuy" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="fBuyDetail">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detalle de compra</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2"><p style="color: #474B03;">Proveedor:</p></div>
                        <div class="col-md-4"><p id="pBuyName"></p></div>
                        <div class="col-md-2"><p style="color: #474B03;">NIT:</p></div>
                        <div class="col-md-4"><p id="pBuyNit"></p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><p  style="color: #474B03;"># Doc:</p></div>
                        <div class="col-md-4"><p id="pBuyDoc"></p></div>
                        <div class="col-md-2"><p  style="color: #474B03;">Fecha:</p></div>
                        <div class="col-md-4"><p id="pBuyDate">2016-11-30</p></div>
                    </div>
                    <div class="row" style="padding-left: 10px; padding-right: 10px;">
                        <table id="tProducts" class="table table-bordered arcedi_table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Costo</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Disponible</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10" style="text-align: right"><p  style="color: #474B03;">TOTAL:</p></div>
                        <div class="col-md-2"><p id="pBuyTotal"></p></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop()

@include('layouts.t_store')

@section("script")

	{!! Html::style( asset('assets/bower/FlexSlider/flexslider.css')) !!}
	{{ HTML::script(asset('assets/bower/FlexSlider/jquery.flexslider.js')) }}
    {{ HTML::script(asset('assets/bower/bs-typeahead/js/bootstrap-typeahead.min.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_common.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_store.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_store_function.js')) }}
<script>
$( document ).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $('#mDetailBuy').on('show.bs.modal', function (e) {
        //alert("ssssss: "+$("#ihBuyId").val());
        setModelDetailBuy($("#ihBuyId").val());
    });
});

function openViewBuyDetail(bdId){
    $("#ihBuyId").val(bdId);
    $("#mDetailBuy").modal("show");
}
</script>
@stop()