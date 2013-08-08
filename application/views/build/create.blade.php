@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://d3up.com/js/gamedata.js"></script>
<script src="/js/build.js"></script>
<script src="http://d3up.com/js/unmin/calcv2.js"></script>
<script src="http://d3up.com/js/unmin/itembuilder.js"></script>
@endsection

@section('headerbar')
Create/Import your Diablo 3 Character Build
@endsection

@section('notifications')
	<span class='badge badge-warning' data-title='Import your Character from Battle.net' data-content=''>Battle.net Import</span>
@endsection

@section('content')
<div class='row'>
<div class='column_4'>
	<div class='padding-top'>
		<h2>Step #1</h2>
		<hr>
		@if(Request::get('character-id') && Request::get('character-bt'))
			<div class='bck color margin-top padding-5 rounded'>
				<h3>Character Selected</h3>
				<p class='padding'>The character you selected from the search page has been filled into the form on the right. Check over the data and read the information in Step #3, then hit Create to get started!</p>
				<ul class='padding margin'>
					<li>ID: {{ Request::get('character-id') }}</li>
					<li>Battle Tag: {{ Request::get('character-bt') }}</li>
					<li>Region: {{ Request::get('character-rg') }}</li>
				</ul>
				<div class='text center'>
					<a href="/build/create" class='button secondary tiny'>Search for a Different Character</a>
				</div>
			</div>
			@else
			<nav data-tuktuk="menu" data-role="tabs" class="margin-top margin-bottom text small bold clearfix">
				@if(Auth::user())
					@if(Auth::user()->battletag && Auth::user()->region)
						<a href data-tab="#import-characters" class='active'>
							My Characters
						</a>
						<a href data-tab="#import-others">
							Search by Battle Tag
						</a>
					@else 
						<a class='rounded' href="/user">
							My Characters (Battle Tag Missing)
						</a>
						<a href data-tab="#import-others" class='active'>
							Search by Battle Tag
						</a>
					@endif
				@else
					<a href data-tab="#import-others" class='active'>
						Search by Battle Tag
					</a>
					<a href='/login' class='button tiny secondary anchor margin-top'>
						My Characters (Click to Login First)
					</a>
				@endif
			</nav>
			<div class='tab-content'>
				@if(Auth::user())
					@if(Auth::user()->battletag && Auth::user()->region)
						<div id="import-characters" class="tab-pane active" data-role="tab"> 
							@include('build.create.user')
						</div>
						<div id="import-others" class="tab-pane" data-role="tab">
							@include('build.create.other')
						</div>
					@else
						<div id="import-others" class="tab-pane active" data-role="tab">
							@include('build.create.other')
						</div>
					@endif
				@else
				<div id="import-others" class="tab-pane active" data-role="tab">
					@include('build.create.other')
				</div>
				@endif
		</div>
	@endif				
	</div>
</div>
<div class='column_4'>
	<div class='padding-top'>
		<h2>Step #2</h2>
		<hr>
		@include('build.create.form')
	</div>
</div>
<div class='column_4'>
	<div class='padding-top'>
		<h2>Step #3</h2>
		<hr>
		<p>Create your character build!</p>
		<a id='pseudosubmit' class='margin button anchor success tiny'>Create this Build</a>		
		@if(Auth::user())
		<p><span class='badge badge-success'>Please note the following information...</span></p>
		@else 
		<p><span class='badge badge-error'>Since you're not logged in, please note...</span></p>
		@endif			
		<ul class='padding margin'>
			@if(Auth::user() && Auth::user()->battletag && Auth::user()->region)
			<li>Your build will be accessible from the homepage and the navigation bar, as well as the "Builds" section under your account.</li>
			<li>If you edit your build directly or any items it's wearing, it will lose it's 'Authentic' status. <a href='#'>What's an Authentic status?</a></li>
			<li>Some skills need to be activated, you can click on the icon anywhere you see it or activate it from the skills tab.</li>
			@else
			<li>If you'd like to be able to edit any skills or items, please login before you create this build.</li>
			<li>You can update your build from Battle.net by using the "Sync" tool on your build.</li>
			<li>Even though you're not logged in, your build will be saved for future access, bookmark your build after you've created it.
			@endif
			<li>For more information about how to use your build, <a href="#">check out this guide</a>.</li>
		</ul>
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

@include('template.global.scripts.tabs')

<script type="text/javascript">
	$(function(){
		$("#pseudosubmit").bind('click', function() {
			$(".padding-top form").trigger("submit");
		});
		var characterId = $("input[name=character-id]"),
				characterRg = $("input[name=character-rg]"),
				characterBt = $("input[name=character-bt]"),
				charSelect = $("#characters, #characters-manual"),
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
			$("input#level").attr("value", level);
			clsPick.attr("selected", "selected");
			$("input#paragon").attr("value", paragon);
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