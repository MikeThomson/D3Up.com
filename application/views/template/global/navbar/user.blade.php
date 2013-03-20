<?
	$myBuilds = Epic_Mongo::db('build')->find(array('_createdBy' => Auth::user()->createReference()))->sort(array('paragon' => -1, 'level' => -1))->limit(5);
?>
<div class="dropdown-menu">
   <ul>
		<!-- <li class='lead'>My Builds</li> -->
		<? foreach($myBuilds as $build): ?>
		<li class='build-select'>
			<a href="/b/{{ $build->id }}">
				<img src="/img/icons/{{ $build->class }}.png" class="build-icon pull-left">
				<div class='build-name'>{{ $build->name }}</div>
				<small>
					<span class="level">{{ __('build.level') }} {{ $build->level }}</span>, {{ __('build.paragon') }} <span class="paragon">{{ $build->paragon }}</span>
				</small>
			</a>
		</li>
		<? endforeach; ?>
		<li>
			<div class='btn-group'>
				<a href="/build/create" class='btn btn-mini'>Create Build</a>
				<a href="/user/builds" class='btn btn-mini'>My Builds</a>
			</div>
		</li>
   </ul>
</div>