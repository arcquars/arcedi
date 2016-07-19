<?php
use App\Arcedi\Utils;

?>
@extends('layouts.admin')
@section("content")
    <div class="row">
        <div class="col-md-3" style="padding-right: 2px;">
            @include('environment.menu_env')
        </div>
        <div class="col-md-9" style="padding-left: 2px;">
            <div class="panel panel-default">
                {!! Form::model($env1, array('action' => array('EnvironmentController@store'))) !!}
                <div class="panel-body">
                    <h2>Editar Ambiente</h2>

                    {{ Form::hidden('env_id', $env1->env_id) }}
                    {{ Form::label('type', 'Tipo:') }}
                    @if($isEdit)
                        {{ Form::text('type', $env1->type_code, array('class' => 'form-control arcedi-select-disabled', "readonly")) }}
                    @else
                        {{ Form::select('type', $arcedi_type, $env1->type, array('class' => 'form-control', 'placeholder' => 'Selecione un tipo ...')) }}
                    @endif
                    @if ($errors->has('type')) <p class="help-block arcedi-error">{{ $errors->first('type') }}</p> @endif

                    {{ Form::label('type_use', 'Uso:') }}
                    @if($isEdit)
                        {{ Form::text('type_use', $type_use, array('class' => 'form-control arcedi-select-disabled', "readonly")) }}
                    @else
                        {{ Form::select('type_use', $arcedi_type_use, $env1->type_use, array('class' => 'form-control', 'placeholder' => 'Selecione un tipo de uso...')) }}
                    @endif

                    @if ($errors->has('type_use')) <p class="help-block arcedi-error">{{ $errors->first('type_use') }}</p> @endif

                    {{ Form::label('flat', 'Piso:') }}
                    {{ Form::number('flat', $env1->flat, array('class' => 'form-control', 'placeholder' => '0.00')) }}
                    @if ($errors->has('flat')) <p class="help-block arcedi-error">{{ $errors->first('flat') }}</p> @endif

                    {{ Form::label('area', 'Superficie:') }}
                    {{ Form::number('area', $env1->area, array('class' => 'form-control', "step" => "0.1")) }}
                    @if ($errors->has('area')) <p class="help-block arcedi-error">{{ $errors->first('area') }}</p> @endif

                    {{ Form::label('code', 'Codigo:') }}
                    {{ Form::text('code', $env1->code, array('class' => 'form-control', 'placeholder' => 'Ej. A-2 o 2-B')) }}
                    @if ($errors->has('code')) <p class="help-block arcedi-error">{{ $errors->first('code') }}</p> @endif

                    {{ Form::label('rental', 'Alquiler Mes:') }}
                    {{ Form::number('rental', $env1->rental, array('class' => 'form-control', 'placeholder' => 'alquiler', "step" => "0.01", "min" => "500", "max" => "900000")) }}
                    @if ($errors->has('rental')) <p class="help-block arcedi-error">{{ $errors->first('rental') }}</p> @endif

                    <div style="height: 5px;"></div>
                    <div class="panel panel-default">
                        @if(count($envImages) <= 10)
                            <div id="d_panel-heading" class="panel-heading">Imagenes <a href="#" onclick="openUploadFile({{ $env1->env_id }}); return false;"><span class="glyphicon glyphicon-cloud-upload"></span></a></div>
                        @else
                            <div id="d_panel-heading" class="panel-heading">Imagenes <span class="glyphicon glyphicon-cloud-upload" style="color: #000;" title="Se llego al limite de imagenes"></span></div>
                        @endif
                        <div class="panel-body" id="d_panel_envimages">
                            <?php echo Utils::viewEnvImages($envImages); ?>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        {{ Form::submit('Grabar', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop()
@section("script")
    {!! Html::style( asset('assets/bower/FlexSlider/flexslider.css')) !!}
    {{ HTML::script(asset('assets/bower/FlexSlider/jquery.flexslider.js')) }}

    {!! Html::style( asset('assets/js/jQuery-File-Upload/css/jquery.fileupload.css')) !!}
    {{ HTML::script(asset('assets/js/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')) }}
    {{ HTML::script(asset('assets/js/jQuery-File-Upload/js/jquery.iframe-transport.js')) }}
    {{ HTML::script(asset('assets/js/jQuery-File-Upload/js/jquery.fileupload.js')) }}

    <script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
    <script type="text/javascript" src="/assets/js/arcedu_environment.js"></script>
    <script type="text/javascript" src="/assets/js/arcedu_env_image.js"></script>
    <script>
        $( document ).ready(function() {
            setMenuEnv($("#ul_menu_setting > li"));

            //$("input.arcedi-select-disabled").prop("readonly", true);
        });

        function setMenuEnv(menu){
            $.each(menu, function(index, value){
                $(value).removeClass("active");
            });
            $.each(menu, function(index, value){
                if(index == 0)
                    $(value).addClass("active");
            });
        }
    </script>
@stop()