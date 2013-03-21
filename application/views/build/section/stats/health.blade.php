<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href=".collapseHealth">
			@if(!$isCompare)
			{{ (isset($name)) ? $name : "" }}
			@else
				{{ __('diablo.health_statistics') }}
				{{ (isset($name)) ? $name : "" }}
			@endif
    </a>
  </div>
  <div class="collapseHealth accordion-body collapse in">
    <div class="accordion-inner">

    </div>
  </div>
</div>