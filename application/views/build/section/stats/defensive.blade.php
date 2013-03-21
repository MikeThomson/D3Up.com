<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href=".collapseDefensive">
			@if(!$isCompare)
			{{ (isset($name)) ? $name : "" }}
			@else
				{{ __('diablo.defensive_statistics') }}
				{{ (isset($name)) ? $name : "" }}
			@endif
    </a>
  </div>
  <div class="collapseDefensive accordion-body collapse in">
    <div class="accordion-inner">

    </div>
  </div>
</div>