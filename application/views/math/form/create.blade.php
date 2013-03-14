{{ Form::open('math/create', 'POST', array('class' => 'form-math')) }}
	<!-- Title field -->
	<p>{{ Form::label('title', __('math.title')) }}</p>
	<p>{{ Form::text('title', false, array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('title') ? '<div class="alert alert-error">'.__('math.invalid_title').'</div>' : '' }}
	<!-- Explanation field -->
	<p>{{ Form::label('explanation', __('math.explanation')) }}</p>
	<p>{{ Form::text('explanation', false, array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('explanation') ? '<div class="alert alert-error">'.__('math.invalid_explanation').'</div>' : '' }}
	<!-- Markdown field -->
	<p>{{ Form::label('content', __('math.content')) }}</p>
	<p>{{ Form::textarea('content', false, array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('content') ? '<div class="alert alert-error">'.__('math.invalid_content').'</div>' : '' }}
	<!-- Which Language is this? -->
	<p>{{ Form::label('locale', __('math.locale')) }}</p>
	<p>{{ Form::select('locale', Config::get('application.languages'), array('class' => 'input-block-level')) }}</p>
	<!-- submit button -->
	<div class='btn-group'>
		{{ Form::submit(__('math.submit'), array('class' => 'btn')) }}
	</div>
{{ Form::close() }}