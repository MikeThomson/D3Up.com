<div class='disabled'>
{{ Form::open() }}	
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name', Request::get('name'), array('class' => 'input-block-level', 'disabled' => 'disabled')) }}
  <div class='alert alert-danger step-status'>
		<div class='hidden'>
			<p><strong>Note</strong>: You can change the character's name above to whatever you want.</p>
			<h3>Character Information</h3>
			<ul>
				<li>Level: <span id="disp_lvl">{{ Request::get('level') }}</span></li>
				<li>Class: <span id="disp_class">{{ Request::get('class') }}</span></li>
			</ul>
		</div>
		<div>
			<p><strong>Note</strong>: You can change the character's name above to whatever you want.</p>
			<p>The form for build creation has been hidden when joining a ladder to simplify the process.</p>
			<p>Simply find your character on the left and we will populate this area with your information.</p>
		</div>
	</div>
	{{ Form::hidden('class', Request::get('class') ?: '') }}
	{{ Form::hidden('level', Request::get('level') ?: 60) }}
	{{ Form::hidden('paragon', Request::get('paragon') ?: 0) }}
	{{ Form::hidden('hardcore', (Request::get('hardcore') == 'true' ? true : false)) }}
	{{ Form::hidden('character-id', Request::get('character-id') ?: '') }}
	{{ Form::hidden('character-rg', Request::get('character-rg') ?: '') }}
	{{ Form::hidden('character-bt', Request::get('character-bt') ?: '') }}

	<!-- submit button -->
	@if (Session::has('login_errors'))
		<div class="alert alert-error">Email/Username or Password incorrect.</div>
	@endif

{{ Form::close() }}
</div>