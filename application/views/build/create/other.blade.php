<div id="import-find">
	<p>If you'd like to automatically import a character, fill out the information below to find your character!</p>
	<dt>Region</dt>
	<dd>
		<select name='region' id='region'>
			<option value='1'>The Americas</option>
			<option value='2'>Europe</option>
			<option value='3'>Asia</option>
		</select>
	</dd>
	<dt>Battle Tag</dt>
	<dd>
	  <input name='battletag' type='text' id="battle-tag">
	  <br/>(example: Username#1234 - No spaces)
	</dd>
	<div style="text-align: center; padding: 10px">
		<button id="search-battle-tag">Find my Characters</button>
	</div>
</div>
<div id="import-character">
	<h4>Characters</h4>
	<p>Please select which character to import into this build.</p>
	<div>
		<select name='character-id-manual' id="characters-manual">
			<option value="">Loading ...</option>
		</select>
	</div>
	<p>After choosing the character, make sure to fill out the information on the left and click submit!</p>
	<div style="text-align: center; padding: 10px">
		<button id="repeat-search">Back to Search</button>
	</div>
</div>
