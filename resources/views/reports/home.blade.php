@extends('layouts.admin') @section('content')

<div class="row">
	<div class="col-md-3" style="padding-right: 2px;">
		@include('reports.menu_report')</div>
	<div class="col-md-9" style="padding-left: 2px;">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3><i class="fa fa-university" aria-hidden="true"></i> Reportes de arqueos</h3>
				{!! $grid !!}
			</div>
		</div>
	</div>
</div>
@stop() @section("script")
<script type="text/javascript" src="/assets/js/arcedu_common.js"></script>
<script>
$( document ).ready(function() {
	setNavActive(5);

});
	function openArchingReport(link){
		alert($(link).attr("data-id"));
	}

	function openViewReport(link){
		window,location = "{{ route('arching.detail', array())}}/"+$(link).attr('data-id');
	}
</script>

@stop()
