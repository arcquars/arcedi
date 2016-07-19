@extends('layouts.admin')
@section("content")
<div class="row">
  <div class="col-md-3" style="padding-right: 2px;">
      @include('store.menu_store')
  </div>
  <div class="col-md-9" style="padding-left: 2px;">
    <div class="panel panel-default">
      <div class="panel-body">
          <div style="text-align: right; padding: 10px 15px;">
              <a href="#" onclick="openViewNeWProduct(); return false;"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
      {!! $grid !!}
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

function openViewNeWProduct(env_id){
    var model = new ProductModel();
    //model.set('env_id', env_id);
    var modalView = new ProductView({'model': model});
    Backbone.Validation.bind(modalView);
    modalView.show();
}

function openModelProductEdit(product_id){
    $.ajax({
        url: "/store/getProduct/"+product_id,
        dataType: "json",
        context: document.body
    }).done(function(data) {
        console.log(data);
        if(data !== null){
            var model = new ProductModel(data.product);
            var modalView = new ProductEditView({'model': model});
            Backbone.Validation.bind(modalView);
            modalView.show();
        }else{
            alert("Paso algo inesperado...");
        }
    });
}

</script>
@stop()