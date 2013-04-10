<div class='row'>
	<div class='span5'>
		<table class='table stat-table build-stats'>
			<tr>
				<td><h4>Damage Taken</h4></td>
				<td><h4 id='build1-inc-hit'></h4></td>
			</tr>
		</table>
	</div>
	<div class='span2 text-center'>
		<label for="inc-hit">Incoming Hit</label>
		<input class='input-small' type="text" value="200000" name="inc-hit" id="inc-hit">
	</div>
	<div class='span5'>
		<table class='table stat-table build-stats'>
			<tr>
				<td><h4>Damage Taken</h4></td>
				<td><h4 id='build2-inc-hit'></h4></td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(function() {
		var input = $("#inc-hit");
		input.bind('keyup', function() {
			var value = $(this).val();
			$.each(d3up.builds, function(name, build) {
				var damage = Math.round(build.calc.calcDmgTaken(value) * 100) / 100;
				$("#" + name + "-inc-hit").html(damage);
			});
		});
		input.trigger('keyup');
	});
</script>