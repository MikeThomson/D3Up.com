@if($gear)
	<ul class='pdanalyzer'>
		<li>
			<h4>Gear Analyzer</h4>
			<select id="pdanalyzer" class='input input-block-level' multiple data-placeholder="Click an Item or start typing an affix to start analysis">
				
			</select>
		</li>
		<li>
			<ul class='pdanalyzer-results'>
			</ul>
		</li>
	</ul>
	<ul class='paperdoll'>
	@foreach($gear->getSlots() as $slot) 
		@if($gear[$slot])
			<li class="slot-{{ $slot }}">
				<a class="slot-link" href="/i/{{ $gear[$slot]->id }}" data-json="{{ e(json_encode($gear[$slot]->tooltip())) }}" data-slot="{{ $slot }}">
					<span class="d3-icon d3-icon-item d3-icon-item-{{ HTML::tooltipColor($gear[$slot]->quality) }}">
						<span class="icon-item-gradient">
							<span class="icon-item-inner"></span>
						</span>
					</span>
					<span class="image">
						@if($gear[$slot]->icon)
							<img src="http://media.blizzard.com/d3/icons/items/large/{{ $gear[$slot]->icon }}.png" alt="" />
						@endif
					</span>
					<span class="sockets-wrapper">
						<span class="sockets-align">
							@if(count($gear[$slot]->sockets))
								@foreach($gear[$slot]->sockets as $gem)
									<span class="socket">
										<img class="gem" src="http://media.blizzard.com/d3/icons/items/small/ruby_{{ HTML::getGemId($gem) }}_demonhunter_male.png" />
									</span><br />
								@endforeach
							@endif
						</span>
					</span>
				</a>
			</li>
		@endif
	@endforeach
	</ul>
@endif