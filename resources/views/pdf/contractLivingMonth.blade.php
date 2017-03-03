<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Comprobante</title>
    {!! Html::style('assets/css/pdf.css') !!}
  </head>
  <body>
  <?php
  $date=date_create($environment->date_contract);
  ?>
    <h5 style="text-align: center;">CONTRATO DE ALQUILER DE DEPARTAMENTO</h5>
  <p style="text-align: right;" class="p_contrat">En la ciudad de Cochabamba, <?= date_format($date, "d");?> de <?= date_format($date, "m");?> de <?= date_format($date, "Y");?></p>
    <h6>REUNIDOS</h6>
    <p class="p_contrat">De una parte, en concepto de PROPIETARIO, <b><?= $arcedi['arcedi_contract_owner_name'] ?></b> mayor de edad;
      de estado civil <b>{{ $arcedi['arcedi_contract_owner_civil'] }}</b> de profesión <b>{{ $arcedi['arcedi_contract_owner_profesion'] }}</b> con domicilio en <b>{{ $arcedi['arcedi_contract_owner_address'] }}</b> y C.I. <b>{{ $arcedi['arcedi_contract_owner_ci'] }}</b>
      De otra, en concepto de INQUILINO, Sr. <b>{{ $person->names." ".$person->last_name_f." ".$person->last_name_m }}</b> mayor de edad; con C.I. <b>{{ $person->ci." ".$person->expedido }}</b></p>
    <h6>MANIFIESTAN</h6>
    <p class="p_contrat">
      Ambas partes, se encuentran plenamente conscientes de las circunstancias, deberes y obligaciones del presente CONTRATO DE ALQUILER y para lo mismo se ajustan en conformidad de acuerdo con los siguientes.
    </p>
    <h6>ANTECEDENTES</h6>
    <ol class="ol_contract" type="I">
      <li>Que la <b>{{ $arcedi['arcedi_contract_owner_name'] }}</b> es PROPIETARIO, de un departamento vivienda , situado en <b>{{ $piso }}</b> del edificio <b>{{ $arcedi['arcedi_nameCompany'] }}</b> con codigo <b>{{ $environment->code }}</b>. de <b>{{ $arcedi['arcedi_address'] }}</b> de la ciudad de Cochabamba con una superficie de <b>{{ $environment->area }}</b> metros cuadrados y consta de los siguientes ambientes
        <?php

        if($environment->detail_env == "a"){
          print_r($arcedi['arcedi_contract_detail_env']['a']);
          echo "<p>".$arcedi['arcedi_contract_detail_env']['a']['dormitorios']." Habitaciones</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['a']['living_comedor']." Living comedor</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['a']['banios']." Banios</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['a']['cocina']." Cocina</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['a']['lavanderia']." Lavanderia (uso comun)</p>";
        }
        if($environment->detail_env == "b"){
          echo "<p>".$arcedi['arcedi_contract_detail_env']['b']['dormitorios']."  Habitaciones</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['b']['living_comedor']." Living comedor</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['b']['banios']." Banios</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['b']['cocina']." Cocina</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['b']['lavanderia']." Lavanderia (uso comun)</p>";
        }
        if($environment->detail_env == "c"){
          echo "<p>".$arcedi['arcedi_contract_detail_env']['c']['dormitorios']."  Habitaciones</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['c']['living_comedor']." Living comedor</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['c']['banios']." Banios</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['c']['cocina']." Cocina</p>";
          echo "<p>".$arcedi['arcedi_contract_detail_env']['c']['lavanderia']." Lavanderia (uso comun)</p>";
        }
        ?>
      </li>
      <li>Ambas partes  han concertado  que el presente contrato de alquiler de dicho local se regulará de acuerdo con las siguientes clausulas.</li>
    </ol>
    <h6>CLAUSULAS</h6>
    <h6>OBJETO, CONTENIDO Y DESTINO</h6>
    <p class="p_contrat"><b>PRIMERA.-</b> El PROPIETARIO deja constancia que el inmueble a que se refiere  el contrato, se encuentra desocupado, en buen estado de conservación y habitabilidad y sin mayor desgaste que el producido por el uso normal y ordinario y con todas sus instalaciones funcionales  en óptimo estado de uso y rendimiento, que ha sido vista, examinada y encontrada a su entera satisfacción por el INQUILINO, quien la usará como vivienda.</p>
    <p class="p_contrat">Este destino no podrá ser alterado sin consentimiento por escrito del PROPIETARIO. El incumplimiento de esta obligación dará derecho al PROPIETARIO para resolver de pleno derecho el contrato.</p>
    
    @if(isset($larder))
      <p class="p_contrat"><b>SEGUNDA.-</b>  Por el presente contrato El PROPIETARIO se obliga a ceder el uso de dicho inmueble a favor del INQUILINO, a título de ALQUILER. Por su parte el INQUILINO se obliga a pagar al  PROPIETARIO, el monto pactado en la cláusula en la forma y oportunidad convenidas.</p>
      <p class="p_contrat">Se deja expresa constancia que el inmueble es [ara uso y vivienda de {{$larder->num_person_may}} personas mayores de edad y {{$larder->num_person_men}} personas menores de edad. EL INQUILINO  no podrá  ceder, transferir, ni subalquilar, total o parcialmente a terceros.</p>
    @else
      <p class="p_contrat"><b>SEGUNDA.-</b>  Por el presente contrato El PROPIETARIO se obliga a ceder el uso de dicho inmueble a favor del INQUILINO, a título de ALQUILER. Por su parte el INQUILINO se obliga a pagar al  PROPIETARIO, el monto pactado en la cláusula en la forma y oportunidad convenidas.</p>
      <p class="p_contrat">Se deja expresa constancia que,  EL INQUILINO  no podrá  ceder, transferir, ni subalquilar, total o parcialmente a terceros.</p>
    @endif
    <h6>DURACIÓN</h6>
    <p class="p_contrat"><b>TERCERA.-</b> El plazo de duración del alquiler será por UN ano forzoso, y  comenzará a partir del  <?= $rentalMonth->date_admission; ?>  y  terminará en <?= $rentalMonth->date_end; ?>  sin necesidad de aviso previo.
      El Contrato podrá renovarse a su vencimiento, si ambas partes están de acuerdo, para lo cual el INQUILINO deberán informar al  PROPIETARIO de su deseo de renovar el contrato, por escrito con una anticipación no menor de 30 días calendarios a la fecha prevista para la renovación, debiendo constar ésta de documento escrito.</p>
    <p class="p_contrat"><b>CUARTA.-</b> El plazo de duración comenzará a contarse desde la fecha <?= $rentalMonth->date_admission; ?>, en que dicho local se pone a disposición del arrendatario, quien lo recibe, así como las llaves.</p>
    <h6>CANON DE ALQUILER, GARANTIA Y FORMA DE PAGO</h6>
    <p class="p_contrat">De común acuerdo entre partes, se conviene lo siguiente:</p>
    <p class="p_contrat"><b>QUINTA.-</b> Se fija en concepto de alquiler mensual la suma de   Bs. <?= $rentalMonth->payment; ?></p>
    <p class="p_contrat"><b>SEXTA.-</b> El pago se efectuará en los SIETE  primeros días de cada mes, la cancelación debe realizar  exclusivamente  en ADMINISTRACION en horario de  atención de la  galería.</p>
    <p class="p_contrat"><b>SÉPTIMA.-</b> El alquiler actualizado será exigible al INQUILINO a partir del mes siguiente en que se cumpla el contrato.</p>
    <p class="p_contrat"><b>OCTAVA.-</b>  La <b>FORMA de PAGO </b></p>
    <ol class="ol_contract" type="1">
      <li>El  INQUILINO, en señal de GARANTÍA hace efectivo a favor del PROPIETARIO  la suma de  Bs. <?= $rentalMonth->warranty; ?>, el mismo que se mantendrá hasta la conclusión del contrato. Dicho monto se constituye en garantía de cumplimiento del contrato y de conservación del inmueble, y le será devuelto al  INQUILINO al vencimiento del contrato y una vez que se hayan cubierto los pagos de alquiler  y se verifique el estado de conservación del inmueble, a satisfacción del PROPIETARIO.</li>
      <li>El pago mínimo de  alquiler  es  de  3 meses</li>
      <li>La presente garantía, no podrá tomarse como pago a cuenta por ningún mes, salvo acuerdo posterior de las partes; al cumplimiento del contrato el PROPIETARIO  se compromete restituir al INQUILINO,</li>
    </ol>
    <p class="p_contrat"><b>NOVENA.-</b> Durante la duración del contrato, cada vez que el mismo se prorrogue, el PROPIETARIO podrá exigir que la garantía sea incrementada,</p>
    <p class="p_contrat"><b>DÉCIMA.-</b> El saldo de la garantía que deba ser restituido al INQUILINO al final del contrato.</p>
    <h6>GASTOS  y  PAGO DE CONSUMOS</h6>
    <p class="p_contrat"><b>UNDÉCIMA.-</b> Los gastos generales para el adecuado sostenimiento del inmueble, sus servicios, tributos, cargas, impuestos y responsabilidades que no sean susceptibles de individualización y que correspondan al local comercial  alquilado o a sus accesorios, son a cargo del PROPIETARIO, cualquiera que sea su importe.</p>
    <p class="p_contrat"><b>DUODÉCIMA.-</b> El consumo  por los servicios con que cuente el inmueble alquilado, hará efectivo el INQUILINO desde el día de su ingreso en forma mensual y hasta la conclusión del alquiler, en forma íntegra e independiente, por cuanto las instalaciones alquiladas poseen medidor independiente (electricidad, teléfono) y deberá entregar la relación de pagos, costas y o facturación  al PROPIETARIO al finalizar el contrato celebrarse nuevo contrato o desocupar el inmueble.</p>
    <h6>ESTADO DE USO, CONSERVACIÓN, OBRAS  y  VISITAS DEL PROPIETARIO</h6>
    <p class="p_contrat"><b>DECIMOTERCERA.-</b> El INQUILINO recibe el INMUEBLE en buen estado de conservación,  se compromete  y responsabiliza del cuidado y mantenimiento y  devolverla al concluir el contrato, en el mismo estado, obligándose a hacer reparar los daños y deterioros que podrían producirse por negligencia o descuido.</p>
    <p class="p_contrat"><b>DECIMOCUARTA.-</b> En todo momento, y previa comunicación por escrito al PROPIETARIO, el INQUILINO puede realizar las reparaciones que sean urgentes para evitar un daño inminente en la infraestructura, y exigir de inmediato su importe al PROPIETARIO.</p>
    <p class="p_contrat"><b>DECIMOQUINTA.-</b> Las pequeñas reparaciones que exija el desgaste por el uso ordinario del  INMUEBLE (focos, mantenimiento de puertas de vidrios, tomacorrientes, interuptores , etc)serán de cargo del INQUILINO.</p>
    <p class="p_contrat"><b>DECIMOSEXTA.-</b> El INQUILINO no podrá realizar, sin el consentimiento del PROPIETARIO, expresado por escrito, obras que modifiquen la configuración del INMUEBLE o que provoquen una disminución en la estabilidad o seguridad del mismo.</p>
    <p class="p_contrat"><b>DECIMOSÉPTIMA.-</b> El INQUILINO está obligado a soportar la realización por el PROPIETARIO de obras de mejora cuya ejecución no pueda razonablemente diferirse hasta la conclusión del contrato, sin perjuicio del derecho que, en su caso, el INQUILINO pueda tener a desistir del contrato, o a una reducción de la renta.</p>
    <p class="p_contrat"><b>DECIMOCTAVA.-</b> La realización por el INQUILINO de obras de mejora no  dará derecho a elevar la renta anual ni en el momento de la finalización del contrato no se tendrá derecho a retirar las mejoras realizadas.</p>
    <p class="p_contrat"><b>DECIMONOVENA.-</b> El INQUILINO es dueño de la maquinaria o de cualquier aparato que utilice para realizar la actividad de VENTA DE JUGUETES O VENTA DE MATERIAL ESCOLAR y en el momento de la finalización del contrato retirará del local.</p>
    <p class="p_contrat"><b>VIGÉSIMA.-</b> El PROPIETARIO podrá entrar y comprobar el estado del local cada vez que lo considere oportuno, siempre con un preaviso de veinticuatro  horas y comunicándolo de forma escrita al INQUILINO.</p>
    <h6>CAUSAS DE RECISION DE CONTRATO</h6>
    <p class="p_contrat"><b>VIGÉSIMOPRIMERA.-</b> El presente contrato quedará NULO con la falta de cumplimiento de cualquiera de las cláusulas de este contrato y en las siguientes situaciones:</p>
    <ol class="ol_contract" type="1">
      <li>Darle al inmueble otro uso distinto al señalado en este contrato.</li>
      <li>Dejar de pagar el alquiler por un periodo superior a un mes.</li>
      <li>Modificar o alterar el inmueble sin la autorización aun si es con el fin de mejorarlo.</li>
      <li>Manejar, guardar o traficar artículos que dañen la salud o estén penados por las leyes del país.</li>
      <li>Tener animales sin la autorización del “PROPIETARIO”.</li>
      <li>Que el “INQUILINO” se conduzca en forma inmoral o ajena a las buenas costumbres (ruidos, griteríos, embriaguez y otros).</li>
      <li>Que el “INQUILINO” cause daños al inmueble.</li>
      <li>Que el “INQUILINO” subalquile o traspase, ceda los derechos de este contrato.</li>
      <li>Tener más de una de las acciones descritas con anterioridad o no hacer el pago en el plazo pactado.</li>
    </ol>
    <h6>INVENTARIO, NOTIFICACIONES y COMUNICACIONES</h6>
    <p class="p_contrat"><b>VIGÉSIMOSEGUNDA.-</b> Para recibir cualquier notificación las partes señalan las siguientes direcciones y teléfonos.
      El “PROPITARIO”……………………………………………….…………………………………………………………
      …………………………………..…………………………………………………………………………………………..

      El “INQUILINO”…………………………………………………………………………………………………………….
      ………………………………………………………………..………………………………………………………………</p>
    <h6 style="text-align: center;">INVENTARIO</h6>
    <p class="p_contrat"><b>VIGESIMOTERCERA.-</b> Este inmueble cuenta con los siguientes beneficios:
      Energía eléctrica, interruptores y enchufes en buen funcionamiento, focos de iluminación alógena; puertas en excelentes funciones con chapas y llaves.</p>
    <h6>ACEPTACION  y  VALIDEZ  DEL  DOCUMENTO</h6>
    <p class="p_contrat">VIGESIMOCUARTA.- La Sra. OCTAVINA GANDARILLAS CHAVARRIA por una parte como PROPIETARIO, y el señor (a): {{ $person->names." ".$person->last_name_f." ".$person->last_name_m }} por otra como INQUILINO, declaran entera conformidad y dan su aceptación a todas y cada una de las cláusulas anteriores , por lo que se otorgan al presente documento toda la validez, al solo reconocimiento y estampado de firmas y rubricas,  ambas partes suscriben este documento en dos ejemplares, cada uno de los cuales se considera como original.</p>
  <p class="p_contrat" style="text-align: center;">{{ $environment->date_contract }}</p>
    <div style="height: 40px;"></div>
    <br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 10%"></td>
        <td style="width: 40%"></td>
        <td style="width: 40%"></td>
        <td style="width: 10%"></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;" class="td_contrat_firma"><p>____________________</p><p>PROPIETARIO</p><p>Firma</p></td>
        <td style="text-align: center;" class="td_contrat_firma"><p>____________________</p><p>INQUILINO</p><p>Firma</p></td>
        <td></td>
      </tr>
    </table>
  </body>
</html>