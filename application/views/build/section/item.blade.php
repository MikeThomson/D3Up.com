<div class="tab-pane item-detail" id="tab-item-{{$item->id}}">
	<ul class="breadcrumb">
	  <li><a class='return-home' href="#">Items</a> <span class="divider">/</span></li>
	  <li>{{ HTML::itemLink($item) }}</li>
	</ul>
	<img src="http://placehold.it/500x400&text=Item Tooltip">
	<h2>{{$item->name}}</h2>
	<img src="http://placehold.it/500x100&text=Item Ratings">
	<p>The following actions can be taken here:</p>
	<ul>
		<li>Simulate Item Stats</li>
		<li>Compare to a different item</li>
		<li>Edit the Item (and Save)</li>
	</ul>
</div>
