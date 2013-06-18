@section('content')
<style type="text/css" media="screen">
	.d3-tooltip .item-editor {
		padding: 10px;
	}
</style>
<div class='row'>
	<div class="span4 view-item">
		@include('item.display')
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$(".view-item .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item->json())) }}')
		});
	});
</script>
@endsection