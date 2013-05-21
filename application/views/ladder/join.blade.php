@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
@endsection

@section('headerbar')
<a href="/ladder">/r/diablo Ladder</a> / Join!
@endsection

@section('content')
	<div class="title-block">
		<div class="title-inner">
			<div class='row-fluid'>
				<div class='span10 offset1'>
					<h2>Ladder Test</h2>
					<p>arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara </p>
					<p>arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara </p>
					<p>arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara </p>
					<p>arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara arwara </p>
				</div>
			</div>
			<div class='row-fluid'>
				<div class='span4'>
					<div class='app-pane'>
						<h2>Step #1</h2>
						<div class='alert alert-success'>
							<ol style='margin-bottom: 0'>
								<li>Create a character,  login to the game.</li>
								<li>Don't move or kill anything, just logout.</li>
								<li>Scan for your BattleTag (takes a moment)</li>
							</ol>
						</div>
						@if(Request::get('character-id') && Request::get('character-bt'))
							<div class='alert alert-success'>
								<h3>Character Selected</h3>
								<p>The character you selected from the search page has been filled into the form on the right. Check over the data and read the information in Step #3, then hit Create to get started!</p>
								<ul>
									<li>ID: {{ Request::get('character-id') }}</li>
									<li>Battle Tag: {{ Request::get('character-bt') }}</li>
									<li>Region: {{ Request::get('character-rg') }}</li>
								</ul>
							</div>
							<div class='btn-group btn-group-block'>
								<a href="/build/create" class='btn'>Search for a Different Character</a>
							</div>
							@else
							<div id="import-tabs">
							<ul class="nav nav-pills nav-pills-block">
								@if(Auth::user())
									@if(Auth::user()->battletag && Auth::user()->region)
									<li><a href="#import-others" data-toggle="tab">Import by Battle.net Battle Tag</a></li>
									<li class='active'><a href="#import-characters" data-toggle="tab">My Characters</a></li>
									@else 
									<li class='active'><a href="#import-others" data-toggle="tab">Import by Battle Tag</a></li>
									<li class='disabled'><a href="/user" data-toggle="popover" data-title="Complete your Profile to Access" data-content="Your user profile is missing it's BattleTag and Region. Click here to head to your profile to fill this information out.">My Characters (Battle Tag Missing)</a></li>
									@endif
								@else
									<li class='active'><a href="#import-others" data-toggle="tab">Import by Battle Tag</a></li>
									<li class='disabled'  data-toggle="popover" data-trigger="hover" data-title="Login to gain access to more features" data-content="If you register first, you'll be able to edit your items, change your skills and make changes to your character. You'll also have quick access to them from the navigation.&lt;br&gt;&lt;br&gt;Your build will still be saved even if you don't register, just bookmark the URL.">
										<a href='/login'>
											My Characters (Login)
										</a>
									</li>
								@endif
							</ul>
							<div class='tab-content'>
								@if(Auth::user())
									@if(Auth::user()->battletag && Auth::user()->region)
										<div id="import-characters" class="tab-pane active">
											@include('build.create.user')
										</div>
										<div id="import-others" class="tab-pane">
											@include('build.create.other')
										</div>
									@else
										<div id="import-others" class="tab-pane active">
											@include('build.create.other')
										</div>
									@endif
								@else
								<div id="import-others" class="tab-pane active">
									@include('build.create.other')
								</div>
								@endif
						</div>
					</div>
					@endif				
					</div>
				</div>
				<div class='span4'>
					<div class='app-pane'>
						<h2>Step #2</h2>
						@include('build.create.disabled')
					</div>
				</div>
				<div class='span4'>
					<div class='app-pane'>
						<h2>Step #3</h2>
						<p>Create your character build!</p>
						@if(Auth::user())
						<p><span class='badge badge-success'>Please note the following information...</span></p>
						@else 
						<p><span class='badge badge-error'>Since you're not logged in, please note...</span></p>
						@endif					
						<ul>
							@if(Auth::user() && Auth::user()->battletag && Auth::user()->region)
							<li>Some info bullet point stuff for D3Up Users.</li>
							<li>Some info bullet point stuff for D3Up Users.</li>
							<li>Some info bullet point stuff for D3Up Users.</li>
							<li>Some info bullet point stuff for D3Up Users.</li>
							@else
							<li>Some info bullet point stuff for non-registered users.</li>
							<li>Some info bullet point stuff for non-registered users.</li>
							<li>Some info bullet point stuff for non-registered users.</li>
							<li>Some info bullet point stuff for non-registered users.</li>
							@endif
							<li>For more information about how to use your build, <a href="#">check out this guide</a>.</li>
						</ul>
						<a id='psydosubmit' class='disabled btn btn-success input-block-level'>Create this Build</a>
					</div>
				</div>
		</div>
	</div>
	<? if(!Auth::check()): ?>
	<!-- <div class='alert'>
		<h4><strong style='color: #f00'>Warning! You are not logged in.</strong></h4>
		<p>Since you are not logged in, we will import your build into what we call an <strong>anonymous build</strong>. You will not be able to edit the name, skills or gear on the build, but you will be able to use the Calculators and Item Simulators. Anonymous builds are automatically deleted after a period of ninety (90) days of no access. Please bookmark or save the link to your build for future use!</p>
		<p>If you'd like to edit and change this your build in the future, please <a href="/login">login</a> or <a href="/register">create an account</a> before creating it.</p>
	</div> -->
	<? endif ?>

	</div>

	<script type="text/javascript">
		$(function(){
			$("#psydosubmit").bind('click', function() {
				if(!$(this).hasClass('disabled')) {
					$(".app-pane form").trigger("submit");					
				}
			});
			var characterId = $("input[name=character-id]"),
					characterRg = $("input[name=character-rg]"),
					characterBt = $("input[name=character-bt]"),
					charSelect = $("#characters, #characters-manual"),
					stepStatus = $(".step-status"),
					charListManual = $("#characters-manual"),
					battletag = $("#battle-tag"),
					importer = $("#import-find"),
					region = $("#region"),
					research = $("#repeat-search").button(),
					characters = $("#import-character"),
					search = $("#search-battle-tag").button();

			characters.hide();
			charSelect.bind('change', function() {
				var battletag = $(this).attr("data-battletag"),
						selected = $(this).find(":selected"),
						region = selected.attr("data-region"),
						name = selected.attr("data-name"),
						level = selected.attr("data-level"),
		        paragon = selected.attr("data-paragon"),
						cls = selected.attr("data-class"), 
						clsPick = $("select#class").find("option[value=" + cls + "]"),
						isHardcore = selected.attr("data-hardcore"),
						hardcore = $("#hardcore"),
						id = selected.val();
				if(stepStatus.find("div:first").hasClass("hidden")) {
					$("input#name, #psydosubmit").removeAttr("disabled").removeClass("disabled");
					stepStatus.find("div").toggleClass("hidden");
				}
				characterBt.val(battletag)
				characterId.val(id);
				characterRg.val(region);
				$("select#class").find("option").each(function() {
					$(this).removeAttr("selected");
				})
				if(isHardcore == "true") {
					hardcore.attr("checked", "checked");
				} else {
					hardcore.attr("checked", false);
				}
				$("input#name").attr("value", name);
				$("input[name=level]").attr("value", level);
				$("#disp_lvl").text(level);
				$("input[name=class]").attr("value", cls);
				$("#disp_class").text(cls);
				$("input[name=paragon]").attr("value", paragon);
			});
			research.click(function() {
				characters.hide();
				importer.show();
				return false;
			});
			search.click(function() {
				characters.show();
				importer.hide();
				$.ajax({
					url: '/ladder/characters',
					method: 'GET',
					dataType: 'json',
					data: {
						battletag: battletag.val(),
						region: region.val(),
					},
					success: function(data) {
						if(data == null) {
							charListManual.empty().append("<option value=''>Error: No Characters found!</option>");
						} else {
							charListManual.empty().append("<option value=''>Select a Character...</option>");
							charListManual.attr("data-battletag", battletag.val());
							$.each(data, function(k,v) {
								var option = $("<option>"),
										hcLabel = '';
								option.val(v.id);
								if(v.hardcore) {
									hcLabel = 'HC';
								} else {
									hcLabel = 'SC';
								}
								option.attr("data-hardcore", v.hardcore);
								option.attr("data-class", v.class);
								option.attr("data-name", v.name);
								option.attr("data-paragon", v.paragonLevel);
								option.attr("data-level", v.level);
								option.attr("data-region", v.region);
								option.html("[" + hcLabel + "][" + v.level + "] " + v.name + " - " + v.class.replace(/-/g, ' ').capitalize());
								charListManual.append(option);
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						charListManual.empty().append("<option value=''>Error: No Characters found!</option>");
					}
				});
				return false;
			});
		});
	</script>
@endsection

