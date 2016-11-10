@extends('layouts.admin') @section('content')
<div class="row">
	<div class="col-md-3" style="padding-right: 2px;">
		@include('reports.menu_report')</div>
	<div class="col-md-9" style="padding-left: 2px;">
		<div class="panel panel-default">
			<div class="panel-body">{!! $grid !!}</div>
		</div>
	</div>
</div>
@stop() @section("script")
<script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
<script>
$( document ).ready(function() {
	setNavActive(5);

});
</script>
@stop()
