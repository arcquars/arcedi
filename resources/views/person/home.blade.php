<?php
//print_r($env_lates_anti);
?>
@extends('layouts.admin')
@section("content")
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! $filter !!}
                        </div>
                        <div class="col-md-6" style="text-align: right"><button class="btn btn-secundary" data-toggle="modal" data-target="#modal_person">Crear Persona</button></div>
                    </div>
                    {!! $grid !!}

                    @if(count($errors) > 0)
                        <ul>
                        @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="modal_delete_person" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Borrar Persona</h4>
                    <input type="hidden" id="ih_modal_delete_person">
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-disable-person-cerrar" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="deletePerson();" class="btn btn-danger btn-disable-person">Borrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @include('person._person', array('personModel', $personModel))
@stop()
@section("script")
    {!! Html::style( asset('assets/bower/FlexSlider/flexslider.css')) !!}
    {{ HTML::script(asset('assets/bower/FlexSlider/jquery.flexslider.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_common.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_person.js')) }}

    <script>
        $( document ).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $('#modal_person').on('hidden.bs.modal', function (e) {
                $('#fPerson')[0].reset();
                $('#fPerson').find('em').css('display', 'none');
                $("#fPerson").find("input[name=ci]").removeAttr('readonly');
                $("#fPerson").find("input[name=id]").val('');
            })


            $('#fPerson').submit(function(event){
                var form = $('#fPerson');
                event.preventDefault();

                $(form).find('em').css('display', 'none');

                if($("#fPerson").find("input[name=id]").val() == ''){
                    createPerson(form);
                }else{
                    updatePerson(form);
                }

            });
        });

        function createPerson(form){
            $.ajax({
                 type     : "POST",
                 url      : '<?= url('person/create'); ?>',
                 data     : $("#fPerson").serialize(),
                 cache    : false,
                 success  : function(data) {
                        location.reload();
                 },
                 error: function(xhr) {
                     var json = $.parseJSON(xhr.responseText);
                     $.each(json, function(index, value){
                     var error = $(form).find('em.error_'+index).first();
                     $(error).empty();
                     $(error).append(value[0]);
                     $(error).css('display', 'block');
                     });
                 }

             });
        }

        function updatePerson(form){
            $.ajax({
                type     : "POST",
                url      : '<?= url('person/update'); ?>',
                data     : $("#fPerson").serialize(),
                cache    : false,
                success  : function(data) {
                    location.reload();
                },
                error: function(xhr) {
                    var json = $.parseJSON(xhr.responseText);
                    $.each(json, function(index, value){
                        var error = $(form).find('em.error_'+index).first();
                        $(error).empty();
                        $(error).append(value[0]);
                        $(error).css('display', 'block');
                    });
                }

            });
        }

        function openModelEditPerson(id){
            //$("#modal_person").modal('show');
            $.ajax({
                type     : "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url      : '<?= url('person/getPersonById'); ?>/'+id,
                dataType: 'json',
                cache    : false,
                success  : function(data) {
                    $("#modal_person").modal('show');

                    $("#fPerson").find("input[name=id]").val(data.person.id);
                    $("#fPerson").find("input[name=ci]").val(data.person.ci);
                    $("#fPerson").find("input[name=ci]").attr('readonly', 'readonly');
                    $("#fPerson").find("select[name=expedido]").val(data.person.expedido);
                    $("#fPerson").find("select[name=expedido]").attr('readonly', 'readonly');
                    $("#fPerson").find("input[name=names]").val(data.person.names);
                    $("#fPerson").find("input[name=last_name_f]").val(data.person.last_name_f);
                    $("#fPerson").find("input[name=last_name_m]").val(data.person.last_name_m);
                    $("#fPerson").find("input[name=email]").val(data.person.email);
                    $("#fPerson").find("input[name=career]").val(data.person.career);
                    $("#fPerson").find("input[name=phone]").val(data.person.phone);
                    $("#fPerson").find("input[name=phone_cel]").val(data.person.phone_cel);
                },
                error: function(xhr) {
                    var json = $.parseJSON(xhr.responseText);
                    alert(json);
                }

            });
        }

        function openModelDeletePerson(per_id){
            $.ajax({
                type     : "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url      : '<?= url('person/validDeletePerson'); ?>/'+per_id,
                dataType: 'json',
                cache    : false,
                success  : function(data) {
                    $("#modal_delete_person").modal('show');
                    $("#ih_modal_delete_person").val(per_id);
                    var body = $("#modal_delete_person").find('.modal-body').first();

                    $(body).empty();
                    var html = "";
                    if(data.valid){
                        html += "<div class='alert alert-danger' role='alert'>";
                        html += "Esta seguro de Eliminar a <strong>"+data.person.names+" "+data.person.last_name_f;
                        html += "</strong>?</div>";

                        $("#modal_delete_person").find('.btn-disable-person-cerrar').first().removeAttr("disabled");
                        $("#modal_delete_person").find('.btn-disable-person').first().removeAttr("disabled");
                    }else{
                        html += "<div class='alert alert-danger' role='alert'>";
                        html += "No puede borrar a <strong>"+data.person.names+" "+data.person.last_name_f +"</strong> por que tiene contratos o pagos en el sistema!";
                        html += "</div>";

                        $("#modal_delete_person").find('.btn-disable-person-cerrar').first().removeAttr("disabled");
                        $("#modal_delete_person").find('.btn-disable-person').first().attr("disabled", "disabled");

                    }
                    $(body).append(html);
                },
                error: function(xhr) {
                    var json = $.parseJSON(xhr.responseText);
                    alert(json);
                }

            });
        }

        function deletePerson(){
            $.ajax({
                type     : "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url      : '<?= url('person/deletePerson'); ?>/'+$("#ih_modal_delete_person").val(),
                dataType: 'json',
                cache    : false,
                success  : function(data) {
                    $("#modal_delete_person").modal('hide');
                    location.reload();
//                    alert($("#ih_modal_delete_person").val());
                },
                error: function(xhr) {
                    var json = $.parseJSON(xhr.responseText);
                    alert(json);
                }

            });

        }
    </script>
@stop()