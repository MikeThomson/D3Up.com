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
					<p>You can either create a character from scratch or import directly from your Diablo 3 Armory profile! Click below to get started using our tools.</p>
					<p><a class="btn btn-d3up btn-block" href="/build/create">{{ __('d3up.create_character_build') }}</a></p>
					<div class="divider">&nbsp;</div>
					<p class='lead'>Need more info on builds?</p>
					<p>Looking for more information on how to use the Build Creator, Calculator and all of D3Up.com's Tools?</p>
					<p><a class="btn btn-d3up btn-block" href="/guide/12/creating-your-build-on-d3up-com">Check out our guide on Creating Builds</a></p>
				</div>
				<div class="span6">
					<p class='alert alert-warning alert-block'>You don't have to login or register to use D3Up.com's tools, but if you want to be able to edit the build in the future, please login or register first.</p>
					@include('user.login.form')
				</div>
			</div>
		</div>
	</div>
</li>
