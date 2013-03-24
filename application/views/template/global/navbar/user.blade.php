<?
	$myBuilds = Epic_Mongo::db('build')->find(array('_createdBy' => Auth::user()->createReference()))->sort(array('paragon' => -1, 'level' => -1))->limit(5);
?>
<div class="dropdown-menu build-selector">
	<h3>My Builds</h3>
  <ul>
	<!-- <li class='lead'>My Builds</li> -->
	<? foreach($myBuilds as $my): ?>
	<li class='{{ $my->class }}'>
		<div class="build-select">
			<a href="/b/{{ $my->id }}">
				<img src='/img/icons/barbarian.png' class='icon-frame icon-custom icon-blank pull-left'>
				<div class='build-name'>{{ $my->name }}</div>
				<small>
					<span class="level">{{ __('build.level') }} {{ $my->level }}</span>, {{ __('build.paragon') }} <span class="paragon">{{ $my->paragon }}</span>
				</small>
			</a>
		</div>
		@if(isset($build))
			<div class="build-tools" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Compare this build against the build you're viewing." title="Quick Compare">
				<a href="/c/{{ $my->id }}/{{ $build->id }}">
					<span class='icon-frame icon-custom icon-custom-tooltip'>&nbsp;</span>
				</a>
			</div>
		@endif
	</li>
	<? endforeach; ?>
	<li>
		<div class='btn-group btn-group-block'>
			<a href="/build/create" class='btn btn-mini'><i class='icon-plus icon-white'></i> Create Build</a>
			<a href="/user/builds" class='btn btn-mini'><i class='icon-th-list icon-white'></i> My Builds</a>
		</div>
	</li>
  </ul>
</div>