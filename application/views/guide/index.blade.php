@layout('template.main')

@section('content')
<div class='row'>
	<div class='span9'>
		<h1>Diablo 3 Guides</h1>
		<ul>
		@foreach($guides as $guide)
			<li><a href='/guide/{{ $guide->id }}'>{{ $guide->title }}</a></li>
		@endforeach
		</ul>
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection