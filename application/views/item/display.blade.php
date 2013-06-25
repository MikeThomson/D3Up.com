<div class='d3-tooltip'>
	<div class='top quality-{{ $item->quality }}'>
		<p class='quality-{{ $item->quality }}'>{{ $item->name }}</p>
	</div>
	<div class='item'>
		<div class='wrapper'>
			<div class='item-icon item-quality-{{ $item->quality }}'>
				<img src='http://media.blizzard.com/d3/icons/items/large/{{ $item->icon }}.png'>
			</div>
			<p class='item-type'>
				<span class='quality'>{{ D3Up_Attributes::$quality[$item->quality] }}</span>
				<span class='type'>{{ D3Up_Attributes::$itemTypes[$item->type] }}</span>
			</p>
			<p class='stats stats-primary'>
			@if($item->stats['armor'])
				<span class='big-stat'>{{ $item->stats['armor'] }}</span>
				<span class='stat-helper'>Armor</span>
			@elseif($item->stats['dps'])
				<span class='big-stat'>{{ round($item->stats['dps'], 2) }}</span>
				<span class='stat-helper'>Damage per Second</span>
			@endif
			</p>
			<p class='stats stats-extra-percent'>
			@if($item->stats['speed'])
				<span>{{ round($item->stats['speed'], 2) }}</span>
				<span class='stat-helper'>Attacks per Second</span>
			@elseif($item->stats['block-chance'])
				<span>{{ $item->stats['block-chance']}}</span>
				<span class='stat-helper'>Chance to Block</span>
			@endif
			</p>
			<p class='stats stats-extra-range'>
			@if($item->stats['damage'])
				<span>
					{{ $item->stats['damage']['min'] }} - {{ $item->stats['damage']['max'] }} 
				</span>
				<span class='stat-helper'>Damage</span>
			@elseif($item->stats['block-amount'])
				<span>
					{{ $item->stats['block-amount']['min'] }} - {{ $item->stats['block-amount']['max'] }} 
				</span>
				<span class='stat-helper'>Block Amount</span>
			@endif			
			</p>
			<ul class='attrs'>
			@foreach($item->attrs as $attr => $value)
				<li>
					{{ D3Up_Attributes::attr($attr, $value) }}
				</li>
			@endforeach
			</ul>
			<ul class='sockets'>
			@foreach($item->sockets as $socket => $gem)
				<li class='gem_{{ $gem }}'>{{ D3Up_Gems::effect($item, $gem) }}</li>
			@endforeach
			</ul>
			<div class='setBonus quality-7'>
			</div>
		</div>
	</div>
	<div class='bottom'>
	</div>
</div>