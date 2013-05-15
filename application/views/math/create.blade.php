@section('styles')
<link href="/css/math.css" rel="stylesheet">
@endsection

@section('content')
@include('math.header')
<div class='row'>
	<div class='span9 math-explanation'>
		@include('math.form.create')
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection