<div id="import-find">
	{{ Form::label('region', __('build.region')) }}
	{{ Form::select('region', array('1' => 'The Americas', '2' => 'Europe', '3' => 'Asia'), null, array('class' => 'input-block-level', 'id' => 'region')) }}

	{{ Form::label('battletag', __('build.battletag')) }}
	{{ Form::text('battletag', false, array('class' => 'input-block-level', 'id' => 'battle-tag'))}}
	<div style="text-align: center; padding: 10px">
		<a class='btn' id="search-battle-tag">Find my Characters</a>
	</div>
</div>
<div id="import-character">
	<p>Characters found:</p>
	{{ Form::select('character-id-manual', array(null => 'Loading'), null, array('class' => 'input-block-level', 'id' => 'characters-manual')) }}
	<p>By selecting a character, it will fill out all of the information in Step #2.</p>
	<div style="text-align: center; padding: 10px">
		<a class='btn' id="repeat-search">Search Again?</a>
	</div>
</div>
