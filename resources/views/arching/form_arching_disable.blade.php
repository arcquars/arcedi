<form id="fSaveArchingBath" class="form-inline">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="grantotal" id="ih_granTotal" >
    <div class="form-group">
        <label for="i_arch_date_start">Desde: </label>
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
    <div class="form-group">
        <label for="i_arch_date_end"> Hasta: </label>
        <div style="display: inline;">
            <div class='input-group date datetimepickerStart'>
                <input type='text' class="form-control" name="i_arch_date_end" style="font-size: 12px;"
                       id="i_arch_date_end" value="<?php echo $dateEnd;?>" readonly /> <span
                        class="input-group-addon"> <span
                            class="glyphicon glyphicon-calendar"></span>
								</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div style="display: inline;">
            <label for="i_arch_date_end"> Por: </label>
            <div class='input-group date datetimepickerStart'>
                <input type='text' class="form-control" name="i_arch_person_id" style="font-size: 12px;"
                       value="{{$person->names.' '.$person->last_name_f.' '.$person->last_name_m}}" readonly />
            </div>
        </div>
    </div>

</form>
<script>
</script>