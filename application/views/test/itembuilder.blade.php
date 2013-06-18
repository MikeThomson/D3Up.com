@section('content')
<style type="text/css" media="screen">
	.d3-tooltip .item-editor {
		padding: 10px;
	}
</style>
<div class='row'>
	<div class="span4 view-item-1">
		@include('item.display')->with('item', $item1)
	</div>
	<div class="span4 view-item-2">
		@include('item.display')->with('item', $item2)
	</div>
	<div class="span4 view-item-3">
		@include('item.display')->with('item', $item3)
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$(".view-item-1 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item1->json())) }}')
		});
		$(".view-item-2 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item2->json())) }}')
		});
		$(".view-item-3 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item3->json())) }}')
		});
	});
</script>
@endsection