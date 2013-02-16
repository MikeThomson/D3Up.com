@layout('template.main')

@section('content')
<div class='homepage'>
	<div class='row'>
		<div class='span9'>
			<div class='leaderboard'>
				<img src="http://placehold.it/728x90&text=Possible Promotion Spot, 728x90">
			</div>
			<div class='content-page hero-unit'>
				Stuff!
			</div>
		</div>
		<div class='span3'>
			<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/D3Up" data-widget-id="302248766797398016">Tweets by @D3Up</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
</div>
@endsection