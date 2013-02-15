<div id="build-header" class="title-block" data-class="barbarian">
	<div class="title-inner">
		<div class="row">
			<div class="span9">
				<h2 class="title">
					<a href="/b/{{ $build-> id }}"><?= $build->name ?></a> 
					<small>
						@if($build->level == 60)
							{{ __('build.paragon') }} {{ __('build.level') }} <span id="paragon-level">{{ $build->paragon }}</span>
						@else
							Level <span id="character-level">60</span>
						@endif
					</small>
				</h2>
				<h5 class='meta'>
					<small>
						@if($build->hardcore)
							<span class="pos">Softcore</span>		
						@else
							<span class="pos">Softcore</span>		
						@endif
						{{ __('build.'.$build->class) }} {{ __('d3up.build') }}, 
						{{ __('d3up.updated') }}: {{ date("F jS, Y", $build->_lastCrawl) }}
					</small>
				</h5>
			</div>
			<div class="span3">
				<div class="btn-group btn-group-vertical  pull-right">
					<a class='btn btn-small' href="http://us.battle.net/d3/en/profile/jesta-1121/hero/1107072" target="_blank" id="profile-link">
						<img class='pull-left' src="/img/battlenet.png" style="height: 20px; margin-right: 10px"> Battle.net
					</a>
					<a class='btn btn-small' href="http://us.battle.net/d3/en/profile/jesta-1121/hero/1107072" target="_blank" id="profile-link">
						<img class='pull-left' src="/img/battlenet.png" style="height: 20px; margin-right: 10px"> DiabloProgress
					</a>
				</div>
			</div>
		</div>
		<div class="row skill-bar">
			<div class="span5">
	  		<ul id="active-display" class="skill-icons pull-right" data-skill-type="actives" data-display="icon">
					<li><span class="skill-type">{{ __('build.skills') }}</span></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
				</ul>
			</div>
			<div class="span3">
	  		<ul id="active-display" class="skill-icons" data-skill-type="actives" data-display="icon">
					<li><span class="skill-type">{{ __('build.passives') }}</span></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
					<li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png"></li>
				</ul>
		  </div>
		</div>
		<!-- <div id="skill-display" class="ui-widget ui-corner-all ui-helper-clearfix">
			<div id="ratings-display">
				<div class="item-stat inline-flow">
					<span class="value">5.33k</span>
					<span class="stat">Views</span>
				</div>
				<img id="button-upvote" src="/img/upvote.png" class="ui-state-disabled ui-corner-all" data-name="Build Voting	" data-tooltip="In order to record your vote, we require to to be logged in. Please login or create an account!">
				<div class="item-stat inline-flow">
					<span class="value" id="vote-count" data-count="0">0</span>
					<span class="stat">Votes</span>
				</div>
				<img id="button-downvote" src="/img/downvote.png" class="ui-state-disabled ui-corner-all" data-name="Build Voting	" data-tooltip="In order to record your vote, we require to to be logged in. Please login or create an account!">
			</div>
			<div class="active-container inline-flow">
	  		<h3 class="inline-flow">Skills</h3>
	  		<ul id="active-display" data-skill-type="actives" data-display="icon"><li><img class="skill-icon activatable" src="/img/icons/barbarian-frenzy.png" data-tooltip="Swing for 110% weapon damage. Frenzy attack speed increases by 15% with each swing. This effect can stack up to 5 times for a total bonus of 75% attack speed.&lt;br/&gt;&lt;br/&gt;Each Frenzy effect also increases your damage by 4%." data-name="Frenzy - Maniac" data-skill="frenzy~a"></li><li><img class="skill-icon activatable" src="/img/icons/barbarian-wrath-of-the-berserker.png" data-tooltip="Enter a berserker rage which raises several attributes for 15 seconds.&lt;br/&gt;&lt;br/&gt;&lt;ul&gt;&lt;li&gt;Critical Hit Chance: 10%&lt;/li&gt;&lt;li&gt;Attack Speed: 25%&lt;/li&gt;&lt;li&gt;Dodge Chance: 20%&lt;/li&gt;&lt;li&gt;Movement Speed: 20%&lt;/li&gt;&lt;/ul&gt;&lt;br/&gt;&lt;br/&gt;Every 25 Fury gained while Wrath of the Berserker is active adds 1 second to the duration of the effect." data-name="Wrath of the Berserker - Thrive on Chaos" data-skill="wrath-of-the-berserker~d"></li><li><img class="skill-icon activatable" src="/img/icons/barbarian-battle-rage.png" data-tooltip="Enter a rage which increases damage by 15% and Critical Hit Chance by 3% for 120 seconds.&lt;br/&gt;&lt;br/&gt;While under the effects of Battle Rage, Critical Hits have a chance to generate 15 additional Fury." data-name="Battle Rage - Into the Fray" data-skill="battle-rage~d"></li><li><img class="skill-icon" src="/img/icons/barbarian-furious-charge.png" data-tooltip="Rush forward knocking back enemies and inflicting 195% weapon damage to enemies along the path of the charge.&lt;br/&gt;&lt;br/&gt;Generate 8 additional Fury for each target hit while charging." data-name="Furious Charge - Stamina" data-skill="furious-charge~d"></li><li><img class="skill-icon" src="/img/icons/barbarian-ground-stomp.png" data-tooltip="Smash the ground, stunning all enemies within 12 yards for 4 seconds.&lt;br/&gt;&lt;br/&gt;Increase Fury gained to 30." data-name="Ground Stomp - Foot of the Mountain" data-skill="ground-stomp~d"></li></ul>
	  	</div>
			<div class="passive-container inline-flow">
	  		<h3 class="inline-flow">Passives</h3>
	  		<ul id="passive-display" data-skill-type="passives" data-display="icon"><li><img class="skill-icon" src="/img/icons/barbarian-ruthless.png" data-tooltip="Critical Hit Chance increased by &lt;span class=&quot;skill-highlight&quot;&gt;5%&lt;/span&gt;. Critical Hit Damage increased by &lt;span class=&quot;skill-highlight&quot;&gt;50%&lt;/span&gt;." data-skill="ruthless" data-name="Ruthless"></li><li><img class="skill-icon" src="/img/icons/barbarian-weapons-master.png" data-tooltip="Gain a bonus based on the weapon type of your main hand weapon:&lt;ul&gt;&lt;li&gt;Swords/Daggers: &lt;span class=&quot;skill-highlight&quot;&gt;15%&lt;/span&gt; increased damage&lt;/li&gt;&lt;li&gt;Maces/Axes: &lt;span class=&quot;skill-highlight&quot;&gt;10%&lt;/span&gt; Critical Hit Chance&lt;/li&gt;&lt;li&gt;Polearms/Spears: &lt;span class=&quot;skill-highlight&quot;&gt;10%&lt;/span&gt; attack speed&lt;/li&gt;&lt;li&gt;Mighty Weapons: &lt;span class=&quot;skill-highlight&quot;&gt;3&lt;/span&gt; Fury per hit&lt;/li&gt;&lt;/ul&gt;" data-skill="weapons-master" data-name="Weapons Master"></li><li><img class="skill-icon" src="/img/icons/barbarian-no-escape.png" data-tooltip="Increases the damage of Ancient Spear and Weapon Throw by &lt;span class=&quot;skill-highlight&quot;&gt;10%&lt;/span&gt;. In addition, a Critical Hit with Ancient Spear resets the cooldown while Critical Hits with Weapon Throw have a chance to return &lt;span class=&quot;skill-highlight&quot;&gt;14&lt;/span&gt; Fury." data-skill="no-escape" data-name="No Escape"></li></ul>
	  	</div>
		</div> -->
	</div>
</div>
