<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href=".collapseResistance">
			@if(!$isCompare)
			{{ (isset($name)) ? $name : "" }}
			@else
				{{ __('diablo.resistance_statistics') }}
				{{ (isset($name)) ? $name : "" }}
			@endif
    </a>
  </div>
  <div class="collapseResistance accordion-body collapse">
    <div class="accordion-inner">

    </div>
  </div>
</div>