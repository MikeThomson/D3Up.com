@section('content')
<div class='row'>
	<div class="span4 item">
		@include('item.display')
		<a id="item-edit" class='btn'>Edit Item</a>
	</div>
	<div class="span8">
	@foreach(D3Up_Attributes::getInstance()->maxStat($item) as $stat => $value)
		{{ $stat }}
		<div class="progress">
		  <div class="bar" style="width: {{ $value }}%;"></div>
		</div>
	@endforeach
	</div>	
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$(".item .d3-tooltip").itemBuilder({
			editButton: '#item-edit',
			item: $.parseJSON('{{ addslashes(json_encode($item->json())) }}')
		});
	});
</script>
@endsection