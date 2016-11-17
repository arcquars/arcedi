<div id="dErrors" class="alert alert-danger" role="alert" style="display: none;">
</div>
<form id="fSaveArchingBath" class="form-inline">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="grantotal" id="ih_granTotal" >
    <input type="hidden" name="per_id" id="ih_per_id" >
    <div class="row">
        <div class="col-md-3" style="margin-bottom: 0;">
            <label for="i_arch_date_start" class="label-arcedi">Ultimo Arqueo: </label>
        </div>
        <div class="col-md-3" style="margin-bottom: 0;">
            <label for="i_arch_date_end" class="label-arcedi"> Hasta: </label>
        </div>
        <div class="col-md-3" style="margin-bottom: 0;">
            <label for="i_arch_date_end" class="label-arcedi"> Entregado a: </label>
        </div>
        <div class="col-md-3" style="margin-bottom: 0;">
            <label id="l-user-id" class="label1-arcedi"></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class='input-group date datetimepickerStart'>
                <input type='text' name="i_arch_date_start" class="form-control" style="font-size: 12px;"
                       value="<?php echo $dateStart;?>" readonly
                       id="i_arch_date_start" /> <span class="input-group-addon"> <span
                            class="glyphicon glyphicon-calendar"></span>
								</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class='input-group date datetimepickerStart'>
                <input type='text' class="form-control" name="i_arch_date_end" style="font-size: 12px;"
                       id="i_arch_date_end" value="<?php echo $dateEnd;?>" readonly /> <span
                        class="input-group-addon"> <span
                            class="glyphicon glyphicon-calendar"></span>
								</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <input id="iAutoComplete" type="text" class="form-control" placeholder="Buscar Persona" data-autocomplete="{{ url('arching/autocomple') }}">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            </div>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Cerrar Caja</button>
        </div>
    </div>
</form>
<script>
</script>