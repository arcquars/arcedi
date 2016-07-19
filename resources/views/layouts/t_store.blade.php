<script type="text/template" id="new_product_template">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formNewProduct" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title arcedu_title_modal">Nuevo Producto</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-sm-4 control-label" for="name">Nombre:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" placeholder="Nombre" >
							<em class="error_text_arcedi error_name"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="code">Codigo:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="code" placeholder="Codigo" >
							<em class="error_text_arcedi error_code"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="price_reference">Precio ref:</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" id="price_reference" step="0.01">
							<em class="error_text_arcedi error_price_reference"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="category">Categoria:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="category" placeholder="Categoria" >
							<em class="error_text_arcedi error_category"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="category">Fabrica:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="factory" placeholder="Fabrica" >
							<em class="error_text_arcedi error_factory"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="description">Descripcion:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="description" placeholder="Descripcion" >
							<em class="error_text_arcedi error_description"></em>
						</div>
					</div>
				<br>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Crear</button>
			</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</script>

<script type="text/template" id="edit_product_template">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formEditProduct" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title arcedu_title_modal">Editar Producto</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="product_id" id="product_id" value="<%= product_id %>">
					<div class="form-group">
						<label class="col-sm-4 control-label" for="name">Nombre:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" value="<%= name %>" placeholder="Nombre" >
							<em class="error_text_arcedi error_name"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="code">Codigo:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="code" value="<%= code %>" placeholder="Codigo" >
							<em class="error_text_arcedi error_code"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="price_reference">Precio ref:</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" value="<%= price_reference %>" id="price_reference" step="0.01">
							<em class="error_text_arcedi error_price_reference"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="category">Categoria:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="category" value="<%= category %>" placeholder="Categoria" >
							<em class="error_text_arcedi error_category"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="category">Fabrica:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="factory" value="<%= factory %>" placeholder="Fabrica" >
							<em class="error_text_arcedi error_factory"></em>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="description">Descripcion:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="description" value="<%= description %>" placeholder="Descripcion" >
							<em class="error_text_arcedi error_description"></em>
						</div>
					</div>
					<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Grabar</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</script>