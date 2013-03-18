<h3 class="section-title"><?= $section->title ?></h3>
<div class="section-content">
	<?= $section->content ?>
</div>
<div class="section-specific">
	<ul class="skill-data">
		<? foreach($section->skills as $k => $v): ?>
			<li data-id='<?= $k ?>' data-skill='<?= $v->skill ?>'>
				<div class="skill-content"><?= $v->content ?></div>
			</li>
		<? endforeach ?>
	</ul>
</div>