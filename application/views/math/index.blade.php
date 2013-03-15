@layout('template.main')

@section('content')
<div class='row'>
	<div class='span9'>
		<h1>Diablo 3 Math - Explanations</h1>
		<p>Listed below you will find many common terms and formula's used in Diablo 3. Click on any of them to view an explanation of what they are, how they're generated and help you better understand your characters.</p>
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