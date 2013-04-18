<div id="build-header" class="title-block" data-class="{{ $build->class }}">
	<div class="title-inner">
		<h2 class="title">
			<a href="/b/{{ $build-> id }}">{{ $build->name }}</a> 
			<small>
				@if($build->level == 60)
					{{ __('build.paragon') }} {{ __('build.level') }} <span id="paragon-level">{{ $build->paragon }}</span>
				@else
					{{ __('build.level') }} <span id="character-level">60</span>
				@endif
			</small>
		</h2>
		<h5 class='meta'>
			<small>
				@if($build->hardcore)
					<span class="pos">{{ __('build.hardcore') }}</span>		
				@else
					<span class="pos">{{ __('build.softcore') }}</span>		
				@endif
				{{ __('build.'.$build->class) }} {{ __('d3up.build') }}, 
				{{ __('d3up.updated') }}: {{ date("F jS, Y", $build->_lastCrawl) }}
			</small>
		</h5>
		<div class="social">
			<!-- <div class="btn-group btn-group-vertical  pull-right">
				<a class='btn btn-small' href="http://us.battle.net/d3/en/profile/jesta-1121/hero/1107072" target="_blank" id="profile-link">
					<img class='pull-left' src="/img/battlenet.png" style="height: 20px; margin-right: 10px"> Battle.net
				</a>
				<a class='btn btn-small' href="http://us.battle.net/d3/en/profile/jesta-1121/hero/1107072" target="_blank" id="profile-link">
					<img class='pull-left' src="/img/battlenet.png" style="height: 20px; margin-right: 10px"> DiabloProgress
				</a>
			</div> -->
		</div>
		<div class="skill-row clearfix">
			@if($build->actives)
	 		<ul id="active-display" class="skill-icons" data-skill-type="actives" data-display="icon">
				<li><span class="skill-type">{{ __('build.skills') }}</span></li>
				@foreach($build->actives as $skill)
				<li>
					<span class="d3-icon d3-icon-skill d3-icon-skill-42 " style="background-image: url('http://media.blizzard.com/d3/icons/skills/42/{{ str_replace("-", "", $build->class) }}_{{ explode("~", str_replace("-", "", $skill))[0] }}.png'); width: 42px; height: 42px;">
						<span class="frame"></span>
					</span>
				</li>
				@endforeach
			</ul>
			@endif
			@if($build->passives)
	 		<ul id="passive-display" class="skill-icons passive-skills" data-skill-type="passives" data-display="icon">
				<li><span class="skill-type">{{ __('build.passives') }}</span></li>
				@foreach($build->passives as $skill)
				<li>
					<span class="passive-icon">
						<img src="http://media.blizzard.com/d3/icons/skills/42/{{ str_replace("-", "", $build->class) }}_passive_{{ explode("~", str_replace("-", "", $skill))[0] }}.png" style="width:32px; height:32px" />
					</span>					
				</li>
				@endforeach
			</ul>
			@endif
		</div>
	</div>
</div>
