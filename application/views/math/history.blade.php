@layout('template.main')

<?php
	$lang = Config::get('application.language');
	$langs = Config::get('application.languages');
?>

@section('title')
	{{ $current->title }} - {{ $current->explanation }}
@endsection

@section('styles')
<link href="/css/math.css" rel="stylesheet">
@endsection

@section('content')
<div class='row'>
	<div class='span4 math-explanation'>
		<div class='alert alert-success'>
			<h3>Current Version </h3>
			<p>By {{ $current->_localized[$lang]->author }} on {{ date(DATE_ATOM, $current->_localized[$lang]->timestamp) }}</p>
		</div>
		@include('math.breadcrumb')->with('math', $current)->with('noNav', true)
		@if(isset($current->_localized[$lang]))
			<h1>{{ $current->_localized[$lang]['title'] }}</h1>
			<h2 class='lead'>{{ $current->_localized[$lang]['explanation'] }}</h2>
			<h5 class='lead'>
				Language Edited:
				@foreach($current->_localized as $lang => $data) 
					<a href='/locale/{{ $lang }}'>{{ $langs[$lang] }}</a>
				@endforeach
			</h5>
			<div class='content'>
				{{ $current->_localized[$lang]['html'] }}
			</div>
		@endif
	</div>
	<div class='span4 math-explanation'>
		<div class='alert alert-info'>
			<h3>Previous Version</h3>
			<p>By {{ $selected->_localized[$lang]->author }} on {{ date(DATE_ATOM, $selected->_localized[$lang]->timestamp) }}</p>
		</div>
		@include('math.breadcrumb')->with('math', $selected)->with('noNav', true)
		@if(isset($selected->_localized[$lang]))
			<h1>{{ $selected->_localized[$lang]['title'] }}</h1>
			<h2 class='lead'>{{ $selected->_localized[$lang]['explanation'] }}</h2>
			<h5 class='lead'>
				Language Edited:
				@foreach($selected->_localized as $lang => $data) 
					<a href='/locale/{{ $lang }}'>{{ $langs[$lang] }}</a>
				@endforeach
			</h5>
			<div class='content'>
				{{ $selected->_localized[$lang]['html'] }}
			</div>
		@endif
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection