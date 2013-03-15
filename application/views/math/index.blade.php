@layout('template.main')

@section('content')
<div class='row'>
	<div class='span9'>
		<ul>
		@foreach($math as $entry)
			<li><a href='/math/{{ $entry->id }}'>{{ $entry->title }}</a></li>
		@endforeach
		</ul>
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection