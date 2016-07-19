<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Comprobante</title>
    {!! Html::style('assets/css/pdf.css') !!}
  </head>
  <body>
    <h5 style="text-align: center;">CONTRATO DE ALQUILER DE LOCAL COMERCIAL</h5>
    <p class="p_contrat">En………………de…………. de………..</p>
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
      <li>Que la <b>{{ $arcedi['arcedi_contract_owner_name'] }}</b> es PROPIETARIO, de un local, situado en <b>{{ $piso }}</b> del edificio <b>{{ $arcedi['arcedi_nameCompany'] }}</b> con codigo <b>{{ $environment->code }}</b>. de <b>{{ $arcedi['arcedi_address'] }}</b> de la ciudad de Cochabamba con una superficie de <b>{{ $environment->area }}</b> metros cuadrados.</li>
      <li>Ambas partes  han concertado  que el presente contrato de alquiler de dicho local se regulará de acuerdo con las siguientes clausulas.</li>
    </ol>
    <h6>CLAUSULAS</h6>
    <h6>OBJETO, CONTENIDO Y DESTINO</h6>
    <p class="p_contrat"><b>PRIMERA.-</b> El PROPIETARIO alquila el  inmueble en perfecto estado y útil para su fin al INQUILINO para local comercial destinado a una VENTA DE JUGUETES O VENTA DE MATERIAL ESCOLAR.
      Este destino no podrá ser alterado sin consentimiento por escrito del PROPIETARIO. El incumplimiento de esta obligación dará derecho al PROPIETARIO para resolver de pleno derecho el contrato.</p>
    <p class="p_contrat"><b>SEGUNDA.-</b>  Se deja expresa constancia que,  EL INQUILINO  no podrá  ceder, transferir, ni subalquilar, total o parcialmente a terceros.</p>
    <h6>DURACIÓN</h6>
    <p class="p_contrat"><b>TERCERA.-</b> El plazo de duración del alquiler será por UN ano forzoso, y  comenzará a partir del  día 1de mayo 2016  y  terminará el  día 30 de  abril del 2017 sin necesidad de aviso previo.
      El Contrato podrá renovarse a su vencimiento, si ambas partes están de acuerdo, para lo cual el INQUILINO deberán informar al  PROPIETARIO de su deseo de renovar el contrato, por escrito con una anticipación no menor de 30 días calendarios a la fecha prevista para la renovación, debiendo constar ésta de documento escrito.</p>
    <p class="p_contrat"><b>CUARTA.-</b> El plazo de duración comenzará a contarse desde la fecha 1 mayo 2016, en que dicho local se pone a disposición del arrendatario, quien lo recibe, así como las llaves.</p>
    <h6>CANON DE ALQUILER, GARANTIA Y FORMA DE PAGO</h6>
    <p class="p_contrat">De común acuerdo entre partes, se conviene lo siguiente:</p>
    <p class="p_contrat"><b>QUINTA.-</b> Se fija en concepto de alquiler mensual la suma de   $us…………... (……………………… 00/100 DÓLARES AMERICANOS.-)</p>
    <p class="p_contrat"><b>SEXTA.-</b> El pago se efectuará en los SIETE  primeros días de cada mes, la cancelación debe realizar  exclusivamente  en ADMINISTRACION en horario de  atención de la  galería.</p>
    <p class="p_contrat"><b>SÉPTIMA.-</b> El alquiler actualizado será exigible al INQUILINO a partir del mes siguiente en que se cumpla el contrato.</p>
    <p class="p_contrat"><b>OCTAVA.-</b>  La <b>FORMA de PAGO </b></p>
    <ol class="ol_contract" type="1">
      <li>El  INQUILINO, en señal de GARANTÍA hace efectivo a favor del PROPIETARIO  la suma de  $us. SETECIENTOS 00/100 DOLARES AMERICANOS), el mismo que se mantendrá hasta la conclusión del contrato. Dicho monto se constituye en garantía de cumplimiento del contrato y de conservación del inmueble, y le será devuelto al  INQUILINO al vencimiento del contrato y una vez que se hayan cubierto los pagos de alquiler  y se verifique el estado de conservación del inmueble, a satisfacción del PROPIETARIO.</li>
      <li>El pago mínimo de  alquiler  es  de  3 meses</li>
      <li>La presente garantía, no podrá tomarse como pago a cuenta por ningún mes, salvo acuerdo posterior de las partes; al cumplimiento del contrato el PROPIETARIO  se compromete restituir al INQUILINO,</li>
    </ol>
    <p class="p_contrat"><b>NOVENA.-</b> Durante la duración del contrato, cada vez que el mismo se prorrogue, el PROPIETARIO podrá exigir que la garantía sea incrementada,</p>
    <p class="p_contrat"><b>DÉCIMA.-</b> El saldo de la garantía que deba ser restituido al INQUILINO al final del contrato.</p>
    <h6>FUNCIONAMENTO DE GALERIA</h6>
    <p class="p_contrat"><b>UNDÉCIMA.-</b>  Todos los inquilinos  deben respetar el siguiente  funcionamiento</p>
    <ol class="ol_contract" type="1">
      <li>El Horario de  atención de la galería  es la siguiente
        <ul>
          <li>Días normales de 9.00 AM hasta  las 7.30PM</li>
          <li>Días de feria  de las 9.00AM hasta las  8.00PM</li>
          <li>El cumplimiento de  estos  horarios dependerá  de la cantidad  de  inquilinos  estén en la galería minimo 4, todo por reguardar  la seguridad  de la galería.</li>
          <li>Días Feriados  se pondrá  a  disposición de la mayoría de  los inquilinos y  previa autorización de  la administración definiendo también los horarios.</li>
        </ul>
      </li>
      <li>En el caso de  descarga  de  mercadería  el inquilino debe  ser previo aviso a  la administración 24horas antes para así coordinar el horario  para dicha actividad.</li>
      <li>El uso del baño no está incluido en el presente  contrato puesto así que el inquilino es responsable del pago del uso de  baño.</li>
      <li>Los inquilinos están en su responsabilidad  de pedir  una reunión para poder  hacer conocer cualquier observación sugerencia o reclamo a  la administración para así poder  dar solución o encontrar  una respuesta para el mejor funcionamiento de la galería.</li>
      <li>Del funcionamiento de  la galería la administración es el responsable de normar a los inquilinos en los siguientes  puntos.
        <ul>
          <li>tiendas hacia la  calle está totalmente prohibido colocado de  estante  mayores  de  1.2 metros de altura, tampoco estantes que vayan en contra  de  la estética del edificio.</li>
          <li>Tiendas  pasillo solo tienen ( 70 cm días normales y 50 dias   de mucha venta )de salida  hacia el pasillo solo en los frentes  de sus tiendas y no así en las columnas  de la galería, las vitrinas o estantes deben ser adecuados a la estética  de la galería.</li>
          <li>Esta totalmente  prohibido dejar  vitrinas, estantes o basura  en el pasillo de la galería al momento de  desocupar el ambiente.</li>
        </ul>
      </li>
      <li>La ADMINISTRACION se  hace responsable de la  limpieza e iluminación de la galería comercial.</li>
    </ol>
    <h6>GASTOS  y  PAGO DE CONSUMOS</h6>
    <p class="p_contrat"><b>DUODÉCIMA.-</b> Los gastos generales para el adecuado sostenimiento del inmueble, sus servicios, tributos, cargas, impuestos y responsabilidades que no sean susceptibles de individualización y que correspondan al local comercial  alquilado o a sus accesorios, son a cargo del PROPIETARIO, cualquiera que sea su importe.</p>
    <p class="p_contrat"><b>DECIMOTERCERA.-</b> El consumo  por los servicios con que cuente el inmueble alquilado, hará efectivo el INQUILINO desde el día de su ingreso en forma mensual y hasta la conclusión del alquiler, en forma íntegra e independiente, por cuanto las instalaciones alquiladas poseen medidor independiente (electricidad, teléfono) y deberá entregar la relación de pagos, costas y o facturación  al PROPIETARIO al finalizar el contrato celebrarse nuevo contrato o desocupar el inmueble.</p>
    <h6>ESTADO DE USO, CONSERVACIÓN, OBRAS  y  VISITAS DEL PROPIETARIO</h6>
    <p class="p_contrat"><b>DECIMOCUARTA.-</b> El INQUILINO recibe el INMUEBLE en buen estado de conservación,  se compromete  y responsabiliza del cuidado y mantenimiento y  devolverla al concluir el contrato, en el mismo estado, obligándose a hacer reparar los daños y deterioros que podrían producirse por negligencia o descuido.</p>
    <p class="p_contrat"><b>DECIMOQUINTA.-</b> En todo momento, y previa comunicación por escrito al PROPIETARIO, el INQUILINO puede realizar las reparaciones que sean urgentes para evitar un daño inminente en la infraestructura, y exigir de inmediato su importe al PROPIETARIO.</p>
    <p class="p_contrat"><b>DECIMOSEXTA.-</b> Las pequeñas reparaciones que exija el desgaste por el uso ordinario del  INMUEBLE (focos, mantenimiento de puertas de vidrios, tomacorrientes, interuptores , etc)serán de cargo del INQUILINO.</p>
    <p class="p_contrat"><b>DECIMOSÉPTIMA.-</b> El INQUILINO no podrá realizar, sin el consentimiento del PROPIETARIO, expresado por escrito, obras que modifiquen la configuración del INMUEBLE o que provoquen una disminución en la estabilidad o seguridad del mismo.</p>
    <p class="p_contrat"><b>DECIMOCTAVA.-</b> El INQUILINO está obligado a soportar la realización por el PROPIETARIO de obras de mejora cuya ejecución no pueda razonablemente diferirse hasta la conclusión del contrato, sin perjuicio del derecho que, en su caso, el INQUILINO pueda tener a desistir del contrato, o a una reducción de la renta.</p>
    <p class="p_contrat"><b>DECIMONOVENA.-</b> La realización por el INQUILINO de obras de mejora no  dará derecho a elevar la renta anual ni en el momento de la finalización del contrato no se tendrá derecho a retirar las mejoras realizadas.</p>
    <p class="p_contrat"><b>VIGÉSIMA.-</b> El INQUILINO es dueño de la maquinaria o de cualquier aparato que utilice para realizar la actividad de VENTA DE JUGUETES O VENTA DE MATERIAL ESCOLAR y en el momento de la finalización del contrato retirará del local.</p>
    <p class="p_contrat"><b>VIGÉSIMOPRIMERA.-</b> El PROPIETARIO podrá entrar y comprobar el estado del local cada vez que lo considere oportuno, siempre con un preaviso de veinticuatro  horas y comunicándolo de forma escrita al INQUILINO.</p>
    <h6>CAUSAS DE RECISION DE CONTRATO</h6>
    <p class="p_contrat"><b>VIGÉSIMOSEGUNDA.-</b> El presente contrato quedará NULO con la falta de cumplimiento de cualquiera de las cláusulas de este contrato y en las siguientes situaciones:</p>
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
    <p class="p_contrat"><b>VIGESIMOTERCERA.-</b> Para recibir cualquier notificación las partes señalan las siguientes direcciones y teléfonos.
      El “PROPITARIO”……………………………………………….…………………………………………………………
      …………………………………..…………………………………………………………………………………………..

      El “INQUILINO”…………………………………………………………………………………………………………….
      ………………………………………………………………..………………………………………………………………</p>
    <h6 style="text-align: center;">INVENTARIO</h6>
    <p class="p_contrat"><b>VIGESIMOCUARTA.-</b> Este inmueble cuenta con los siguientes beneficios:
      Energía eléctrica, interruptores y enchufes en buen funcionamiento, focos de iluminación alógena; puertas en excelentes funciones con chapas y llaves.</p>
    <h6>ACEPTACION  y  VALIDEZ  DEL  DOCUMENTO</h6>
    <p class="p_contrat">VIGESIMOQUINTA.- La Sra. OCTAVINA GANDARILLAS CHAVARRIA por una parte como PROPIETARIO, y el señor: ………………………………………………………………………..por otra como INQUILINO, declaran entera conformidad y dan su aceptación a todas y cada una de las cláusulas anteriores , por lo que se otorgan al presente documento toda la validez, al solo reconocimiento y estampado de firmas y rubricas,  ambas partes suscriben este documento en dos ejemplares, cada uno de los cuales se considera como original.</p>
    <p class="p_contrat" style="text-align: center;">16 de abril de 2016</p>
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