<div class='row bck white rounded margin-top pding'>
	<div class="column_12 padding">
		<h2>D3Up V2 Beta Updates</h2><hr>
		<h3>Features Currently Available</h3>
		<ul class='circle padding'>
			<li><a href="/build">New jQuery Build Browser</a> for browsing all builds.</li>
			<li><a href="http://github.com/d3up/api">New API</a> for serving out build information.</li>
			<li><a href="/b/1">Viewing a Build</a> (http://v2.d3up.com/b/###### insert your ID)</li>
			<li><a href="/c/1/2">Build Comparisons</a> (http://v2.d3up.com/c/##/## insert two IDs of builds)</li>
			<li><a href="http://github.com/d3up/Calculator">Started construction</a> of new Calculator (pure JS implementation)</li>
			<li><a href="http://cl.ly/image/1G2Y0W313Z2r">Preview of the new Sync Screen</a></li>
			<li>Helper "Tooltips" on common page to help explain how things work.</li>
			<li>Localization Enabled - You can change from 'English' to 'Pig Latin' using the dropdown in the upper right of the menubar on the top (thanks to allan on #diablo for the idea!)</li>
			<li>'<a href="/math">Math</a>' section added - A community 'wiki' type engine that will allow players to learn about different game mechanics.</li>
			<li>'<a href="/guide">Guide</a>' section added - Formatting still broken, editing not working yet.</li>
			<li>Added an <a href='/api-status'>API Status</a> check page to see if Battle.net's API is up or down.</li>
			<li>Started on a "Forum Signature" generator for your builds (<a href='/b/1/signature'>Example</a>)</li>
		</ul>
		@if(Cache::has('github_commits'))
		<table class='table'>
			@foreach(Cache::get('github_commits') as $date => $commit)
				<tr>
					<td>{{ date("M-j", strtotime($date)) }}</td>
					<td>{{ $commit }}</td>
				</tr>
			@endforeach
		</table>
		@endif
	</div>
</div>