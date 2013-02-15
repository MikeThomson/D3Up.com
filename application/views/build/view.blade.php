@layout('template.main')

@section('content')
@include('build.section.header')
<div class='row'>
	<div class='span3'>
		<ul class="nav nav-list">
		  <li class="nav-header">List header</li>
		  <li class="active"><a href="#">Home</a></li>
		  <li><a href="#">Library</a></li>
		  ...
		</ul>
	</div>
	<div class='span6'>Body</div>
	<div class='span3'>Stats</div>
</div>
@endsection