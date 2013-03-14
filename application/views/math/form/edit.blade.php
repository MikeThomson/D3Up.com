{{ Form::open('math/edit', 'POST', array('class' => 'form-math')) }}
	<!-- Pass the ID -->
	{{ Form::hidden('id', $math->id) }}
	<!-- Title field -->
	<p>{{ Form::label('title', __('math.title')) }}</p>
	<p>{{ Form::text('title', $math->_localized[$language]['title'], array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('title') ? '<div class="alert alert-error">'.__('math.invalid_title').'</div>' : '' }}
	<!-- Explanation field -->
	<p>{{ Form::label('explanation', __('math.explanation')) }}</p>
	<p>{{ Form::text('explanation', $math->_localized[$language]['explanation'], array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('explanation') ? '<div class="alert alert-error">'.__('math.invalid_explanation').'</div>' : '' }}
	<!-- Markdown field -->
	<p>{{ Form::label('content', __('math.content')) }}</p>
	<p>{{ Form::textarea('content', $math->_localized[$language]['content'], array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('content') ? '<div class="alert alert-error">'.__('math.invalid_content').'</div>' : '' }}
	@if(!isset($language))
		<!-- Which Language is this? -->
		<p>{{ Form::label('locale', __('math.locale')) }}</p>
		<p>{{ Form::select('locale', Config::get('application.languages'), array('class' => 'input-block-level')) }}</p>
	@else
		{{ Form::hidden('locale', $language) }}
	@endif
	<!-- submit button -->
	<div class='btn-group'>
		{{ Form::submit(__('math.submit'), array('class' => 'btn')) }}
	</div>
{{ Form::close() }}