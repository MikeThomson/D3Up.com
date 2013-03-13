{{ Form::open('math/create', 'POST', array('class' => 'form-math')) }}
	<!-- Title field -->
	<p>{{ Form::label('title', __('math.title')) }}</p>
	<p>{{ Form::text('title', false, array('class' => 'input-block-level')) }}</p>
	<!-- Explanation field -->
	<p>{{ Form::label('explanation', __('math.explanation')) }}</p>
	<p>{{ Form::text('explanation', false, array('class' => 'input-block-level')) }}</p>
	<!-- Markdown field -->
	<p>{{ Form::label('content', __('math.content')) }}</p>
	<p>{{ Form::textarea('content', false, array('class' => 'input-block-level')) }}</p>
	<!-- Which Language is this? -->
	<p>{{ Form::label('locale', __('math.locale')) }}</p>
	<p>{{ Form::select('locale', Config::get('application.languages'), array('class' => 'input-block-level')) }}</p>
	@foreach(Config::get('application.languages') as $lang)
		<li>
			<a href="/locale/{{ $lang }}">
				<img src="/img/locale/{{ $lang }}.png"> {{ $lang }}
			</a>
		</li>
	@endforeach
	<!-- submit button -->
	@if (Session::has('form_errors'))

	@endif
	<div class='btn-group'>
		{{ Form::submit(__('math.submit'), array('class' => 'btn')) }}
	</div>
{{ Form::close() }}