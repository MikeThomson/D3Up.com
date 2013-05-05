{{ Form::open('/b/'. $build->id, 'post') }}
	<fieldset>
    <legend>{{ __('build.form.build_legend') }}:</legend>
		<!-- name field -->
		<p>{{ Form::label('name', __('build.form.name')) }}</p>
		<p>{{ Form::text('name', $build->name, array('class' => 'input-block-level')) }}</p>
		{{ $errors->has('name') ? '<div class="alert alert-error">'.$errors->first('name').'</div>' : '' }}
		<!-- class field -->
		<p>{{ Form::label('class', __('build.form.class')) }}</p>
		<p>{{ Form::select('class', D3Up_Classes::$classes, $build->class, array('class' => 'input-block-level')) }}</p>
		{{ $errors->has('class') ? '<div class="alert alert-error">'.$errors->first('class').'</div>' : '' }}
		<!-- gender field -->
		<p>{{ Form::label('gender', __('build.form.gender')) }}</p>
		<p>{{ Form::select('gender', array(0 => 'Male', 1 => 'Female'), $build->gender, array('class' => 'input-block-level')) }}</p>
		{{ $errors->has('gender') ? '<div class="alert alert-error">'.$errors->first('gender').'</div>' : '' }}
		<!-- level field -->
		<p>{{ Form::label('level', __('build.form.level')) }}</p>
		<p>{{ Form::text('level', $build->level, array('class' => 'input-block-level')) }}</p>
		{{ $errors->has('level') ? '<div class="alert alert-error">'.$errors->first('level').'</div>' : '' }}
		<!-- paragon field -->
		<p>{{ Form::label('paragon', __('build.form.paragon')) }}</p>
		<p>{{ Form::text('paragon', $build->paragon, array('class' => 'input-block-level')) }}</p>
		<!-- hardcore field -->
		<p>{{ Form::label('hardcore', __('build.form.hardcore')) }}</p>
		<p>{{ Form::checkbox('hardcore', true, $build->hardcore, array('class' => 'input-block-level')) }}</p>
		<!-- private field -->
		<p>{{ Form::label('public', __('build.form.public')) }}</p>
		<p>{{ Form::checkbox('public', true, $build->public, array('class' => 'input-block-level')) }}</p>
	</fieldset>
	<fieldset>
    <legend>{{ __('build.form.meta_legend') }}:</legend>
	</fieldset>
	<div class='btn-group'>
		{{ Form::submit(__('build.form.save'), array('class' => 'btn')) }}
	</div>
{{ Form::close() }}