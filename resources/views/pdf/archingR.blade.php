<?php
$FmyFunctions1 = new \App\Arcedi\Arcedi();
//$is_ok = ($FmyFunctions1->numtoletras($paymentA->total));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comprobante</title>
{!!Html::style('assets/bower/bootstrap/dist/css/bootstrap.css') !!}
{!!Html::style('assets/css/pdf.css') !!}
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-body">
			<div>
				<table class="reset_table table_arcedu">
					<tr>
						<td>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>{{ HTML::image('assets/images/arcedi.png', 'a picture', array( 'width' => 50, 'height' => 50 )) }}</td>
						<td style="text-align: right;">
							<p class="arcedi_p">{{ $arcedi['arcedi_nameCompany'] }}</p>
							<p class="arcedi_p">{{ $arcedi['arcedi_address'] }}</p>
							<p class="arcedi_p">{{ $arcedi['arcedi_contact'] }}</p>
						</td>
					</tr>
				</table>
				<hr class="arcedi_hr">
				<table class="reset_table table_arcedu">
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<p class="arcedi_p_title">Antregado a: <span class="arcedi_p"><?php echo $person->names." ".$person->last_name_f." ".$person->last_name_m ?></span></p>
							<p class="arcedi_p_title">CI: <span class="arcedi_p"><?php echo $person->ci." ".$person->expedido; ?></span></p>
							<p class="arcedi_p_title">del <span class="arcedi_p"><?php echo $arching->date_start." al ".$arching->date_end; ?></span></p>
						</td>
						<td style="text-align: right;">
							<p class="arcedi_p_title">Fecha Arqueo: <span class="arcedi_p"><?php echo $arching->date_end; ?></span></p>
							<p class="arcedi_p_title">Usuario: <span class="arcedi_p">{{ $user->name }}</span></p>
							<p class="arcedi_p">&nbsp;&nbsp;</p>
						</td>
					</tr>
				</table>
			</div>
			<div style="height: 20px;"></div>
			<table class="reset_table table_arcedu" style="width: 100%;">
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<th class="table_arcedi_border arcedi_p_title" style="text-align: center; width: 60%;">Descripcion</th>
					<th class="table_arcedi_border arcedi_p_title" style="text-align: center; width: 40%;">Total</th>
				</tr>
				<tr class="arcedi_p">
					<td><p><b>Alquileres Mensuales</b></p></td>
					<td class="table_arcedi_border td_total"><b>{{ $totalPaymentMonth['granTotal'] }}</b></td>
				</tr>
				<tr class="arcedi_p">
					<td class="table_arcedi_border p_report_arching">Multas</td>
					<td class="table_arcedi_border td_subtotal">{{ $totalPaymentMonth['totalPenality'] }}</td>
				</tr>
				<tr class="arcedi_p">
					<td class="table_arcedi_border p_report_arching">Despensas</td>
					<td class="table_arcedi_border td_subtotal">{{ $totalPaymentMonth['totalLarder'] }}</td>
				</tr>
				<tr class="arcedi_p">
					<td class="table_arcedi_border p_report_arching">Alquiler</td>
					<td class="table_arcedi_border td_subtotal">{{ $totalPaymentMonth['totalRenta'] }}</td>
				</tr>
				<tr class="arcedi_p">
					<td><p><b>Anticreticos</b></p></td>
					<td class="table_arcedi_border td_total"><b>{{ $totalPaymentAnti['granTotal'] }}</b></td>
				</tr>
				<tr class="arcedi_p">
					<td class="table_arcedi_border p_report_arching">Multas</td>
					<td class="table_arcedi_border td_subtotal">{{ $totalPaymentAnti['totalPenality'] }}</td>
				</tr>
				<tr class="arcedi_p">
					<td class="table_arcedi_border p_report_arching">Despensas</td>
					<td class="table_arcedi_border td_subtotal">{{ $totalPaymentAnti['totalLarder'] }}</td>
				</tr>
				<tr class="arcedi_p">
					<td><p><b>Contratos Hora</b></p></td>
					<td class="table_arcedi_border td_total"><b>{{ $totalContractTime['granTotal'] }}</b></td>
				</tr>
				<tr class="arcedi_p">
					<td><p><b>Contratos Anticreticos</b></p></td>
					<td class="table_arcedi_border td_total"><b>{{ $totalContractAnti['granTotal'] }}</b></td>
				</tr>
				<tr class="arcedi_p">
					<td><p><b>Contratos Alquiler</b></p></td>
					<td class="table_arcedi_border td_total"><b>{{ $totalContractMonth['granTotal'] }}</b></td>
				</tr>
				<tr class="arcedi_p">
					<td><p><b>Pagos Extra</b></p></td>
					<td class="table_arcedi_border td_total"><b>{{ $totalExtra['granTotal'] }}</b></td>
				</tr>
				<tr class="arcedi_p">
					<td><p><b>Gastos</b></p></td>
					<td class="table_arcedi_border td_total" style="color: red;"><b>-{{ $totalOutgo['granTotal'] }}</b></td>
				</tr>
				<tr class="arcedi_p">
					<td class="table_arcedi_border"><p><b style="text-transform: uppercase;">Gran Total</b></p></td>
					<td class="table_arcedi_border td_total"><b>{{ $granTOTAL }}</b></td>
				</tr>
			</table>
			<div style="height: 20px;"></div>
		</div>
		<div class="panel-footer">
			<p class="arcedi_p">{{ $arcedi['arcedi_footer_message'] }}</p>
			<p class="arcedi_p" style="text-align: center;">{{ $arcedi['arcedi_footer_submessage'] }}</p>
		</div>
	</div>
</body>
</html>