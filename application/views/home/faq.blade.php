@section('content')
	<h1>D3Up.com FAQs</h1>
	<div class='row-fluid'>
		<div class='span3'>
			<ul class='nav nav-list'>
				<li><a href="/faq/build">Builds</a></li>
				<li><a href="/faq/math">Math</a></li>
				<li><a href="/faq/item">Items</a></li>
				<li><a href="/faq/guide">Guides</a></li>
				<li><a href="/faq/user">Users</a></li>
				<li><a href="/faq/sync">Battle.net Sync</a></li>
			</ul>
		</div>
		<div class='span9'>
			@include('home.faq.'.$slug)			
		</div>
	</div>
@endsection