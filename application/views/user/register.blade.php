@section('content')
<div class='row'>
	<div class='column_6 offset_2'>
		@include('user.login.register')
	</div>
	<div class='column_2 padding-top'>
		<div class='margin-top text center'>
			<h3 class='margin-top margin-bottom'>Privacy</h3>
			@include('user.login.disclaimer')
		</div>
	</div>
</div>
@endsection