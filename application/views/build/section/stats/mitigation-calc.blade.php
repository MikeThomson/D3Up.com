<div class='row mitigation-controls'>
	<div class='span5'>
		<table class='table stat-table build-stats'>
			<tr>
				<td>Damage Taken</td>
				<td>
					<span id='build1-inc-hit'></span>
				</td>
			</tr>
			<tr>
				<td>VS Compared Build</td>
				<td>
					<span id='build1-inc-diff'></span>
				</td>
			</tr>
		</table>
	</div>
	<div class='span2 text-center'>
		<label for="inc-hit">Incoming Damage</label>
		<input class='input-block-level' type="text" value="200000" name="inc-hit" id="inc-hit">
		<select class='input-block-level' id="inc-hit-type">
			<option value="generic">Generic Hit</option>
			<option value="range">Ranged Hit</option>
			<option value="melee">Melee Hit</option>
			<option value="elite">Elite Hit</option>
		</select>
		<select class='input-block-level' id="inc-hit-element">
			<option value="generic">Generic Damage</option>
			<option value="arcane">Arcane/Holy Damage</option>
			<option value="cold">Cold Damage</option>
			<option value="fire">Fire Damage</option>
			<option value="lightning">Lightning Damage</option>
			<option value="physical">Physical Damage</option>
			<option value="poison">Poison Damage</option>
		</select>
	</div>
	<div class='span5'>
		<table class='table stat-table build-stats'>
			<tr>
				<td>Damage Taken</td>
				<td>
					<span id='build2-inc-hit'></span>
				</td>
			</tr>
			<tr>
				<td>VS Compared Build</td>
				<td>
					<span id='build2-inc-diff'></span>
				</td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		var damage = {}; // Storage for Damage Values
		function calcDmgTaken() {
			var value = $("#inc-hit").val(),
					type = $("#inc-hit-type").find(":selected").val(),
					element = $("#inc-hit-element").find(":selected").val();
			$.each(d3up.builds, function(name, build) {
				damage[name] = Math.round(build.calc.calcDmgTaken(build.meta.heroClass, value, type, element) * 100) / 100;
				$("#" + name + "-inc-hit").html(damage[name]);
			});
			damage['diff'] = 100 - (damage['build1'] / damage['build2'] * 100);
			if(damage['diff'] < 0) {
				damage['diff'] *= -1;
			}
			damage['diff'] = Math.round(damage['diff'] * 100) / 100;
			if(damage['build1'] < damage['build2']) {
				damage['victor'] = 'build1';
			} else {
				damage['victor'] = 'build2';
			}
			$.each(d3up.builds, function(name, build) {
				if(name == damage['victor']) {
					var ml = "<span class='pos'>less</span>";
				} else {
					var ml = "<span class='neg'>more</span>";					
				}
				$("#" + name + "-inc-diff").html("Takes " + damage['diff'] + "% " + ml + " damage");
			});
		}
		$("#inc-hit").bind('keyup', calcDmgTaken).trigger('keyup');
		$("#inc-hit-type, #inc-hit-element").bind('change', calcDmgTaken);
	});
</script>