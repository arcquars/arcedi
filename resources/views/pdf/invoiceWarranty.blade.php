<?php
$FmyFunctions1 = new \App\Arcedi\Arcedi();
$is_ok = ($FmyFunctions1->numtoletras($rentalMonth->warranty));
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
            <p class="arcedi_p_title">Nombres: <span class="arcedi_p"><?php echo $person->names." ".$person->last_name_f." ".$person->last_name_m ?></span></p>
            <p class="arcedi_p_title">CI: <span class="arcedi_p"><?php echo $person->ci." ".$person->expedido; ?></span></p>
            <p class="arcedi_p_title">Contrato: <span class="arcedi_p">{{ $rentalMonth->contract_id }}</span></p>
            <p></p>
          </td>
          <td style="text-align: right;">
            <p class="arcedi_p_title">Fecha Pago: <span class="arcedi_p" style="font-size: 10px;">{{ $rentalMonth->date_payment_warranty }}</span></p>
            <p class="arcedi_p_title">Usuario: <span class="arcedi_p">{{ $name }}</span></p>
            <p class="arcedi_p_title">Ambiente: <span class="arcedi_p"><?php echo $rentalMonth->code." (".$rentalMonth->type.")"; ?></span></p>
          </td>
        </tr>
      </table>
    </div>
    <div style="height: 20px;"></div>
    <table class="reset_table table_arcedu" style="width: 100%;">
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th class="table_arcedi_border arcedi_p_title" style="text-align: center; width: 10%;">Cant.</th>
        <th class="table_arcedi_border arcedi_p_title" style="text-align: center; width: 75%;">Detalle</th>
        <th class="table_arcedi_border arcedi_p_title" style="text-align: right; width: 15%;">SubTotal</th>
      </tr>
      <tr class="arcedi_p">
        <td style="text-align: center;">1</td>
        <td><p class="arcedi_p">Pago de Garantia del contrato de alquiler por mes</p></td>
        <td style="text-align: right;">
        {{ $rentalMonth->warranty }}
        </td>
      </tr>

      <tr class="arcedi_p">
        <td class="table_arcedi_border"><div style="height: 18px;"></div></td>
        <td class="table_arcedi_border"></td>
        <td class="table_arcedi_border"></td>
      </tr>
    </table>
    <table style="width: 100%;">
      <tr>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td style="width: 75%;"><p class="arcedi_p_title">Son: <span><?php echo $is_ok; ?></span></p></td>
        <td style="text-align: right; width: 25%;"><p class="arcedi_p_title">Total: <span><?php echo $rentalMonth->warranty; ?></span> Bs.</p></td>
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