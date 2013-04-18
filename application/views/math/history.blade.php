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
		<div class='alert'>
			<h3>Differences</h3>
			<p><del>Red = Removed</del>, <ins>Green = Added</ins></p>
		</div>
		<h1 id="title-diff">{{ $selected->_localized[$lang]['title'] }}</h1>
		<h2 class='lead' id="lead-diff">{{ $selected->_localized[$lang]['explanation'] }}</h2>
		<h5 class='lead'>
			Language Edited:
			@foreach($current->_localized as $lang => $data) 
				<a href='/locale/{{ $lang }}'>{{ $langs[$lang] }}</a>
			@endforeach
		</h5>
		<div class='content' id="content-diff">
		</div>
	</div>
	<div class='span4 math-explanation'>
		<div class='alert alert-success'>
			<h3>Current Version </h3>
			<p>By {{ $current->_localized[$lang]->author }} on {{ date("Y-m-d", $current->_localized[$lang]->timestamp) }}</p>
		</div>
		@if(isset($current->_localized[$lang]))
			<h1 class='title-modified'>{{ $current->_localized[$lang]['title'] }}</h1>
			<h2 class='lead lead-modified'>{{ $current->_localized[$lang]['explanation'] }}</h2>
			<h5 class='lead'>
				Language Edited:
				@foreach($current->_localized as $lang => $data) 
					<a href='/locale/{{ $lang }}'>{{ $langs[$lang] }}</a>
				@endforeach
			</h5>
			<div class='content content-modified'>
				{{ $current->_localized[$lang]['html'] }}
			</div>
		@endif
	</div>
	<div class='span4 math-explanation'>
		<div class='alert alert-info'>
			<h3>Previous Version</h3>
			<p>By {{ $selected->_localized[$lang]->author }} on {{ date("Y-m-d", $selected->_localized[$lang]->timestamp) }}</p>
		</div>
		@if(isset($selected->_localized[$lang]))
			<h1 class='title-original'>{{ $selected->_localized[$lang]['title'] }}</h1>
			<h2 class='lead lead-original'>{{ $selected->_localized[$lang]['explanation'] }}</h2>
			<h5 class='lead'>
				Language Edited:
				@foreach($selected->_localized as $lang => $data) 
					<a href='/locale/{{ $lang }}'>{{ $langs[$lang] }}</a>
				@endforeach
			</h5>
			<div class='content content-original'>
				{{ $selected->_localized[$lang]['html'] }}
			</div>
		@endif
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$(function() {
	$("#lead-diff").prettyTextDiff({
		originalContainer: $(".lead-original"),
		changedContainer: $(".lead-modified"),
		diffContainer: $("#lead-diff"),
		debug: true
	});	
	$("#title-diff").prettyTextDiff({
		originalContainer: $(".title-original"),
		changedContainer: $(".title-modified"),
		diffContainer: $("#title-diff"),
		debug: true
	});	
	$("#content-diff").prettyTextDiff({
		originalContainer: $(".content-original"),
		changedContainer: $(".content-modified"),
		diffContainer: $("#content-diff"),
		debug: true
	});
});
</script>
@endsection
