<div id="dMenuStore" class="list-group" style="padding-left: 10px; padding-right: 10px;">
    <a class="list-group-item menu_title" href="#">
        Acciones
    </a>
    <a class="list-group-item" href="{{ url('/store/buyProducts/') }}">Compra</a>
    <a class="list-group-item" href="{{ url('/store/saleProducts/') }}">Venta</a>
    <a class="list-group-item" href="{{ url('/store/buyHistoric/') }}">Historial Compras</a>
    <a class="list-group-item" href="{{ url('/store/saleHistoric/') }}">Historial Ventas</a>
    <div style="height: 5px;"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="movementModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Comprar / Vender</h4>
            </div>
            <div class="modal-body">
                <input id="hProductSelect1" type="hidden" value="" data-id="" data-name="">
                <div id="dAlertProductRecurrent" style="display: none;" class="alert alert-danger alert-dismissible arcedi_alert fade" role="alert">
                    <p></p>
                </div>
                <div class="input-group">
                    <input id="iSearch" type="text" class="form-control typeahead" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <button onclick="allProductOnList(); return false;" class="btn btn-default" style="font-size: 20px !important;" type="button"><span class="glyphicon glyphicon-ok-circle"></span></button>
                    </span>
                </div><!-- /input-group -->
                <div style="height: 10px;"></div>
                Productos:
                <ul id="listProduct" class="list-group">

                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button onclick="actionComprar(this); return false;" data-url="{{ url('/store/buy/') }}" type="button" class="btn btn-primary">Comprar</button>
                <button type="button" class="btn btn-primary">Vender</button>
            </div>
        </div>
    </div>
</div>
