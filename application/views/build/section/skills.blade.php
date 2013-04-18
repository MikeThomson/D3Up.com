<ul class="nav nav-pills">
  <li class='active'><a href="#skills-overview" data-toggle="tab">Overview</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active">
		<script id="skill-overview" type="text/x-handlebars-template">
			<table class='skills table'>
				{{ HTML::hb('#each skills.actives') }}
					<tr class='skill clearfix' data-skill='{{ HTML::hb('@key') }}'>
						<td>
							<span class="d3-icon d3-icon-skill d3-icon-skill-42 " style="background-image: url('http://media.blizzard.com/d3/icons/skills/42/{{ HTML::hb('skillName ../meta.heroClass') }}_{{ HTML::hb('skillName @key') }}.png'); width: 42px; height: 42px;">
								<span class="frame"></span>
							</span>
						</td>
						<td class='skill-name'>
							{{ HTML::hb('passiveInfo @key ../meta.heroClass') }}
						</td>
						<td>
							<strong>999k</strong>
							DPS
						</td>
						<td class='enable'>
							<input type="checkbox" id="enable"><label for="enable">Enable</label>
						</td>
					</tr>
					<tr class='skill-extra clearfix' data-skill='{{ HTML::hb('@key') }}'>
						<td colspan='4'>
							<table class='skill-breakdown table'>
								<tr>
									<th>Damage</th>
									<th>Meta</th>
									<th>Resource</th>
									<th>Extra</th>
								</tr>
								<tr>
									<td>
										<dl class="dl-horizontal">
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
										</dl>
									</td>
									<td>
										<dl class="dl-horizontal">
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
										</dl>
									</td>
									<td>
										<dl class="dl-horizontal">
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
										</dl>
									</td>
									<td>
										<dl class="dl-horizontal">
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
											<dt>test</dt>
											<dd>xxx</dd>
										</dl>
									</td>

								</tr>
							</table>
						</td>
					</tr>
				{{ HTML::hb('/each') }}
				{{ HTML::hb('#each skills.passives') }}
				<tr class='skill clearfix' data-skill='{{ HTML::hb('@key') }}'>
					<td>
						<div class='skill-icon icon-frame'>
							<img src='/img/icons/{{ HTML::hb('../meta.heroClass') }}-{{ HTML::hb('skillName @key') }}.png'>
						</div>
					</td>
					<td class='skill-details'>
						{{ HTML::hb('passiveInfo @key ../meta.heroClass') }}
					</td>
				</tr>
				{{ HTML::hb('/each') }}
			</table>
		</script>
  </div>
</div>