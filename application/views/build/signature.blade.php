@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
<link href="/css/paperdoll.css" rel="stylesheet">
@endsection

@section('content')
<div class='content-page'>
<p>We've generated a forum signature for you to use! This is placeholder text, and I should put some info here.</p>
<p><img src='http://sigs.d3up.com.s3.amazonaws.com/b/{{ $build->id }}.jpg'></p>
<p><input type='text' value='http://sigs.d3up.com/b/{{ $build->id }}.jpg' style='width: 600px'></p>
@if($build->_createdBy && Auth::user() && Auth::user()->id == $build->_createdBy->id)
<p>If you need to refresh your signature, click the button below.</p>
<form method='post'>
	<input type='submit' value='Regenerate' class='btn btn-success'>
</form>
@endif
</div>
@endsection