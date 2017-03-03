<div id="modal_person" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        {!! Form::model($personModel, ['route' => ['person.create'], 'id' => 'fPerson']) !!}
        <input type="hidden" name="id">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Persona</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label">CI:</label>
                        {!! Form::text('ci', $personModel->ci, ['class' => 'form-control', 'onchange' => 'clearError(this);']) !!}
                        <em class="error_text_arcedi error_ci" style="display: none;"></em>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Expedido:</label>
                        <select class="form-control" name="expedido" onchange="clearError(this);">
                            <option value="">Seleccione Departamento</option>
                            <option value="BNI">Beni</option>
                            <option value="CHQ">Chuquisaca</option>
                            <option value="CBA">Cochabamba</option>
                            <option value="LPZ">La Paz</option>
                            <option value="ORU">Oruro</option>
                            <option value="PND">Pando</option>
                            <option value="PSI">Potosí</option>
                            <option value="SCZ">Santa Cruz</option>
                            <option value="TJA">Tarija</option>
                            <option value="OTRO">Otro</option>
                        </select>
                        <em class="error_text_arcedi error_expedido" style="display: none;" ></em>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Nombres:</label>
                    <input type="text" class="form-control" name="names" onchange="clearError(this);">
                    <em class="error_text_arcedi error_names" style="display: none;"></em>
                </div>
                <div class="form-group">
                    <label class="control-label">Apellido paterno:</label>
                    <input type="text" class="form-control" name="last_name_f" >
                    <em class="error_text_arcedi error_last_name_f" style="display: none;"></em>
                </div>
                <div class="form-group">
                    <label class="control-label">Apellido materno:</label>
                    <input type="text" class="form-control" name="last_name_m" >
                    <em class="error_text_arcedi error_last_name_m" style="display: none;"></em>
                </div>
                <div class="form-group">
                    <label class="control-label">Correo electronico:</label>
                    <input type="text" class="form-control" name="email" >
                    <em class="error_text_arcedi error_email" style="display: none;"></em>
                </div>
                <div class="form-group">
                    <label class="control-label">Profesion:</label>
                    <input type="text" class="form-control" name="career" >
                    <em class="error_text_arcedi error_career" style="display: none;"></em>
                </div>
                <div class="form-group">
                    <label class="control-label">Telefono:</label>
                    <input type="text" class="form-control" name="phone" >
                    <em class="error_text_arcedi error_phone" style="display: none;"></em>
                </div>
                <div class="form-group">
                    <label class="control-label">Celular:</label>
                    <input type="text" class="form-control" name="phone_cel" >
                    <em class="error_text_arcedi error_phone_cel" style="display: none;"></em>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
        {!! Form::close() !!}
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    function clearError(input){
        $(input).next().empty();
        $(input).next().css('display', 'none');
    }
</script>