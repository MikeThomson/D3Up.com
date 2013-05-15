@section('content')
<a
 href="http://us.battle.net/d3/en/item/CkMIh-n87gMSBwgEFc74yBUdyOa6ah3cEpQsHaCBE64dVCDKrh0pEnPgIgsIABXBRAMAGBogCjAJOOcEQABIBlAOYOcEGJzjx9wCUAJYAA" onclick="return false">
 MY ITEM
</a>

<script src="http://us.battle.net/d3/static/js/tooltips.js"></script>
<script>

</script>
<div id="diff">
	<h3>Barbarian</h3>
	<table id="diff-barbarian">asdf</table>
	<h3>Demon Hunter</h3>
	<table id="diff-demon-hunter"></table>
	<h3>Monk</h3>
	<table id="diff-monk"></table>
	<h3>Witch Doctor</h3>
	<table id="diff-witch-doctor"></table>
	<h3>Wizard</h3>
	<table id="diff-wizard"></table>
</div>
<script src="/js/d3up.js"></script>
<script src="/js/underscore.js"></script>
<script src="/js/game/data-106.js"></script>
<script src="/js/game/data.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function() {
		function skillDiff(heroClass, type, slug, diff) {
			var tr = $("<tr>")
					oldTd = $("<td>"),
					newTd = $("<td>"),
					diffTd = $("<td>"),
					oldData = d3up[version],
					newData = d3up['gameData'];
			oldTd.html(oldData[type][heroClass][slug].name);
			newTd.html(newData[type][heroClass][slug].name);
			diffTd.html(diff[type][heroClass][slug]);
			// console.log(diff);
			return tr.append(diffTd, oldTd, newTd);
		}
		var version = 'v106' + 'gameData';
				diff = difference(d3up[version], d3up.gameData),
				diffs = $.diff(d3up[version], d3up.gameData),
				container = $("#diff");
		// console.log(diff, diffs);
		_.each(['barbarian', 'demon-hunter', 'monk', 'witch-doctor', 'wizard'], function(heroClass) {
			var target = container.find("#diff-" + heroClass).empty();
			// Parse through Active Skill changes
			_.each(diff.actives[heroClass], function(data, slug) {
				target.append(skillDiff(heroClass, 'actives', slug, diff));
			});
			// Parse through Passive Skill changes
			_.each(diff.passives[heroClass], function(slug, data) {
				target.append(skillDiff(heroClass, 'passives', slug, diff));
			});
			// If the target didn't recieve any updates, there's no changes.
			if(target.html() == "") {
				target.append($("<li>").html("No Changes"));
			}
		});
		// console.log(diff);
	});
</script>

@endsection