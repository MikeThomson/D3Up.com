@if(empty($characters[1]) && empty($characters[2]) && empty($characters[3]))
<div class='alert alert-danger'>
	<h3><strong>ERROR</strong>: No characters found with this BattleTag on D3Up.com OR Battle.net!</h3>
	<p>Double check and make sure you entered the battletag properly.</p>
	<p> We scoured through the D3Up.com database as well as the Battle.net API (all regions) and could not find a match.</p>
</div>
@else
<div class='alert alert-warning'>
	<h3><strong>WARNING</strong>: No builds found with this BattleTag on D3Up.com!</h3>
	<p>D3Up has no record of this BattleTag, so we've scanned Battle.net for the Battletag, and below are the results organized by the region they are from. If you'd like to create a build with one of these characters, hit the 'Create Build' button next to it to get started!</p>
</div>
<div class="tabbable"> <!-- Only required for left/right tabs -->
	<ul class="nav nav-tabs">
		@foreach($characters as $region => $data) 
			@if(!empty($data))
	  	<li {{ ($region == '1') ? "class='active'" : "" }}><a href="#tab-region-{{ $region }}" data-toggle="tab">{{ HTML::regionHelper($region) }}</a></li>
			@endif
		@endforeach
	</ul>
	<div class="tab-content">
		@foreach($characters as $region => $data) 
			@if(!empty($data))
		  <div class="tab-pane {{ ($region == '1') ? "active" : "" }} " id="tab-region-{{ $region }}">
				<table class='table build-table'>
					<tbody>
						<tr>
							<th></th>
							<th class="views">SC/HC</th>
							<th>Level</th>
							<th>Paragon</th>
							<th>Name</th>
							<th></th>
						</tr>
					<? foreach($data as $build): ?>
						<tr class='build-row'>
							<td class="icon"><img src="/img/icons/<?= $build['class'] ?>.png"/></td>
							<td><?= ($build['hardcore']) ? "<span class='neg' title='Hardcore'>HC</span>" : "<span class='pos' title='Softcore'>SC</span>" ?> </td>
							<td class="stat"><?= $build['level'] ?></td>
							<td class="stat"><?= $build['paragonLevel'] ?></td>
							<td class='name'><?= $build['name'] ?></td>
							<?
							$queryString = "character-bt=".str_replace("#", "-", Request::get('battletag'));
							$queryString .= "&character-rg=".$region;
							$queryString .= "&character-id=".$build['id'];
							$queryString .= "&name=".$build['name'];
							$queryString .= "&class=".$build['class'];
							$queryString .= "&hardcore=".(($build['hardcore'] == 1) ? 'true' : 'false');
							$queryString .= "&level=".$build['level'];
							$queryString .= "&paragon=".$build['paragonLevel'];
							?>
							<td><a href="/build/create?{{ $queryString }}" class='btn'>Create Build</a></td>
						</tr>
					<? endforeach; ?>
					</tbody>
				</table>
			</div>
			@endif
		@endforeach
	</div>
</div>
@endif
