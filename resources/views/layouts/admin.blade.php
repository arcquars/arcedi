<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>{{\Config::get('arcedu.arcedi_nameCompany')}}</title>
	<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />
<!-- Bootstrap -->
<link href="/assets/bower/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">
	<link href="/assets/css/font-awesome/css/font-awesome.min.css"
		  rel="stylesheet">
<link href="/assets/css/main.css" rel="stylesheet">
<link href="/assets/css/arcedi.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<header id="header" role="banner" >
		<div class="container">
			<nav id="navbar" class="navbar navbar-default">
				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="bs-example-navbar-collapse-12">
							<span class="sr-only">Toggle navigation</span> <span
								class="icon-bar"></span> <span class="icon-bar"></span> <span
								class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ url('/') }}"></a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-12">
						<ul id="ul_menu_nav" class="nav navbar-nav">
							<li class="active"><a href="<?php echo url('admin'); ?>"><i
									class="glyphicon glyphicon-tower"></i></a></li>
							<li><a href="<?php echo url('expenses'); ?>"><i class="glyphicon glyphicon-briefcase"></i> Pagos</a></li>
							<li><a href="{{ url('/store') }}"><i class="fa fa-truck"></i> Almacen</a></li>
							<li><a href="{{ url('/storedetail') }}"><i class="fa fa-shopping-cart"></i> Tienda</a></li>
							<li><a href="{{ url('/bath') }}"><i class="fa fa-gg"></i> Baños</a></li>
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-archive" aria-hidden="true"></i> Reportes<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{ url('/reports') }}"><i class="glyphicon glyphicon-book"></i> Reportes Ambientes</a></li></li>
								</ul>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-usd" aria-hidden="true"></i> Arqueos<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{ url('/arching') }}"><i class="fa fa-university" aria-hidden="true"></i> Arqueo Ambientes</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{ url('/env') }}">Ambientes</a></li>
									<li><a href="#">Usuarios</a></li>
									<li><a href="#">Cuenta</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--/#header-->
	<section id="services" style="padding: 85px 0;">
		<div class="container">@yield("content")</div>
	</section>
	<div id="ficha"></div>
	
	@include('layouts.templates')
	
	<script id="modal-template" type="text/template">
        <div class="modal">
            <div class="modal-header"><h3><%= title %></h3></div>
            <div class="modal-body"><%= body %></div>
            <div class="modal-footer"><a class="btn close">Close</a></div>
        </div>
        <div class="modal-backdrop"></div>
    </script>

	<script type="text/template" id="contractMes_template">
    <form id="formContractMont" class="form-horizontal">
		<h4 class="arcedu_title1">Persona: </h4>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="ci">ci:</label>
            <div class="col-sm-4">
			<div class="input-group">
      			<input type="text" id="ci" class="form-control" placeholder="Carnet de identidad" >
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
				<option value="BNI">Beni</option>
  				<option value="CHQ">Chuquisaca</option>
  				<option value="CBA">Cochabamba</option>
  				<option value="LPZ">La Paz</option>
				<option value="ORU">Oruro</option>
				<option value="PND">Pando</option>
				<option value="PSI">Potosí</option>
				<option value="SCZ">Santa Cruz</option>
				<option value="TJA">Tarija</option>
				</select>
				<em class="error_text_arcedi error_expedido"></em>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="nombres">Nombres:</label>
			<div class="col-sm-8">
            <input type="text" class="form-control" id="names" placeholder="Nombres" >
			<em class="error_text_arcedi error_names"></em>
			</div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="last_name_f">Apellido P:</label>
			<div class="col-sm-8">
            <input type="text" class="form-control" id="last_name_f" placeholder="Apellido paterno" >
			<em class="error_text_arcedi error_last_name_f"></em>
			</div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="last_name_mNameM">Apellido M:</label>
			<div class="col-sm-8">
            <input type="text" class="form-control" id="last_name_m" placeholder="Apellido materno" >
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
        	<label class="col-sm-4 control-label" for="dateContract">F. Contrato:</label>
			<div class="col-sm-3">
				<div class='input-group date datetimepickerContract'>
                    <input type='text' class="form-control" style="font-size:12px;" id="dateContract"  />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
				<em class="error_text_arcedi error_dateContract"></em>
			</div>
        </div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="dateStart">F. Inicio:</label>
			<div class="col-sm-3">
				<div class='input-group date datetimepickerStart'>
                    <input type='text' class="form-control" style="font-size:12px;" id="dateStart"  />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
				<em class="error_text_arcedi error_dateStart"></em>
			</div>
			<label class="col-sm-2 control-label" for="dateEnd">F. Fin:</label>
			<div class="col-sm-3">
				<div class='input-group date datetimepickerEnd'>
                    <input type='text' style="font-size:12px;" class="form-control" id="dateEnd" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
				<em class="error_text_arcedi error_dateEnd"></em>		
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-4 control-label" for="warranty">Garantia:</label>
			<div class="col-sm-3">
            <input type='number' min="0" max="99999999" step='0.01' id="warranty" class="form-control" placeholder='0.00' />
			<em class="error_text_arcedi error_warranty"></em>
			</div>
			<label class="col-sm-2 control-label" for="penalty_fee">Multa Dia:</label>
			<div class="col-sm-3">
            <input type='number' min="0" max="99999999" step='0.01' id="penalty_fee" class="form-control" placeholder='0.00' />
			<em class="error_text_arcedi error_penalty_fee"></em>
			</div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="monthPayment">Pago mes:</label>
			<div class="col-sm-3">
                <input type='number' min="1" max="99999999" step='0.01' id="monthPayment" class="form-control" placeholder='0.00' />
				<em class="error_text_arcedi error_monthPayment"></em>
            </div>

            <label class="col-sm-2 control-label" for="despensas">Despensas:</label>
			<div class="col-sm-3">
                <input type='number' min="0" max="99999999" step='0.01' id="despensas" class="form-control" placeholder='0.00' readonly />
				<em class="error_text_arcedi error_despensas"></em>
            </div>
        </div>
        <h4 class="arcedu_title1">Despensas</h4>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="num_person_may">Personas mayores:</label>
			<div class="col-sm-3">
                <input type='number' min="0" max="10" step='0' id="num_person_may" class="form-control" placeholder='0' onchange='updateLarder();' />
				<em class="error_text_arcedi error_num_person_may"></em>
            </div>

            <label class="col-sm-2 control-label" for="despensas_may">Des. Per. May:</label>
			<div class="col-sm-3">
                <input type='number' min="0" max="999" step='0.01' id="despensas_may" class="form-control" placeholder='0.00' onchange='updateLarder();' />
				<em class="error_text_arcedi error_despensas_may"></em>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="num_person_men">Personas menores:</label>
			<div class="col-sm-3">
                <input type='number' min="0" max="10" step='0' id="num_person_men" class="form-control" placeholder='0' onchange='updateLarder();'/>
				<em class="error_text_arcedi error_num_person_men"></em>
            </div>

            <label class="col-sm-2 control-label" for="despensas_men">Des. Per. Men:</label>
			<div class="col-sm-3">
                <input type='number' min="0" max="999" step='0.01' id="despensas_men" class="form-control" placeholder='0.00' onchange='updateLarder();'/>
				<em class="error_text_arcedi error_despensas_men"></em>
            </div>
        </div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Grabar</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
      	</div>
    </form>
    </script>

	<script type="text/template" id="paymentMonth_template">
		<div class="modal-dialog" id="modal_paymentMonth">
    		<div class="modal-content">
				<form id="formPaymentMonth" class="form-horizontal">
				<input type='hidden' id="dateEndContract" value=<%= dateEnd %> />
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title arcedu_title_modal">Pago Alquiler Mes</h4>
      			</div>
      			<div class="modal-body" id="modalPaymentBody">
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
									<option value="BNI" <% if (expedido == 'BNI'){ %>selected <% } %> >Beni</option>
  									<option value="CHQ" <% if (expedido == 'CHQ'){ %>selected <% } %> >Chuquisaca</option>
  									<option value="CBA" <% if (expedido == 'CBA'){ %>selected <% } %> >Cochabamba</option>
  									<option value="LPZ" <% if (expedido == 'LPZ'){ %>selected <% } %> >La Paz</option>
									<option value="ORU" <% if (expedido == 'ORU'){ %>selected <% } %> >Oruro</option>
									<option value="PND" <% if (expedido == 'PND'){ %>selected <% } %> >Pando</option>
									<option value="PSI" <% if (expedido == 'PSI'){ %>selected <% } %> >Potosí</option>
									<option value="SCZ" <% if (expedido == 'SCZ'){ %>selected <% } %> >Santa Cruz</option>
									<option value="TJA" <% if (expedido == 'TJA'){ %>selected <% } %> >Tarija</option>
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
						<h5 class="arcedu_title1">Meses de alquiler a Pagar:</h5>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="dateStart">del:</label>
							<div class="col-sm-3">
								<input type='text' class="form-control" style="font-size:12px;" id="dateStart" value="<%= dateStart %>" readonly />
								<em class="error_text_arcedi error_dateStart"></em>
							</div>
							<label class="col-sm-2 control-label" for="dateEnd" style="text-align:center;">al</label>
							<div class="col-sm-3">
								<div class='input-group date datetimepickerEndM' id="">
                    				<input type='text' style="font-size:10px;" class="form-control dateEnd_cl" id="dateEnd_cl" value="<%= dateStart1 %>" />
                    				<span class="input-group-addon">
                        				<span class="glyphicon glyphicon-calendar"></span>
                    				</span>
                				</div>
								<em class="error_text_arcedi error_dateEnd"></em>		
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12" style="padding-right: 30px;">
								<table style="width: 100%; text-align: right;">
									<tr>
										<td style="width: 70%;">
											<p class="control-label" >Alq. x mes: <span id="mpm_payment_month" data-paymentmonth="<%= payment %>"><%= payment %></span> x <span class="numberMonth" id="numberMonth_id" data-number="1" >1</span> meses</p>
										</td>
										<td style="width: 10%">
											
										</td>
										<td style="text-align: right; width: 20%">
											<p class="control-label" style="padding-left: 5px;"><span class="mpm_total_month" id="mpm_total_month"><%= payment %></span> Bs.</p>
										</td>
									</tr>
									<tr>
										<td>
											<p class="control-label">Des. x mes: <span id="mpm_larder_month" data-larder="<%= larder %>"><%= larder %></span> x <span class="numberMonth" data-number="1" >1</span> meses</p>
										</td>
										<td>
										</td>
										<td style="text-align: right;">
											<p class="control-label" style="padding-left: 5px;"><span id="mpm_total_larder"><%= larder %></span> Bs.</p>
										</td>
									</tr>
									<tr>
										<td>
											<p class="control-label">Multa por dia: <%= penalty_fee %> x <%= fee %> dias</p>
										</td>
										<td>
										</td>
										<td style="text-align: right;">
											<p class="control-label" style="padding-left: 5px;"><span id="mpm_total_multa"><%= (fee*penalty_fee) %></span> Bs.</p>
										</td>
									</tr>
									<tr>
										<td>
											<p class="control-label">Total:</p>
										</td>
										<td>
										</td>
										<td style="text-align: right;">
											<p class="control-label" style="padding-left: 5px;"><span id="mpm_gran_total">0</span> Bs.</p>
										</td>
									</tr>
								</table>
							</div>
						</div>
      			</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Grabar</button>
            		<button type="button" class="btn btn-default btn-close">Cancelar</button>
      			</div>
				</form>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</script>
	
	<script type="text/template" id="paymentAnti_template">
		<div class="modal-dialog" id="modal_paymentMonth">
    		<div class="modal-content">
				<form id="formPaymentMonth" class="form-horizontal">
				<input type='hidden' id="dateEndContract" value=<%= dateEnd %> />
      			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title arcedu_title_modal">Pago Despensas Mes</h4>
      			</div>
      			<div class="modal-body" id="modalPaymentBody">
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
									<option value="BNI" <% if (expedido == 'BNI'){ %>selected <% } %> >Beni</option>
  									<option value="CHQ" <% if (expedido == 'CHQ'){ %>selected <% } %> >Chuquisaca</option>
  									<option value="CBA" <% if (expedido == 'CBA'){ %>selected <% } %> >Cochabamba</option>
  									<option value="LPZ" <% if (expedido == 'LPZ'){ %>selected <% } %> >La Paz</option>
									<option value="ORU" <% if (expedido == 'ORU'){ %>selected <% } %> >Oruro</option>
									<option value="PND" <% if (expedido == 'PND'){ %>selected <% } %> >Pando</option>
									<option value="PSI" <% if (expedido == 'PSI'){ %>selected <% } %> >Potosí</option>
									<option value="SCZ" <% if (expedido == 'SCZ'){ %>selected <% } %> >Santa Cruz</option>
									<option value="TJA" <% if (expedido == 'TJA'){ %>selected <% } %> >Tarija</option>
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
						<h5 class="arcedu_title1">Meses de alquiler a Pagar:</h5>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="dateStart">del:</label>
							<div class="col-sm-3">
								<input type='text' class="form-control" style="font-size:12px;" id="dateStart" value="<%= dateStart %>" readonly />
								<em class="error_text_arcedi error_dateStart"></em>
							</div>
							<label class="col-sm-2 control-label" for="dateEnd" style="text-align:center;">al</label>
							<div class="col-sm-3">
								<div class='input-group date datetimepickerEndM' id="">
                    				<input type='text' style="font-size:10px;" class="form-control dateEnd_cl" id="dateEnd_cl" value="<%= dateStart1 %>" />
                    				<span class="input-group-addon">
                        				<span class="glyphicon glyphicon-calendar"></span>
                    				</span>
                				</div>
								<em class="error_text_arcedi error_dateEnd"></em>		
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12" style="padding-right: 30px;">
								<table style="width: 100%; text-align: right;">
									<tr>
										<td>
											<p class="control-label">Des. x mes: <span id="mpm_larder_month" data-larder="<%= larder %>"><%= larder %></span> x <span class="numberMonth" data-number="1" >1</span> meses</p>
										</td>
										<td>
										</td>
										<td style="text-align: right;">
											<p class="control-label" style="padding-left: 5px;"><span id="mpm_total_larder"><%= larder %></span> Bs.</p>
										</td>
									</tr>
									<tr>
										<td>
											<p class="control-label">Multa por dia: <%= penalty_fee %> x <%= fee %> dias</p>
										</td>
										<td>
										</td>
										<td style="text-align: right;">
											<p class="control-label" style="padding-left: 5px;"><span id="mpm_total_multa"><%= (fee*penalty_fee) %></span> Bs.</p>
										</td>
									</tr>
									<tr>
										<td>
											<p class="control-label">Total:</p>
										</td>
										<td>
										</td>
										<td style="text-align: right;">
											<p class="control-label" style="padding-left: 5px;"><span id="mpm_gran_total">0</span> Bs.</p>
										</td>
									</tr>
								</table>
							</div>
						</div>
      			</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Grabar</button>
            		<button type="button" class="btn btn-default btn-close">Cancelar</button>
      			</div>
				</form>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</script>

	<script type="text/template" id="contractAnti_template">
		<div class="modal-dialog" id="modal_contractAnti">
    		<div class="modal-content">
				<form id="formContractAnti" class="form-horizontal">
      			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title arcedu_title_modal">Contrato Anticretico</h4>
      			</div>
      			<div class="modal-body" id="modalContractAntiBody">
						<h4 class="arcedu_title1">Persona: </h4>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="ci">ci:</label>
            <div class="col-sm-4">
			<div class="input-group">
      			<input type="text" id="ci" class="form-control" placeholder="Carnet de identidad" >
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
				<option value="BNI">Beni</option>
  				<option value="CHQ">Chuquisaca</option>
  				<option value="CBA">Cochabamba</option>
  				<option value="LPZ">La Paz</option>
				<option value="ORU">Oruro</option>
				<option value="PND">Pando</option>
				<option value="PSI">Potosí</option>
				<option value="SCZ">Santa Cruz</option>
				<option value="TJA">Tarija</option>
				</select>
				<em class="error_text_arcedi error_expedido"></em>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="nombres">Nombres:</label>
			<div class="col-sm-8">
            <input type="text" class="form-control" id="names" placeholder="Nombres" >
			<em class="error_text_arcedi error_names"></em>
			</div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="last_name_f">Apellido P:</label>
			<div class="col-sm-8">
            <input type="text" class="form-control" id="last_name_f" placeholder="Apellido paterno" >
			<em class="error_text_arcedi error_last_name_f"></em>
			</div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="last_name_mNameM">Apellido M:</label>
			<div class="col-sm-8">
            <input type="text" class="form-control" id="last_name_m" placeholder="Apellido materno" >
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
							<label class="col-sm-4 control-label" for="dateContract">F. Contrato:</label>
							<div class="col-sm-3">
								<div class='input-group date datetimepickerContract'>
									<input type='text' class="form-control" style="font-size:12px;" id="dateContract"  />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
								<em class="error_text_arcedi error_dateContract"></em>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="dateStart">F. Inicio:</label>
							<div class="col-sm-3">
								<div class='input-group date datetimepickerStart'>
                    				<input type='text' class="form-control" style="font-size:12px;" id="dateStart"  />
                    				<span class="input-group-addon">
                        			<span class="glyphicon glyphicon-calendar"></span>
                    				</span>
                				</div>
								<em class="error_text_arcedi error_dateStart"></em>
							</div>
							<label class="col-sm-2 control-label" for="dateEnd">F. Fin:</label>
							<div class="col-sm-3">
								<div class='input-group date datetimepickerEnd'>
                    				<input type='text' style="font-size:12px;" class="form-control" id="dateEnd" />
                    				<span class="input-group-addon">
                        				<span class="glyphicon glyphicon-calendar"></span>
                    				</span>
                				</div>
								<em class="error_text_arcedi error_dateEnd"></em>		
							</div>
						</div>
						<div class="form-group">
            				<label class="col-sm-4 control-label" for="anticretico">Anticretico Bs:</label>
							<div class="col-sm-3">
            					<input type='number' min="1" max="99999999" step='0.01' id="anticretico" class="form-control" placeholder='0.00' />
								<em class="error_text_arcedi error_anticretico"></em>
							</div>
							<label class="col-sm-2 control-label" for="penalty_fee">Multa Dia Bs:</label>
							<div class="col-sm-3">
            					<input type='number' min="0" max="99999999" step='0.01' id="penalty_fee" class="form-control" placeholder='0.00' />
								<em class="error_text_arcedi error_penalty_fee"></em>
							</div>
        				</div>
        				<div class="form-group">
							<div class="col-sm-7"></div>
            				<label class="col-sm-2 control-label" for="despensas">Despensas Bs:</label>
							<div class="col-sm-3">
                				<input type='number' min="0" max="99999999" step='0.01' id="despensas" class="form-control" placeholder='0.00' readonly />
								<em class="error_text_arcedi error_despensas"></em>
            				</div>
        				</div>
        				<h4 class="arcedu_title1">Despensas</h4>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="num_person_may">Personas mayores:</label>
							<div class="col-sm-3">
								<input type='number' min="0" max="10" step='0' id="num_person_may" class="form-control" placeholder='0' onchange='updateLarder();' />
								<em class="error_text_arcedi error_num_person_may"></em>
							</div>

							<label class="col-sm-2 control-label" for="despensas_may">Des. Per. May:</label>
							<div class="col-sm-3">
								<input type='number' min="0" max="999" step='0.01' id="despensas_may" class="form-control" placeholder='0.00' onchange='updateLarder();' />
								<em class="error_text_arcedi error_despensas_may"></em>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="num_person_men">Personas menores:</label>
							<div class="col-sm-3">
								<input type='number' min="0" max="10" step='0' id="num_person_men" class="form-control" placeholder='0' onchange='updateLarder();'/>
								<em class="error_text_arcedi error_num_person_men"></em>
							</div>

							<label class="col-sm-2 control-label" for="despensas_men">Des. Per. Men:</label>
							<div class="col-sm-3">
								<input type='number' min="0" max="999" step='0.01' id="despensas_men" class="form-control" placeholder='0.00' onchange='updateLarder();'/>
								<em class="error_text_arcedi error_despensas_men"></em>
							</div>
						</div>
      				</div>
				<div class="modal-footer">
            		<button type="button" class="btn btn-default btn-close">Cancelar</button>
            		<button type="submit" class="btn btn-primary">Grabar</button>
      			</div>
				</form>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</script>
	<script type="text/template" id="paymentWMonth_template">
		<div class="modal-dialog" id="modal_paymentWMonth">
    		<div class="modal-content">
				<form id="formPaymentMonth" class="form-horizontal">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title arcedu_title_modal">Pago Garantia Contrato Mes</h4>
      			</div>
      			<div class="modal-body" id="modalPaymentBody">
						<h5 class="arcedu_title1">Persona: </h5>
        				<div class="form-group">
            				<label class="col-sm-4 control-label" for="ci">ci:</label>
            				<div class="col-sm-8">
      								<input type="text" id="ci" class="form-control" placeholder="Carnet de identidad" value="<%= ci %>" onchange="clearPerson();" readonly>
            				</div>
        				</div>
        				<div class="form-group">
            				<label class="col-sm-4 control-label" for="nombres">Nombres:</label>
							<div class="col-sm-8">
            					<input type="text" class="form-control" id="names" placeholder="Nombres" value="<%= names %>" readonly >
							</div>
        				</div>
        				<div class="form-group">
            				<label class="col-sm-4 control-label" for="last_name_f">Apellidos: </label>
							<div class="col-sm-8">
            					<input type="text" class="form-control" id="last_name_f" placeholder="Apellido paterno" value="<%= last_name_f+' '+last_name_m %>" readonly >
							</div>
        				</div>
						<h5 class="arcedu_title1">Ambiente: <%= code %></h5>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="warranty">Garantia: </label>
							<div class="col-sm-8">
            					<input type="text" class="form-control" id="warranty" value="<%= warranty %>" readonly >
							</div>
						</div>
      			</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Grabar</button>
            		<button type="button" class="btn btn-default btn-close">Cancelar</button>
      			</div>
				</form>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</script>
	<script type="text/template" id="paymentWAnti_template">
		<div class="modal-dialog" id="modal_paymentWAnti">
    		<div class="modal-content">
				<form id="formPaymentMonth" class="form-horizontal">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title arcedu_title_modal">Pago Contrato Anticretico</h4>
      			</div>
      			<div class="modal-body" id="modalPaymentBody">
						<h5 class="arcedu_title1">Persona: </h5>
        				<div class="form-group">
            				<label class="col-sm-4 control-label" for="ci">ci:</label>
            				<div class="col-sm-8">
      								<input type="text" id="ci" class="form-control" placeholder="Carnet de identidad" value="<%= ci %>" onchange="clearPerson();" readonly>
            				</div>
        				</div>
        				<div class="form-group">
            				<label class="col-sm-4 control-label" for="nombres">Nombres:</label>
							<div class="col-sm-8">
            					<input type="text" class="form-control" id="names" placeholder="Nombres" value="<%= names %>" readonly >
							</div>
        				</div>
        				<div class="form-group">
            				<label class="col-sm-4 control-label" for="last_name_f">Apellidos: </label>
							<div class="col-sm-8">
            					<input type="text" class="form-control" id="last_name_f" placeholder="Apellido paterno" value="<%= last_name_f+' '+last_name_m %>" readonly >
							</div>
        				</div>
						<h5 class="arcedu_title1">Ambiente: <%= code %></h5>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="warranty">Anticretico: </label>
							<div class="col-sm-8">
            					<input type="text" class="form-control" id="warranty" value="<%= anticretico %>" readonly >
							</div>
						</div>
      			</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Grabar</button>
            		<button type="button" class="btn btn-default btn-close">Cancelar</button>
      			</div>
				</form>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</script>
	<script type="text/template" id="envImages_template">
		<div class="modal-dialog modal-sm" id="modal_envImages">
    		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Imagenes de Ambiente</h4>
				</div>
				<div class="modal-body" style="text-align: center;">
					<% if (items.length != 0) { %>
					<section class="slider">
						<div id="slider" class="flexslider">
							<ul class="slides">
								<% _.each(items,function(item,key,arr) { %>
									<li data-thumb="assets/images/<%=item.url_image %>">
										<img src="assets/images/<%=item.url_image %>" />
								   	</li>
							   	<% }); %>
							</ul>
						</div>
					</section>
					<% } else {%>
						Sin Imagenes
					<% } %>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="/assets/bower/jquery/dist/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/assets/bower/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript"
		src="/assets/bower/underscore/underscore-min.js"></script>
	<script type="text/javascript"
		src="/assets/bower/backbone/backbone-min.js"></script>
	<script type="text/javascript"
		src="/assets/bower/backbone-validation/dist/backbone-validation-min.js"></script>

	<script type="text/javascript"
		src="/assets/bower/moment/min/moment-with-locales.min.js"></script>

	<script type="text/javascript"
		src="/assets/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript"
		src="/assets/bower/jquery-validation/dist/jquery.validate.js"></script>
	<script type="text/javascript"
		src="/assets/bower/jquery-validation/src/localization/messages_es.js"></script>
	<link rel="stylesheet"
		href="/assets/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

	<script type="text/javascript" src="/assets/js/arcedu.js"></script>
	@yield("script")
</body>
</html>