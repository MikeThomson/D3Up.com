@section('content')
<link rel="stylesheet" href="/css/jquery.cleditor.css" type="text/css" />
<?
	$isOwner = false;
	// $profile = Epic_Auth::getInstance()->getProfile();
	// $isOwner = ($profile && $guide->author->id === $profile->id);
	// $headTitle($guide->title); 
	// if($guide->class) {
	// 	$headTitle(ucwords(str_replace("-", " ", $guide->class)) . " Guide"); 		
	// }
?>
<? if($isOwner): ?>
<div id="toolbar">
	<div id="guide-owner">
		<div class="controls" style="text-align: right; padding: 5px">
			<p>
				Status: <span id="save-status" class="true">Saved</span><br/>Published: <span id="publish-status" class="<?= ($guide->published) ? 'true' : 'false' ?>"><?= ($guide->published) ? 'Yes' : 'No' ?></span>
			</p>
		</div>
		<h2>Guide Owner Tools</h2>
		<div class="control">
			<a class="createSection ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">Create Section</a>
			<? if($guide->published): ?>
				<a href="/guide/<?= $guide->id ?>/<?= $guide->slug ?>/unpublish" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">Unpublish</a>
			<? else: ?>
				<a href="/guide/<?= $guide->id ?>/<?= $guide->slug ?>/publish" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">Publish</a>
			<? endif ?>
			<a href="/guide/<?= $guide->id ?>/<?= $guide->slug ?>/edit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">Edit Title</a>
			<a class="saveGuide ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">Save</a>
			<a href="/guide/<?= $guide->id ?>/<?= $guide->slug ?>/" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">Cancel</a>
			<a href="/guide/<?= $guide->id ?>/<?= $guide->slug ?>/revisions" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">Revisions</a>
		</div>
		<div class="sub-control">
			<a href="#" id="minAll">Minimize All Sections</a>
		</div>
	</div>
</div>
<form method="post" id="guide-form">
<? endif ?>
	<div id="guide" class="guide-block" data-class="{{ $guide->class }}">
		<div class="guide-block-inner">
			<div class="row">
				<div class="span9">
					<h1 class="title">
						<?= $guide->title ?>
					</h1>
					<h4 class="meta">
						<small>
							Created by <span class='author'>
								<a href="/user/{{ $guide->author->username }}"><?= $guide->author->username ?></a>
							</span>
							on 
							<span class='date'>
								<?= date('F j, Y', $guide->_created) ?>
							</span>
						</small>
					</h4>
					<? if($guide->_updated): ?>
						<h4 class="meta">
							<small>Last Updated: <span class='date'><?= date('F j, Y', $guide->_updated) ?></span></small>
						</h4>
					<? endif ?>
				</div>
				<div class="span3">
					<div class="btn-group btn-group-vertical  pull-right">
						<div id="social-share">
							<script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"></script>
						</div>
						<div id="ratings-display">
							<div class='item-stat inline-flow'>
								<span class='value'><?= HTML::prettyStat($guide->views) ?></span>
								<span class='stat'>Views</span>
							</div>
							<img id="button-upvote" src="/images/upvote.png" class="ui-state-disabled ui-corner-all" data-name="Guide Voting	" data-tooltip="In order to record your vote, we require to to be logged in. Please login or create an account!">
							<div class='item-stat inline-flow'>
								<span class='value' id="vote-count" data-count="<?= $guide->votes ?: 0 ?>"><?= $guide->votes ?: 0 ?></span>
								<span class='stat'>Votes</span>
							</div>
							<img id="button-downvote" src="/images/downvote.png" class="ui-state-disabled ui-corner-all" data-name="Guide Voting	" data-tooltip="In order to record your vote, we require to to be logged in. Please login or create an account!">
						</div>
					</div>
				</div>
			</div>
			<div class='guide-content'>
				<div class="toc section">
					<h3>Contents of this Guide</h3>
					<ul id="toc" class="contents <?= $guide->class ?>">
						<? if($guide->sections): ?>
							<? foreach($guide->sections as $key => $section): ?>
								<li data-section="<?= $key ?>"><a href="#section-<?= $key ?>-anchor"><?= $section->title ?></a></li>
							<? endforeach ?>
							<li data-section="guide-comments"><a href="#section-comments-anchor">Comments</a></li>
						<? else: ?>
							<li>This guide has no content yet!</li>
						<? endif ?>
					</ul>
				</div>
				<div class="content">
					<? if($guide->sections): ?>
						<? foreach($guide->sections as $key => $section): ?>
							<? if(!$section->hidden || $isOwner): ?>
							<span id="section-<?= $key ?>-anchor" class="guide-anchor"></span>
							<div id="section-<?= $key ?>" class="section" data-section="<?= $key ?>" data-section-type="<?= $section->type ?: 'generic' ?>" data-hidden="<?= $section->hidden ?>">
								@include("guide.sections.".($section->type?:'generic'))
							</div>
							<? endif ?>
						<? endforeach ?>
					<? endif ?>
					<span id="section-comments-anchor" class="guide-anchor"></span>
					<div id="section-comments" class="section">
						@include("guide.sections.comments")
					</div>
				</div>
			</div>
		</div>
	</div>
	<? if($isOwner): ?>
</form>
<? endif ?>

<script type="text/javascript" src="/js/jquery.cleditor.js"></script>
<script type="text/javascript" src="/js/unmin/guide.js?v=<?= time() ?>"></script>
@endsection