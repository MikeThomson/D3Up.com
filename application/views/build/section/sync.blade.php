<h3>Sync with Battle.net Profile</h3>
<p>If you'd like to Sync your character with how it's currently shown on Battle.net, use one of the options below.</p>
<div class='btn-group'>
	<a class='btn' href="/b/{{ $build->id }}/sync">Sync</a>
	<a class='btn' href="/b/{{ $build->id }}/sync?type=skills">Sync Skills</a>
	<a class='btn' href="/b/{{ $build->id }}/sync?type=gear">Sync Gear</a>
	<a class='btn' href="/b/{{ $build->id }}/sync?type=forced">Forced Sync</a>
</div>
<h4>Explanation of Sync Methods</h4>
<ul>
	<li><strong>Complete Sync</strong>: Quickly scans your Battle.net profile and updates with new items.</li>
	<li><strong>Sync Skills</strong>: Will only Sync your skills, and not gear.</li>
	<li><strong>Sync Gear</strong>: Will only Sync your gear, and not skills.</li>
	<li><strong>Forced Sync</strong>: (<strong>WARNING:</strong> This will cause duplicate items) Does a full Sync of your profile, ensuring all items are accurate with what your Battle.net profile says. This will revert any edits you've made to any items equipped on this build.</li>
</ul>