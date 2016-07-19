<script type="text/template" id="contractTime_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formContracTime" class="form-horizontal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title arcedu_title_modal">Contrato Area Social</h4>
		</div>
		<div class="modal-body">
			<h5 class="arcedu_title1">Persona: </h5>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="ci">ci:</label>
				<div class="col-sm-4">
					<div class="input-group">
						<input type="text" id="ci" class="form-control" placeholder="Carnet de identidad" value="<%= ci %>" onchange="clearPerson();" >
						<span class="input-group-btn">
							<a href"#" class="btn btn-default button-search">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</a>
						</span>
					</div><!-- /input-group -->
					<em class="error_text_arcedi error_ci"></em>
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="expedido">
						<option value="">Seleccione Departamento</option>
						<option value="BNI" <% if (expedido == "BNI"){ %>selected <% } %> >Beni</option>
						<option value="CHQ" <% if (expedido == "CHQ"){ %>selected <% } %> >Chuquisaca</option>
						<option value="CBA" <% if (expedido == "CBA"){ %>selected <% } %> >Cochabamba</option>
						<option value="LPZ" <% if (expedido == "LPZ"){ %>selected <% } %> >La Paz</option>
						<option value="ORU" <% if (expedido == "ORU"){ %>selected <% } %> >Oruro</option>
						<option value="PND" <% if (expedido == "PND"){ %>selected <% } %> >Pando</option>
						<option value="PSI" <% if (expedido == "PSI"){ %>selected <% } %> >Potosí</option>
						<option value="SCZ" <% if (expedido == "SCZ"){ %>selected <% } %> >Santa Cruz</option>
						<option value="TJA" <% if (expedido == "TJA"){ %>selected <% } %> >Tarija</option>
					</select>
					<em class="error_text_arcedi error_expedido"></em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="nombres">Nombres:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="names" placeholder="Nombres" value="<%= names %>" >
					<em class="error_text_arcedi error_names"></em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="last_name_f">Apellido P:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="last_name_f" placeholder="Apellido paterno" value="<%= last_name_f %>" >
					<em class="error_text_arcedi error_last_name_f"></em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="last_name_mNameM">Apellido M:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="last_name_m" placeholder="Apellido materno" value="<%= last_name_m %>" >
				</div>
			</div>
			<div class="form-group">
            	<label class="col-sm-4 control-label" for="phone">Telefono:</label>
				<div class="col-sm-8">
            		<input type="numeric" class="form-control" id="phone" placeholder="Telefono" >
					<em class="error_text_arcedi error_phone"></em>
				</div>
        	</div>
        	<div class="form-group">
            	<label class="col-sm-4 control-label" for="phone_cel">Tel. Celular:</label>
				<div class="col-sm-8">
            		<input type="numeric" class="form-control" id="phone_cel" placeholder="Tel. celular" >
				</div>
        	</div>
        	<div class="form-group">
            	<label class="col-sm-4 control-label" for="email">Correo electronico:</label>
				<div class="col-sm-8">
            		<input type="email" class="form-control" id="email" placeholder="E-mail" >
					<em class="error_text_arcedi error_email"></em>
				</div>
        	</div>
        	<h4 class="arcedu_title1">Ambiente: <%= environmentName %></h4>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="dateStart">F. Inicio:</label>
				<div class="col-sm-6">
					<div class='input-group date datetimepickerStart'>
	                    <input type='text' class="form-control" style="font-size:12px;" id="dateStart"  />
    	                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
        	            </span>
            	    </div>
					<em class="error_text_arcedi error_dateStart"></em>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-8">
				<table class="t_time">
					<tr>
						<td data-id="3">03</td>
						<td data-id="4">04</td>
						<td data-id="5">05</td>
						<td data-id="6">06</td>
						<td data-id="7">07</td>
						<td data-id="8">08</td>
						<td data-id="9">09</td>
						<td data-id="10">10</td>
					</tr>
					<tr>
						<td data-id="11">11</td>
						<td data-id="12">12</td>
						<td data-id="13">13</td>
						<td data-id="14">14</td>
						<td data-id="15">15</td>
						<td data-id="16">16</td>
						<td data-id="17">17</td>
						<td data-id="18">18</td>
					</tr>
					<tr>
						<td data-id="19">19</td>
						<td data-id="20">20</td>
						<td data-id="21">21</td>
						<td data-id="22">22</td>
						<td data-id="23">23</td>
						<td data-id="24">24</td>
						<td data-id="25">01</td>
						<td data-id="26">02</td>
					</tr>
				</table>
				</div>
			</div>
			<div style="height: 3px;"></div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="alq_hora">Alquiler Por Hora:</label>
				<div class="col-sm-2">
					<input type='number' min="1" max="99999999" step='0.01' id="alq_hora" class="form-control" placeholder='0.00' value="0" />
					<em class="error_text_arcedi error_alq_hora"></em>
				</div>
				<label class="col-sm-2 control-label" for="alq_hora_total">Horas:</label>
				<div class="col-sm-2">
					<input type='number' readonly min="1" max="99999999" step='0.01' id="alq_hora_total" class="form-control" placeholder='0.00' />
					<em class="error_text_arcedi error_alq_hora_total"></em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="warranty">Garantia:</label>
				<div class="col-sm-2">
            		<input type='number' min="0" max="99999999" step='0.01' id="warranty" class="form-control" placeholder='0.00' value="0" />
					<em class="error_text_arcedi error_warranty"></em>
				</div>
				<label class="col-sm-2 control-label" for="alq_hora_gran_total">Total:</label>
				<div class="col-sm-2">
					<input type='number' readonly min="1" max="99999999" step='0.01' id="alq_hora_gran_total" class="form-control" placeholder='0.00' />
					<em class="error_text_arcedi error_alq_hora_gran_total"></em>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Save changes</button>
		</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="expense_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formExpense">
		<div class="modal-header">
			<button type="button" class="Cerrar" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title arcedu_title_modal">Gasto del Edificio</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label for="concept">Concepto:</label>
				<input type='text' class="form-control" style="font-size:12px;" id="concept" value="<%= concept %>" />
				<em class="error_text_arcedi error_concept"></em>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="amount">Cantidad:</label>
					</div>
					<div class="col-sm-6">
						<label for="expense">Gasto:</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<input type='number' min="1" max="99999999" step='0.01' id="amount" class="form-control" placeholder='0.00' value="<%= amount %>" />
						<em class="error_text_arcedi error_amount"></em>
					</div>
					<div class="col-sm-6">
						<input type='number' min="1" max="99999999" step='0.01' id="expense" class="form-control" placeholder='0.00' value="<%= expense %>" />
						<em class="error_text_arcedi error_expense"></em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="amount">Nro. de factura:</label>
					</div>
					<div class="col-sm-6">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<input type='text' id="code_envoice" class="form-control" placeholder='0.00' value="<%= code_envoice %>" />
						<em class="error_text_arcedi error_code_envoice"></em>
					</div>
					<div class="col-sm-6">
					</div>
				</div>
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Grabar</button>
		</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="bath_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formBath">
		<div class="modal-header">
			<button type="button" class="Cerrar" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title arcedu_title_modal">Ingreso Dia Baño</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="date_entry">Fecha:</label>
					</div>
					<div class="col-sm-6">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<input type='text' id="date_entry" name="date_entry" class="form-control" disabled value="<%= date_entry %>" />
						<em class="error_text_arcedi error_date_entry"></em>
					</div>
					<div class="col-sm-6">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="amount">Ingreso:</label>
					</div>
					<div class="col-sm-6">
						<label for="ci">Ci persona:</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<input type='number' min="0" max="99999999" step='0.01' id="amount" class="form-control" placeholder='0.00' value="<%= amount %>" />
						<em class="error_text_arcedi error_amount"></em>
					</div>
					<div class="col-sm-6">
						<input type='number' min="1" max="99999999" step='0' id="ci" class="form-control" placeholder='0.00' value="<%= ci %>" />
						<em class="error_text_arcedi error_ci"></em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="detail">Observacion:</label>
				<input type='text' class="form-control" style="font-size:12px;" id="detail" value="<%= detail %>" />
				<em class="error_text_arcedi error_detail"></em>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Grabar</button>
		</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="bath_spending_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formBathSpending">
		<div class="modal-header">
			<button type="button" class="Cerrar" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title arcedu_title_modal">Gastos Baño</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label for="detail">Concepto:</label>
				<input type='text' class="form-control" style="font-size:12px;" id="detail" value="<%= detail %>" />
				<em class="error_text_arcedi error_detail"></em>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="code_envoice"># de Documento:</label>
					</div>
					<div class="col-sm-6">
					    <label for="date_spending">Fecha:</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<input type='text' id="code_envoice" name="code_envoice" class="form-control" value="<%= code_envoice %>" />
						<em class="error_text_arcedi error_code_envoice"></em>
					</div>
					<div class="col-sm-6">
					    <div class='input-group date datetimepicker'>
                            <input type='text' class="form-control" style="font-size:12px;" id="date_spending"  />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
						<em class="error_text_arcedi error_date_spending"></em>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
					</div>
					<div class="col-sm-6">
						<label for="ci">Pago:</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
					</div>
					<div class="col-sm-6">
					    <input type='number' min="0.01" max="99999999" step='0.01' id="outgo" class="form-control" placeholder='0.00' value="<%= outgo %>" />
						<em class="error_text_arcedi error_outgo"></em>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Grabar</button>
		</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="upload_file_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formContracTime" class="form-horizontal">
		<div class="modal-header">
			<button type="button" class="Cerrar" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title arcedu_title_modal">Subir imagenes</h4>
		</div>
		<div class="modal-body">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<span class="btn btn-success fileinput-button">
        		<i class="glyphicon glyphicon-plus"></i>
        		<span>Select files...</span>
        		<!-- The file input field used as target for the file upload widget -->
        		<input id="fileupload" type="file" name="files[]" multiple>
        		<input type="hidden" name="env_id" value="<%= env_id %>">
    		</span>
    		<br>
    		<br>
    		<!-- The global progress bar -->
    		<div id="progress" class="progress">
        		<div class="progress-bar progress-bar-success"></div>
    			</div>
    			<!-- The container for the uploaded files -->
    		<div id="files" class="files"></div>
    		<br>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="delete_env_image_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formDeleteEnvImage" class="form-horizontal">
			<div class="modal-header">
				<button type="button" class="Cerrar" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title arcedu_title_modal">Eliminar Imagen</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="alert alert-warning" role="alert">Confirme el borrado de la imagen</div>
				<input type="hidden" name="env_image_id" value="<%= env_image_id %>">
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Borrar</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="history_env_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formHistoryEnv" class="form-horizontal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title arcedu_title_modal">Historia de Pagos</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="alert alert-warning" role="alert">Seleccione el contrato del departamento <b><%= code%></b></div>
					<div class="dropdown" style="width: 100%;">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Seleccione contrato...
						<span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					  	<%_.each(contracts, function (contract) {%>
							<li><a href="env/redirectContract/<%=contract.contract_id%>" ><%= contract.contract_id+" - "+contract.status %></a></li>
						<%})%>
					  </ul>
					</div>
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="delete_env_template">
<div class="modal-dialog">
	<div class="modal-content">
		<form id="formDeleteEnv" class="form-horizontal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title arcedu_title_modal"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar Ambiente</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="alert alert-danger" role="alert">Confirme el borrado el Ambiente con identificador: <%= env_id %></div>
				<input type="hidden" name="env_id" value="<%= env_id %>">
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Borrar</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>