<? if(Auth::user()->battletag && Auth::user()->region): ?>
	<p>Choose one of your characters to import.</p>
	<div>
		<select name='character-id' id="characters" data-battletag="<?= Auth::user()->battletag ?>" class="input-block-level">
			<option value=''>Select a Character...</option>
			<? if($characters): ?>
				<? foreach($characters as $k => $v): ?>
					<option data-region="<?= $v['region'] ?>" data-name="<?= $v['name'] ?>" data-hardcore="<?= $v['hardcore'] ?>" data-paragon="<?= $v['paragonLevel'] ?>" data-level="<?= $v['level'] ?>" data-class="<?= $v['class'] ?>" value='<?= $v['id'] ?>'>[<?= ($v['hardcore']) ? "HC" : "SC" ?>][<?= $v['level'] ?>] <?= $v['name']?> - <?= ucwords(str_replace("-", " ", $v['class'])) ?>
				<? endforeach ?>
			<? endif ?>
		</select>
	</div>
	<p>If no builds are found, please <a href='/user/edit'>Visit your Profile</a> and ensure your Battle Tag and Region are correct.</p>
	<p>Common problems include...</p>
	<ul>
		<li>Ensure there are no spaces in your Battle Tag.</li>
		<li>Your Battle Tag should be formatted as such: Username#1234</li>
	</ul>
<? else : ?>
	<p>You need to specify the following information before we can import characters:</p>
	<ul>
		<li>Your Battle.net BattleTag</li>
		<li>Which region you play in</li>
	</ul>
	<p>Head on over and <a href="/user/edit">edit your profile</a> to fill out this information if you wish to import your characters!</p>
<? endif ?>