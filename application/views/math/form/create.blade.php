@include('math.breadcrumb')
<h1>Create an Diablo 3 Math Entry</h1>
<h5 class='lead'>Share what you know about Diablo 3's math. Please avoid creating duplicates and use the search feature to see if one already exists!</h5>
<div class='content'>
{{ Form::open('math/create', 'POST', array('class' => 'form-math')) }}
	<!-- Title field -->
	<p>{{ Form::label('title', __('math.title')) }}</p>
	<p>{{ Form::text('title', Input::old('title'), array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('title') ? '<div class="alert alert-error">'.__('math.invalid_title').'</div>' : '' }}
	<!-- Explanation field -->
	<p>{{ Form::label('explanation', __('math.explanation')) }}</p>
	<p>{{ Form::text('explanation', Input::old('explanation'), array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('explanation') ? '<div class="alert alert-error">'.__('math.invalid_explanation').'</div>' : '' }}
	<!-- Markdown field -->
	<p>{{ Form::label('content', __('math.content')) }}</p>
	<p>{{ Form::textarea('content', Input::old('content'), array('class' => 'input-block-level')) }}</p>
	{{ $errors->has('content') ? '<div class="alert alert-error">'.__('math.invalid_content').'</div>' : '' }}
	<!-- Which Language is this? -->
	<p>{{ Form::label('locale', __('math.locale')) }}</p>
	<p>{{ Form::select('locale', Config::get('application.languages'), array('class' => 'input-block-level')) }}</p>
	<!-- submit button -->
	<div class='btn-group'>
		{{ Form::submit(__('math.submit'), array('class' => 'btn')) }}
	</div>
{{ Form::close() }}
</div>