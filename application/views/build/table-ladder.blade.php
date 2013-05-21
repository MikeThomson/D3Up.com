<table class='table build-table'>
<tbody>
	<tr>
		<th></th>
		<th>{{ __('build.name') }}</th>
		<th>{{ __('build.level') }}</th>
		<th>{{ __('build.paragon') }}</th>
		<th>{{ __('diablo.dps') }}</th>
		<th>{{ __('diablo.hp') }}</th>
		<th>{{ __('build.elitekills') }}</th>
		<th></th>
	</tr>
<? foreach($builds as $build): ?>
	<tr class='build-row'>
		<td class="icon"><img src="/img/icons/<?= $build->class ?>.png"/></td>
		<td class='name'><?= HTML::buildLink($build) ?></td>
		<td class="stat"><?= $build->level ?></td>
		<td class="stat"><?= $build->paragon ?></td>
		<td class="stat"><?= HTML::prettyStat($build->stats['dps']) ?></td>
		<td class="stat"><?= HTML::prettyStat($build->stats['hp']) ?></td>
		<td class="stat"><?= $build->eliteKills ?></td>
	</tr>
<? endforeach; ?>
</tbody>
</table>