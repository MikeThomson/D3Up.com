@layout('template.main')

@section('content')
@include('math.header')
<div class='row'>
	<div class='span9'>
		@include('math.form.create')
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection