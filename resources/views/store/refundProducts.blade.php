<?php
$dateSale = new DateTime();
?>
@extends('layouts.admin')
@section("content")
<div class="row">
  <div class="col-md-3" style="padding-right: 2px;">
      @include('store.menu_store')
  </div>
  <div class="col-md-9" style="padding-left: 2px;">
    <div class="panel panel-default">
      <div class="panel-body">
          <h4>Devolución de productos</h4>
          <br>
          <form method="post" id="fSaleProduct" class="form-horizontal">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                  <label for="nCi" class="col-sm-2 control-label">Ci</label>
                  <div class="col-sm-4">
                      <input class="form-control" id="iCi" name="nCi" type="number" min="0" >
                  </div>
                  <label for="nDateSale" class="col-sm-2 control-label">Fecha</label>
                  <div class="col-sm-4">
                      <div class='input-group date' id='dtpDateDelivery'>
                          <input type='text' class="form-control" name="nDateSale"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Detalle</label>
                  <div class="col-sm-10">
                      <input class="form-control" type="text" id="iDetail" name="nDetail" >
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <input id="hProductSelect" type="hidden" value="" data-id="" data-name="">
                      <div class="input-group">
                          <input id="iSearch" type="text" class="form-control typeaheadStoreMovements" placeholder="Buscar..." autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-default" style="font-size: 20px !important;" type="button" onclick="openNodalAddProduct(); return false;"><span class="fa fa-plus-square-o"></span></button>
                        </span>
                      </div><!-- /input-group -->
                  </div>
              </div>
              <div class="row" style="padding-right: 15px; padding-left: 15px;">
                  <table id="tProducts" class="table table-striped arcedi_table">
                      <thead>
                          <tr>
                              <th>Nombre Producto</th>
                              <th>Codigo</th>
                              <th>Cantidad</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
              </div>
              <div class="row" style="text-align: right; padding-right: 15px; padding-left: 15px;">
                  <p id="productError-error" class="error"></p>
              </div>
              <div class="row" style="text-align: right; padding-right: 15px; padding-left: 15px;">
                  <input type="button" onclick="redirectByPath('{{ url('store') }}');" class="btn btn-default" value="Atras">
                  <input type="submit" class="btn btn-primary" value="Grabar">
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<div id="mAddProductBuy" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="fAddProduct">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Añadir Producto</h4>
                </div>
                <div class="modal-body">
                    <label id="lProduct" class="control-label arcedi-label"></label>
                    <input type="hidden" id="iProductId" >
                    <input type="hidden" id="iProductName" >
                    <input type="hidden" id="iProductCode" >
                        <div class="form-group">
                            <label class="arcedi-form-label" for="iQuantity">Cantidad</label>
                            <input type="text" class="form-control" id="iProductQuantity" name="iQuantity" placeholder="Cantidad..." autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="iName" >
                    <input type="hidden" id="iId" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
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
    setNavActive(2);
    setActiveMenuStore($("#dMenuStore"), 4);

    $('#mAddProductBuy').on('shown.bs.modal', function () {
        var name = $("#hProductSelect").attr("data-name");
        var code = $("#hProductSelect").attr("data-code");
        var price = $("#hProductSelect").attr("data-price");
        var total = $("#hProductSelect").attr("data-total");
        var id = $("#hProductSelect").attr("data-id");

        $("#lProduct").empty();
        $("#lProduct").append(name+" (max para entregar: "+total+")");
        $("#iProductName").val(name);
        $("#iProductCode").val(code);
        $("#iProductId").val(id);

        $("#iProductPrice").val(price);

        $("#iProductQuantity").val("");
        $("#iProductQuantity").focus();

        //$("#fAddProduct").rules( "remove" );
        $('#fAddProduct').data('validator', null);
        $("#fAddProduct").unbind('validate');

            $("#fAddProduct").validate({
                lang: 'es',
                rules: {
                    iQuantity: {
                        required: true,
                        range: [1, total],
                        digits: true
                    },
                },
                messages: {
                    iQuantity: {
                        required: "No puede estar vacio",
                        range: "Numero entre 1 y "+total,
                        digits: "Solo numeros Enteros"
                    },
                }
            });


    });

    $('#mAddProductBuy').on('hidden.bs.modal', function () {
        $("#lProduct").empty();
        $("#iProductId").val("");
        $("#iProductName").val("");
        $("#iProductCode").val("");

        $("#hProductSelect").attr("data-name", "");
        $("#hProductSelect").attr("data-id", "");
        $("#hProductSelect").attr("data-code", "");
        $("#hProductSelect").val("");
        $(".typeaheadStoreMovements").val("");


    });

    $("#fAddProduct").submit(function( event ) {
        event.preventDefault();

        if($("#fAddProduct").valid()){
            var idP = $("#fAddProduct").find("input#iProductId").val();
            var nameP = $("#fAddProduct").find("input#iProductName").val();
            var codeP = $("#fAddProduct").find("input#iProductCode").val();
            var quantityP = $("#fAddProduct").find("input#iProductQuantity").val();
            var priceP = $("#fAddProduct").find("input#iProductPrice").val();

            addProductDeliveryTable($("#tProducts"), idP, nameP, codeP, quantityP);
            $("#mAddProductBuy").modal("hide");
            //alert("entro al IF: "+idP+" "+nameP+" "+codeP+" "+quantityP+" "+priceP);
        }

    });

    $("#fSaleProduct").submit(function( event ) {
        event.preventDefault();

        if($("#fSaleProduct").valid()){
            if(numRow($("#tProducts")) > 0){
                saveRefund();
                //alert("entro al IF: ");
            }else{
                $("#productError-error").empty();
                $("#productError-error").append("Seleccione productos para entregar a tienda.");
                $('#productError-error').show(0).delay(4000).hide(0);
            }
        }

    });

    $.validator.methods.twoDigtis = function( value, element ) {
        return this.optional( element ) || /^\d+\.\d{0,2}$/.test( value );
    }


    $("#fSaleProduct").validate({
        lang: 'es',
        rules: {
            nCi: {
                required: true,
            },
            nDateSale: {
                required: true,
            },
            nDetail:{
                required: true,
                maxlength: 150
            }
        },
        messages: {
            nCi: {
                required: "Nombre del proveedor requerido",
            },
            nDateSale: {
                required: "Fecha de compra requerido",
            },
            nDetail:{
                required: "Detalle requerido",
                maxlength: "Limite de caracteres 150"
            }
        }
    });

    var dateSale = moment("<?php echo date_format($dateSale, 'Y-m-d'); ?>");
    var dateSaleMin = moment("<?php echo date_format($dateSale, 'Y-m-d'); ?>");
    var dateSaleMax = moment("<?php echo date_format($dateSale, 'Y-m-d'); ?>");
    $('#dtpDateDelivery').datetimepicker({
        locale: moment.locale('es'),
        format: 'YYYY-MM-DD',
        //viewMode: "months",
        defaultDate: dateSale,
        maxDate: dateSaleMin.add(1, "days"),
        minDate: dateSaleMax.subtract(1, 'days')
    });

    $('input.typeaheadStoreMovements').typeahead({
        onSelect: function(item) {
            console.log(item);
            var res = item.text.split(" || ");
            if(res.length >= 2){
                $("#hProductSelect").attr("data-id", item.value);
                $("#hProductSelect").attr("data-name", res[0]);
                $("#hProductSelect").attr("data-code", res[1]);
                $("#hProductSelect").attr("data-total", res[2]);
                $("#hProductSelect").attr("data-price", res[3]);
                $("#hProductSelect").attr("value", "1");

            }else{
                alert("Algo salio mal... ");
            }
        },
        ajax: {
            url: "/store/findTypeAheadStoreMovements",
            timeout: 500,
            displayField: "name",
            valueField: "id",
            triggerLength: 3,
            dataType: "JSON",
            method: "get",
            loadingClass: "loading-circle",
            preDispatch: function (query){
                $("#hProductSelect").attr("data-id", null);
                $("#hProductSelect").attr("data-name", null);
                $("#hProductSelect").attr("data-code", null);
                $("#hProductSelect").attr("data-total", null);
                $("#hProductSelect").attr("data-price", null);
                $("#hProductSelect").attr("value", "");
                return {
                    search: query
                }
            },
            preProcess: function (data){
                //showLoadingMask(false);
                if (data.success === false) {
                    // Hide the list, there was some error
                    return false;
                }
                // We good!
                return data.source;
            }
        }
    });
});
</script>
@stop()
