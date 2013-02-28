<? if(Auth::user()->battletag && Auth::user()->region): ?>
	<p>If you wish to create a build from one of your characters, please enter it's information below.</p>
	<div>
		<select name='character-id' id="characters">
			<option value=''>Select a Character...</option>
			<? if($characters): ?>
				<? foreach($characters as $k => $v): ?>
					<option data-name="<?= $v['name'] ?>" data-hardcore="<?= $v['hardcore'] ?>" data-paragon="<?= $v['paragonLevel'] ?>" data-class="<?= $v['class'] ?>" value='<?= $v['id'] ?>'>[<?= ($v['hardcore']) ? "HC" : "SC" ?>][<?= $v['level'] ?>] <?= $v['name']?> - <?= ucwords(str_replace("-", " ", $v['class'])) ?>
				<? endforeach ?>
			<? endif ?>
		</select>
	</div>
	<p>After selecting your character, make sure to fill out the rest of the form on the left!</p>
<? else : ?>
	<p>You need to specify the following information before we can import characters:</p>
	<ul>
		<li>Your Battle.net BattleTag</li>
		<li>Which region you play in</li>
	</ul>
	<p>Head on over and <a href="/user/edit">edit your profile</a> to fill out this information if you wish to import your characters!</p>
<? endif ?>