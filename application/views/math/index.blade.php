@layout('template.main')

@section('styles')
<link href="/css/math.css" rel="stylesheet">
@endsection

@section('content')
<div class='row'>
	<div class='span9 math-explanation'>
		@include('math.breadcrumb')
		<h1>{{ __('math.explained') }}</h1>
		<h5 class='lead'>{{ __('math.description') }}</h5>
		<div class='content'>
			<p>Listed below you will find many common terms and formula's used in Diablo 3. Click on any of them to view an explanation of what they are, how they're generated and help you better understand your characters.</p>
			<p>Have one you think needs adding? <a href='/math/create' class='btn btn-mini'>Create a new one!</a></p>
			<ul>
			@foreach($math as $entry)
				<li><a href='/math/{{ $entry->id }}'>{{ $entry->title }}</a></li>
			@endforeach
			</ul>
		</div>
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection