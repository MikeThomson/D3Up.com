@layout('template.main')

@section('content')
<div class='row'>
	<div class='span9'>
		@if(isset($language))
			@include('math.form.edit')
		@else
		<h3>The explanation for "{{ $math->title }}" is available in:</h3>
		<p>If you'd like to edit one of the localized versions of this explanation, please click on the edit button by the corresponding language.</p>
		<table class='table'>
			@foreach(Config::get('application.languages') as $k => $v) 
			<tr>
				<td>{{ $v }} ({{ $k }})</td>
				<td>
					@if(isset($math->_localized[$k]))
						<span class='label label-success pos'><i class="icon-ok"></i>&nbsp;&nbsp;Available</span>
					@else
						<span class='label label-important neg'><i class="icon-remove"></i>&nbsp;&nbsp;Not Available</span>
					@endif
				</td>
				<td>
					<a href='/math/{{ $math->id }}/edit?language={{ $k }}' class='btn'>Edit for {{ $v }}</a>
				</td>
			</tr>
			@endforeach
		</table>
		@endif
	</div>
	<div class='span3'>
		
	</div>
</div>
@endsection