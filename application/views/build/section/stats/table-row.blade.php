<tr>
	@if($id != '-compare')
	<td>{{ __('diablo.'.$stat) }}</td>
	@endif
	<td>{{ HTML::hb('stats.'.$stat) }}</td>
</tr>
