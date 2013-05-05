@layout('template.main')

@section("headerbar")
D3Up.com - Diablo 3 Build Calculator for EHP and DPS
@endsection

@section('content')
<div class='row'>
	<div class='span9'>
		<!-- <div class='leaderboard'>
			<img src="http://placehold.it/728x90&text=Possible Promotion Spot, 728x90">
		</div> -->
		<div class='content-page hero-unit'>
			<h2>D3Up V2 - Update History</h2>
			<p>Below is the update history from Github chronicling the development of V2. Some of it probably won't make much sense to non-techies, but you'll see new features being added as they come along. I'll try to feature some links to things as well as they become available.</p>
			<h3>Currently Available</h3>
			<ul>
				<li><a href="/b/1">Viewing Builds</a> (http://v2.d3up.com/b/###### insert your number)</li>
				<li><a href="http://cl.ly/image/1G2Y0W313Z2r">Preview of the new Sync Screen</a></li>
				<li>Localization Enabled - You can change from 'English' to 'Pig Latin' using the dropdown in the upper right of the menubar on the top (thanks to allan on #diablo for the idea!)</li>
				<li>'<a href="/math">Math</a>' section added - A community 'wiki' type engine that will allow players to learn about different game mechanics.</li>
				<li>'<a href="/guide">Guide</a>' section added - Formatting still broken, editing not working yet.</li>
				<li>Added an <a href='/api-status'>API Status</a> check page to see if Battle.net's API is up or down.</li>
				<li>Started on a "Forum Signature" generator for your builds (<a href='/b/1/signature'>Example</a>)</li>
			</ul>
			@if(Cache::has('github_commits'))
			<table class='recent-commits table'>
				@foreach(Cache::get('github_commits') as $date => $commit)
					<tr>
						<td>{{ date("M j, Y", strtotime($date)) }}</td>
						<td>{{ $commit }}</td>
					</tr>
				@endforeach
			</table>
			@endif
		</div>
	</div>
	<div class='span3'>
		@if(Cache::has('reddit-activity'))
		<table class='table'>
			<tr>
				<th colspan='2'>
					<a href='http://reddit.com/r/d3up'>/r/D3Up Discussions</a>
				</th>
			</tr>
			@foreach(Cache::get('reddit-activity') as $post)
				<tr>
					<td>+{{ $post['score'] }}</td>
					<td><a href='{{ $post['url'] }}'>{{ $post['title'] }}</a></td>
				</tr>
			@endforeach
		</table>
		@endif
		<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/D3Up" data-widget-id="302248766797398016">Tweets by @D3Up</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
</div>
@endsection