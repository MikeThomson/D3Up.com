@if(!$user->battletag || !$user->region)
	<div class='alert'>
		<h3>Missing Battle.net Information</h3>
		<p>If you'd like to be able to quickly create builds for your characters, please correct the following information.</p>
		{{ Form::open('/user/edit', 'post') }}
		@if(!$user->battletag)
			{{ Form::label('battletag', __('build.battletag')) }}
			{{ Form::text('battletag', false) }}
			{{ $errors->has('battletag') ? '<div class="alert alert-error">'.$errors->first('battletag').'</div>' : '' }}
		@endif
		@if(!$user->region)
			{{ Form::label('region', __('build.region')) }}
			{{ Form::select('region', array('1' => 'The Americas', '2' => 'Europe', '3' => 'Asia'), null) }}
		@endif
		<p>{{ Form::submit(__('build.save'), array('class' => 'btn')) }}</p>
		{{ Form::close() }}
	</div>
@endif