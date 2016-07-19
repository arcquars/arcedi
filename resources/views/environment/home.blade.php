@extends('layouts.admin')
@section("content")
    <div class="row">
        <div class="col-md-3" style="padding-right: 2px;">
            @include('environment.menu_env')
        </div>
        <div class="col-md-9" style="padding-left: 2px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10">{!! $filter !!}</div>
                        <div class="col-md-2" style="text-align: right;">
                            <a href="{{ url('env/new') }}" type="button" aria-label="Bold" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </a>
                        </div>
                    </div>
                    {!! $grid !!}
                </div>
            </div>
        </div>
    </div>
    <div id="modalContract" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title arcedu_title_modal">Contrato Alquiler</h4>
                </div>
                <div class="modal-body" id="modalContractBody" style="padding: 2px 20px;">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="modalG"></div>

    <div id="modalSelectTypeContract" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title arcedu_title_modal">Seleccione Tipo de Contrato</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <input type="hidden" id="typeContractIdEnvironment" value="" >
                    <input type="hidden" id="typeContractCodeEnvironment" value="">
                    <div class="btn-group" role="group" aria-label="">
                        <button onclick="openDialogContract(1); return false;" type="button" class="btn btn-primary notEnviroment">Alquiler</button>
                        <button onclick="openDialogContract(2); return false;" type="button" class="btn btn-primary notEnviroment">Anticretico</button>
                        <button onclick="openDialogContract(3); return false;" type="button" class="btn btn-primary enviroment">Hora</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop()
@section("script")
    {!! Html::style( asset('assets/bower/FlexSlider/flexslider.css')) !!}
    {{ HTML::script(asset('assets/bower/FlexSlider/jquery.flexslider.js')) }}
    <script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
    <script type="text/javascript" src="/assets/js/arcedu_chora.js"></script>
    <script type="text/javascript" src="/assets/js/arcedu_env_image.js"></script>
    <script type="text/javascript" src="/assets/js/arcedu_environment.js"></script>
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

        function openViewDeleteEnv(env_id){
            var model = new DeleteEnvModel();
            model.set('env_id', env_id);
            var modalView = new DeleteEnvView({'model': model});
            //Backbone.Validation.bind(modalView);
            modalView.show();
        }
    </script>
@stop()