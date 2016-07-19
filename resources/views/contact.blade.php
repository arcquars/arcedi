@extends('layouts.essential')
@section('content')
    <div id="content"><div class="ic"></div>
    <div class="container">
        <div class="row">
            <article class="span8">
                <h3>Contactanos</h3>
                <div class="inner-1">
                    <form id="contact-form">
                        <div class="success"> Tu mensaje ha sido enviado exitosamente!<strong> Nos contactaremos pronto.</strong> </div>
                        <fieldset>
                            <div>
                                <label class="name">
                                    <input type="text" value="Tu nombre">
                                    <br>
                                    <span class="error">*Nombre invalido.</span> <span class="empty">*Campo requerido.</span> </label>
                            </div>
                            <div>
                                <label class="phone">
                                    <input type="tel" value="Telefono">
                                    <br>
                                    <span class="error">*Numero de Telefono invalido.</span> <span class="empty">*Campo requerido.</span> </label>
                            </div>
                            <div>
                                <label class="email">
                                    <input type="email" value="Email">
                                    <br>
                                    <span class="error">*Direccion de correo invalido.</span> <span class="empty">*Campo requerido.</span> </label>
                            </div>
                            <div>
                                <label class="message">
                                    <textarea>Mensaje</textarea>
                                    <br>
                                    <span class="error">*Mensaje muy corto.</span> <span class="empty">*Campo requerido.</span> </label>
                            </div>
                            <div class="buttons-wrapper"> <a class="btn btn-1" data-type="reset">Clear</a> <a class="btn btn-1" data-type="submit">Send</a></div>
                        </fieldset>
                    </form>
                </div>
            </article>
            <article class="span4">
                <h3>Datos de Contacto</h3>
                <div class="map">
                    <a href="http://dribbble.com/shots/624850-Presentaion-image-1" target="_blank"><img src="assets/codester/img/map.jpg" alt="Location on Map" /></a>
                </div>
                <address class="address-1">
                    <strong>Inbetwin Networks,<br>
                        Paud Phata, Road,<br>
                        Kothrud, Pune-38.</strong>
                    <div class="overflow"> <span>Mobile:</span>+91 12345 67890<br>
                        <span>Telephone:</span>+91 12345 67890<br>
                        <span>FAX:</span>+91 12345 67890 <br>
                        <span>E-mail:</span> <a href="#" class="mail-1">you@domain.com</a><br>
                        <span>Skype:</span> <a href="#" class="mail-1">@woohooo</a></div>
                </address>
            </article>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="assets/codester/js/forms.js"></script>
    <script>
        $( document ).ready(function() {
            items = $("#ulMeniArcEdi").find("li");
            $( items ).each(function( index ) {
                $(this).removeClass("active");
            });

            $( items ).each(function( index ) {
                if(index == 1)
                    $(this).addClass("active");
            });
        });

    </script>
@endsection
