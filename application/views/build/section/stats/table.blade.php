<div class="accordion-group">
	@if($tabName)
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href=".collapse-{{ $tabName }}">
			@if($isCompare)
				{{ (isset($name)) ? $name : "" }}
			@else
				{{ __('diablo.'.$tabName.'_statistics') }}
				{{ (isset($name)) ? $name : "" }}
			@endif				
    </a>
  </div>
	@endif
  <div class="collapse-{{ $tabName }} accordion-body {{ (!$id && in_array($tabName, $collapse)) ? 'collapse' : 'in' }}">
    <div class="accordion-inner">
			<table class='table stat-table'>
				@foreach($stats as $stat)
				<tr data-toggle="disabled-popover" data-placement="top" data-trigger="hover" data-content="{{ __('diablo.explained.'.$stat) }}" title="{{ __('diablo.'.$stat) }}">
					@if($id != 'compare')
					<td>{{ __('diablo.'.$stat) }}</td>
					@endif
					<td>
						<div class="stat-container">
							{{ HTML::hb('#if_gt victor.'.$stat.' compare=0') }}<span class='victor-{{ HTML::hb('victor.'.$stat) }}'></span>{{ HTML::hb('/if_gt') }}
							@if($id == 'compare')
								{{ HTML::hb('#if_gt stats.'.$stat.' compare=0') }}+{{ HTML::hb('/if_gt') }}
							@endif
							{{ HTML::hb('prettyStat stats.'.$stat.' "'.$stat.'"') }}
						</div>
					</td>
				</tr>
				@endforeach
			</table>
    </div>
  </div>
</div>
