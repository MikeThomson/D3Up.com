@layout('template.main')

<?php
	$lang = Config::get('application.language');
	$langs = Config::get('application.languages');
?>

@section('title')
	{{ $math->title }} - {{ $math->explanation }}
@endsection

@section('content')
<div class='row'>
	<div class='span9'>
		@if(isset($math->_localized[$lang]))
			<h1>{{ $math->_localized[$lang]['title'] }}</h1>
			<h5>
				Languages available: 
				@foreach($math->_localized as $lang => $data) 
					<a href='/locale/{{ $lang }}'>{{ $langs[$lang] }}</a>
				@endforeach
			</h5>
			<h2>{{ $math->_localized[$lang]['explanation'] }}</h2>
			{{ $math->_localized[$lang]['html'] }}
		@else 
			<h3>The '{{ $math->title }}' explanation is not available in {{ Session::get('locale_name') }}.</h3>
			<h5>
				Languages available: 
				@foreach($math->_localized as $lang => $data) 
					<a href='/locale/{{ $lang }}'>{{ $langs[$lang] }}</a>
				@endforeach
			</h5>
			<p>Please use the language selection tool at in the upper right portion of the page to select one of the languages it's available in.</p>
			<p>If you'd like to contribute to the translation of these terms, please visit the <a href='/math/{{ $math->id }}/edit'>Edit Page</a>.</p>
		@endif
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection