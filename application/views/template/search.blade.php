<div class='row'>
	<div class='column_8 offset_2 padding-5 text center'>
		<form id="btsearch" action="/build">
	    <input type="text" class="search-query text large center block" style="width: 100%" id="battletag-display" placeholder="{{ __('d3up.search_by_battletag') }}">
      <input type="hidden" name="filter" id="battletag" value="{{ Request::get('battletag') }}">
    </form>
	</div>	
</div>
