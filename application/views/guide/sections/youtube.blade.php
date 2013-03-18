<h3 class="section-title"><?= $section->title ?></h3>
<? 
	parse_str( parse_url( $section->youtube, PHP_URL_QUERY ), $params );
	$id = $params['v'];
?>
<div class="section-specific youtube-video">
	<? if($section->youtube && $section->youtube != ""): ?>
		<iframe data-youtube="<?= $section->youtube ?>" width="534" height="300" src="http://www.youtube.com/embed/<?= $id ?>" frameborder="0" allowfullscreen></iframe>
	<? endif ?>
</div>
<div class="section-content">
	<?= $section->content ?>
</div>