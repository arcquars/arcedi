@extends('layouts.admin')
@section("content")
<div class="row">
  <div class="col-md-3" style="padding-right: 2px;">
      @include('store.menu_store')
  </div>
  <div class="col-md-9" style="padding-left: 2px;">
    <div class="panel panel-default">
      <div class="panel-body">
          <h4>Compra de productos</h4>
          <br>
          <div class="row">
              <div class="col-md-3" >Proveedor:</div>
              <div class="col-md-3"><input type="text" ></div>
              <div class="col-md-3">Nit:</div>
              <div class="col-md-3"><input type="number" ></div>
          </div>
          <div class="row">
              <div class="col-md-3" ># doc:</div>
              <div class="col-md-3"><input type="text" ></div>
              <div class="col-md-3">Fache:</div>
              <div class="col-md-3"><input type="date" ></div>
          </div>
          {!! $ids  !!}
      </div>
    </div>
  </div>
</div>

@stop()

@include('layouts.t_store')

@section("script")

	{!! Html::style( asset('assets/bower/FlexSlider/flexslider.css')) !!}
	{{ HTML::script(asset('assets/bower/FlexSlider/jquery.flexslider.js')) }}
    {{ HTML::script(asset('assets/bower/bs-typeahead/js/bootstrap-typeahead.min.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_common.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_store.js')) }}
    {{ HTML::script(asset('assets/js/arcedu_store_function.js')) }}
<script>
$( document ).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});



</script>
@stop()