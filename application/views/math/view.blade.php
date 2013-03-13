@layout('template.main')

@section('title')
	{{ $math->title }} - {{ $math->explanation }}
@endsection

@section('content')
<div class='row'>
	<div class='span9'>
		<h1>{{ $math->title }}</h1>
		<h2>{{ $math->explanation }}</h2>
		{{ $math->html }}
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection