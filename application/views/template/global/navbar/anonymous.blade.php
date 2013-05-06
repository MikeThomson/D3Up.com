<li class="dropdown">
  <a href="#" class="dropdown-toggle-clickable" data-toggle="dropdown">							
		{{ __('d3up.getting_started') }}
		<b class="caret"></b>
	</a>
	<div class="dropdown-menu">
		<div class="container-fluid getting-started">
			<div class="row-fluid">
				<div class="span6 lead">
					{{ __('d3up.ready_to_use') }}
				</div>
				<div class="span6 lead">
					{{ __('d3up.login_or_register') }}
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<p>{{ __('d3up.ready_to_start') }}</p>
					<p><a class="btn btn-d3up btn-block" href="/build/create">{{ __('d3up.create_character_build') }}</a></p>
					<div class="divider">&nbsp;</div>
					<p class='lead'>{{ __('d3up.more_build_info') }}</p>
					<p>{{ __('d3up.more_build_info_text') }}</p>
					<p><a class="btn btn-d3up btn-block" href="/guide/12/creating-your-build-on-d3up-com">{{ __('d3up.more_build_info_guide') }}</a></p>
				</div>
				<div class="span6">
					<p class='alert alert-warning alert-block'>{{ __('d3up.login_info') }}</p>
					@include('user.login.login')
				</div>
			</div>
		</div>
	</div>
</li>
