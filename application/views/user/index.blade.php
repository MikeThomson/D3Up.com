@layout('template.main')

@section('headerbar')
User Dashboard for {{ Auth::user()->username }}
@endsection 

@section('content')
	This page isn't completed yet, but you're logged in!
@endsection