var extraPaymenttemplate = _.template(
    "<div class='modal-dialog' role='document'>" +
    "<div class='modal-content'>" +
    "<form class='form-inline'>"+
    "<div class='modal-header'>" +
    "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
    "<h4 class='modal-title'>Cobro Extra al contrato</h4>" +
    "</div>" +
    "<div class='modal-body'>" +
    "<div class='row'>"+
    "<div class='col-md-6'>"+
    "<p><b class='arcedu_title1'>Contrato: </b><%= contract_id%></p>"+
    "</div>"+
    "<div class='col-md-6'>"+
    "<p><b class='arcedu_title1'>Codigo Ambiente: </b><%=env_code%></p>"+
    "</div>"+
    "</div>"+
    "<div class='row'>"+
    "<label for='f_extraPayment_apellido' class='col-md-6 control-label'>&nbsp;Apellido:&nbsp;</label>"+
    "<label for='f_extraPayment_ci' class='col-md-6 control-label'>&nbsp;CI:&nbsp;</label>"+
    "</div>"+
    "<div class='row'>"+
    "<div class='col-md-6'>"+
    "<input type='text' class='col-md-6 form-control' style='width: 100%;' value='<%= names %>' id='f_extraPayment_apellido' readonly>"+
    "</div>"+
    "<div class='col-md-6'>"+
    "<input type='text' class='col-md-6 form-control' style='width: 100%;' value='<%= ci %>' id='f_extraPayment_ci' placeholder='ci' readonly>"+
    "</div>"+
    "</div>"+
    "<div class='row'>"+
    "<label for='concept' class='col-md-6 control-label'>&nbsp;Detalle:&nbsp;</label>"+
    "</div>"+
    "<div class='row'>"+
    "<div class='col-md-12'>"+
    "<textarea rows='2' cols='50' class='col-md-6 form-control' style='width: 100%; resize:none;' id='concept'>"+
    "</textarea>"+
        "<em class='error_text_arcedi error_concept'></em>"+
    "</div>"+
    "</div>"+
    "<div class='row'>"+
    "<label for='total' class='col-md-6 col-md-offset-6 control-label'>&nbsp;TOTAL:&nbsp;</label>"+
    "</div>"+
    "<div class='row'>"+
    "<div class='col-md-6 col-md-offset-6'>"+
    "<input type='text' class='form-control' style='width: 100%;' id='total' placeholder='Ej: 44,10'>"+
    "<em class='error_text_arcedi error_total'></em>"+
    "</div>"+
    "</div>"+
    "</div>" +
    "<div class='modal-footer'>" +
    "<button type='submit' class='btn btn-primary'>Grabar</button>" +
    "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" +
    "</div>" +
    "</form>"+
    "</div>" +
    "</div>"
);
