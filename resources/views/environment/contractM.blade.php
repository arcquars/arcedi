@extends('layouts.admin')
@section("content")
    <div class="row">
        <div class="col-md-3" style="padding-right: 2px;">
            @include('environment.menu_env')
        </div>
        <div class="col-md-9" style="padding-left: 2px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 style="color: #474B03;">Historial contrato alquiler por mes</h4>
                    <table style="width: 100%;">
                        <tr>
                            <td><h5 class="h5_arcedi"><b>Contratante: </b>{!! $person->names." ".$person->last_name_f." ".$person->last_name_m !!}</h5></td>
                            <td style="text-align: right;"></td>
                        </tr>
                        <tr>
                            <td><h5 class="h5_arcedi"><b>Ambiente: </b>{!! $environment->code !!}</h5></td>
                            <td style="text-align: right;"><h5 class="h5_arcedi"><b>Contrato:</b> {!! $contractModel->contract_id !!}</h5></td>
                        </tr>
                        <tr>
                            <td><h5 class="h5_arcedi"><b>Fecha Inicio Contrato: </b>{!! $rental_m->date_admission !!}</h5></td>
                            <td style="text-align: right;"><h5 class="h5_arcedi"><b>Fin Contrato: </b>{!! $rental_m->date_end !!}</h5></td>

                        </tr>
                    </table>
                    {!! $grid !!}
                </div>
            </div>
        </div>
    </div>
@stop()
@section("script")
    <script>

    </script>
@stop()