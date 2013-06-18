@section('content')
<div class='row'>
	<div class="span4">
		<div id="builder">
			@include('item.display')
		</div>
	</div>
	<div class="span4">
		<div id='builder'></div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$("#builder .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item->json())) }}'),
			saveRedirect: '/i/{{ $item->id }}' 
		});
		// $("#builder .d3-tooltip").itemBuilder("destroy");
	});
</script>
@endsection