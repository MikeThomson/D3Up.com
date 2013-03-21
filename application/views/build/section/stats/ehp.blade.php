<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href=".collapseEHP">
			@if(!$isCompare)
			{{ (isset($name)) ? $name : "" }}
			@else
				{{ __('diablo.ehp_statistics') }}
				{{ (isset($name)) ? $name : "" }}
			@endif
    </a>
  </div>
  <div class="collapseEHP accordion-body collapse">
    <div class="accordion-inner">

    </div>
  </div>
</div>