@if($build->_characterBt && $build->_authentic)
	<span class='badge badge-success' data-placement="left" data-toggle="popover" data-title="Authentic Build" data-content="This build is a direct copy of Battle.net data obtained on {{ date('Y-m-d', $build->_lastCrawl) }} from ID #{{ $build->_characterId }} owned by {{ $build->_characterBt }}.">
		<a href='{{ $build->profileUrl }}'>{{ $build->_characterBt }}</a>
	</span>
@elseif($build->_characterBt) 
	<span class='badge' data-placement="left" data-toggle="popover" data-title="Modified Build" data-content="This build has been directly modified by the owner and will not show up in 'Authentic' build searches. Resync this build to make it authentic once again.">
		<a href='{{ $build->profileUrl }}'>{{ $build->_characterBt }} (Modified)</a>
	</span>
@else
	<span class='badge badge-warning' data-placement="left" data-toggle="popover" data-title="Custom Build" data-content="This build was created from scratch and will not show up in 'Authentic' build searches.">
		Custom Build
	</span>
@endif