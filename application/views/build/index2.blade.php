@layout('template.main')

@section('content')
	@if(isset($characters) && count($characters) > 0)
		@include("build.table-api")
	@else
		@include("build.table")
	@endif
@endsection