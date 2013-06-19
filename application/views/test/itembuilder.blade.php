@section('content')
<style type="text/css" media="screen">
	.d3-tooltip .item-editor {
		padding: 10px;
	}
</style>
<div class='row'>
	<div class="span4 view-item-1">
		@include('item.display')->with('item', $item1)
		<p class='alert alert-info'>
			JSON Modifications:
			<textarea class='modified-item-1 input-block-level'></textarea>
			<iframe id="iframe-1" src="/i/{{ $item1->id }}" height="500" width="340"></iframe>
		</p>
	</div>
	<div class="span4 view-item-2">
		@include('item.display')->with('item', $item2)
		<p class='alert alert-info'>
			JSON Modifications:
			<textarea class='modified-item-2 input-block-level'></textarea>
			<iframe id="iframe-2" src="/i/{{ $item2->id }}" height="500" width="340"></iframe>
		</p>
	</div>
	<div class="span4 view-item-3">
		@include('item.display')->with('item', $item3)
		<p class='alert alert-info'>
			JSON Modifications:
			<textarea class='modified-item-3 input-block-level'></textarea>
		</p>
		<iframe id="iframe-3" src="/i/{{ $item3->id }}" height="500" width="340"></iframe>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$(".view-item-1 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item1->json())) }}'),
			callback: function(modified) {
				console.log(JSON.stringify(modified));
				$(".modified-item-1").html(JSON.stringify(modified));
				console.log($("#iframe-1"));
				$("#iframe-1").attr( 'src', function ( i, val ) { return val; });
			}
		});
		$(".view-item-2 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item2->json())) }}'),
			callback: function(modified) {
				console.log(JSON.stringify(modified));
				$(".modified-item-2").html(JSON.stringify(modified));
				$("#iframe-2").attr( 'src', function ( i, val ) { return val; });
			}
		});
		$(".view-item-3 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item3->json())) }}'),
			callback: function(modified) {
				console.log(JSON.stringify(modified));
				$(".modified-item-3").html(JSON.stringify(modified));
				$("#iframe-3").attr( 'src', function ( i, val ) { return val; });
			}
		});
	});
</script>
@endsection