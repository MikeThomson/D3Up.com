@section('content')
<style type="text/css" media="screen">
	.d3-tooltip .item-editor {
		padding: 10px;
	}
</style>
<div class='row'>
	<div class="span4 view-item-3">
		<h1>ItemBuilder Test</h1>
		<p>All functions of the item builder should work <u><b>except saving</b></u>. I've purposely disabled saving to avoid multiple people saving the same item over itself repeatedly.</p>
		<h2>Protip</h2>
		<p>To add new attributes fast!</p>
		<ol>
			<li>Click 'Add Attribute' (notice your focus is automatically in the text area).</li>
			<li>Start typing the name of the attribute, highlight the correct one by pressing up/down.</li>
			<li>Press 'Enter' once you have the stat you'd like to add (notice it focuses in the box again, for you to just type the value).</li>
			<li>Hit 'Tab' to highlight 'Add Attribute' again, and hit enter to add another attribute. Goto Step #2.</li>
		</ol>
	</div>
	<div class="span4 view-item-1">
		@include('item.display')->with('item', $item1)
		JSON Modifications:
		<textarea class='modified-item-1 input-block-level'></textarea>
	</div>
	<div class="span4 view-item-2">
		@include('item.display')->with('item', $item2)
		JSON Modifications:
		<textarea class='modified-item-2 input-block-level'></textarea>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$(".view-item-1 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item1->json())) }}'),
			onUpdate: function(modified) {
				console.log(JSON.stringify(modified));
				$(".modified-item-1").html(JSON.stringify(modified));
			}
		});
		$(".view-item-2 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item2->json())) }}'),
			onUpdate: function(modified) {
				console.log(JSON.stringify(modified));
				$(".modified-item-2").html(JSON.stringify(modified));
			}
		});
		$(".view-item-3 .d3-tooltip").itemBuilder({
			item: $.parseJSON('{{ addslashes(json_encode($item3->json())) }}'),
			onUpdate: function(modified) {
				console.log(JSON.stringify(modified));
				$(".modified-item-3").html(JSON.stringify(modified));
			}
		});
	});
</script>
@endsection