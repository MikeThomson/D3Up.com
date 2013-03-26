@if($gear)
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
						<img src="http://media.blizzard.com/d3/icons/items/large/{{ $gear[$slot]->icon }}.png" alt="" />
					</span>
					<!-- <span class="sockets-wrapper">
						<span class="sockets-align">
							<span class="socket">
								<img class="gem" src="http://media.blizzard.com/d3/icons/items/small/ruby_14_demonhunter_male.png" />
							</span><br />
						</span>
					</span> -->
				</a>
			</li>
		@endif
	@endforeach
	</ul>
@endif