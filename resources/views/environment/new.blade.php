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
                {!! Form::model($env, array('action' => array('EnvironmentController@store'))) !!}
                <div class="panel-body">
                    <h2>Editar Ambiente</h2>

                    {{ Form::hidden('env_id', $env->env_id) }}

                    {{ Form::label('type', 'Tipo:') }}
                    {{ Form::select('type', $arcedi_type, $env->type, array('class' => 'form-control', 'placeholder' => 'Selecione un tipo ...')) }}
                    @if ($errors->has('type')) <p class="help-block arcedi-error">{{ $errors->first('type') }}</p> @endif

                    {{ Form::label('type_use', 'Uso:') }}
                    {{ Form::select('type_use', $arcedi_type_use, $env->type_use, array('class' => 'form-control', 'placeholder' => 'Selecione un tipo de uso...')) }}
                    @if ($errors->has('type_use')) <p class="help-block arcedi-error">{{ $errors->first('type_use') }}</p> @endif

                    {{ Form::label('flat', 'Piso:') }}
                    {{ Form::number('flat', $env->flat, array('class' => 'form-control', 'placeholder' => '0.00', "min" => "1")) }}
                    @if ($errors->has('flat')) <p class="help-block arcedi-error">{{ $errors->first('flat') }}</p> @endif

                    {{ Form::label('area', 'Superficie:') }}
                    {{ Form::number('area', $env->area, array('class' => 'form-control', 'placeholder' => '0.00', "step" => "0.1", "min" => "1")) }}
                    @if ($errors->has('area')) <p class="help-block arcedi-error">{{ $errors->first('area') }}</p> @endif

                    {{ Form::label('code', 'Codigo:') }}
                    {{ Form::text('code', $env->code, array('class' => 'form-control', 'placeholder' => 'Ej. A-3, 3-P, etc.')) }}
                    @if ($errors->has('code')) <p class="help-block arcedi-error">{{ $errors->first('code') }}</p> @endif

                    {{ Form::label('rental', 'Alquiler Mes:') }}
                    {{ Form::number('rental', $env->rental, array('class' => 'form-control', 'placeholder' => 'alquiler', "step" => "0.01", "min" => "500", "max" => "900000")) }}
                    @if ($errors->has('rental')) <p class="help-block arcedi-error">{{ $errors->first('rental') }}</p> @endif

                    <div style="height: 5px;"></div>

                    <div class="panel panel-default">
                        <div id="d_panel-heading" class="panel-heading">Imagenes <a href="#" onclick="openUploadFile({{ $env->env_id }}); return false;"><span class="glyphicon glyphicon-cloud-upload"></span></a></div>
                        <div class="panel-body" id="d_panel_envimages">

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