@extends('layouts.admin')
@section("content")
<div class="row">
  <div class="col-md-3" style="padding-right: 2px;">
      @include('storedetail.menu_storedetail')
  </div>
  <div class="col-md-9" style="padding-left: 2px;">
    <div class="panel panel-default">
      <div class="panel-body">
          <h4>Historial de Ventas</h4>
          <div style="height: 10px;"></div>
          <input type="hidden" id="ihSaleId">
          {!! $filter !!}
            {!! $grid !!}
      </div>
    </div>
  </div>
</div>

<div id="mDetailSale" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="fBuyDetail">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detalle de compra</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2"><p style="color: #474B03;">CI:</p></div>
                        <div class="col-md-4"><p id="pSaleCi"></p></div>
                        <div class="col-md-2"><p style="color: #474B03;">Fecha:</p></div>
                        <div class="col-md-4"><p id="pSaleDate"></p></div>

                    </div>
                    <div class="row">
                        <div class="col-md-2"><p style="color: #474B03;">Detalle:</p></div>
                        <div class="col-md-10"><p id="pSaleDetail"></p></div>
                    </div>
                    <div class="row" style="padding-left: 10px; padding-right: 10px;">
                        <table id="tProducts" class="table table-bordered arcedi_table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10" style="text-align: right"><p  style="color: #474B03;">TOTAL:</p></div>
                        <div class="col-md-2"><p id="pSaleTotal"></p></div>
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
    setNavActive(3);
    setActiveMenuStore($("#dMenuStore"), 2);

    $('#mDetailSale').on('show.bs.modal', function (e) {
        //alert("ssssss: "+$("#ihBuyId").val());
        setModelDetailSale($("#ihSaleId").val());
    });
});

function openViewSaleDetail(bdId){
    $("#ihSaleId").val(bdId);
    $("#mDetailSale").modal("show");
}
</script>
@stop()