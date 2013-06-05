<div class="tab-content">
	<h3>Bug Report</h3>
	<p>If you've noticed something wrong with the stats on your build, please file a bug report using the form below.</p>
	<p>In the description area, <strong>please list all stats that are incorrect, as well as what those stats should be</strong>.</p>
	{{ Form::open('/bug/report') }}
		{{ Form::label('description', 'Description of bug') }}
		{{ Form::textarea('description', 'test', array('class' => 'input-block-level')) }}
		{{ Form::hidden('build', $build->id) }}
		{{ Form::hidden('stats') }}
		{{ Form::submit('Submit Bug') }}
	{{ Form::close() }}
</div>