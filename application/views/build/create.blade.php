@layout('template.main')

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

@section('content')
<div class="title-block">
	<div class="title-inner">
		<h2 class="title">
			<a>Create/Import your Diablo 3 Character Build</a>
		</h2>
		<p class='meta'>
			By creating or importing a character build into D3Up.com's Build Calculator, you'll gain access to all of our DPS, EHP and Item Comparison tools. Follow the instructions below or for more information check out the <a href="http://d3up.com/guide/12/creating-your-build-on-d3up-com">Creating your Build on D3Up.com</a> guide.
		</p>
	</div>
</div>
<? if(!Auth::check()): ?>
<div class='alert'>
	<h4><strong style='color: #f00'>Warning! You are not logged in.</strong></h4>
	<p>Since you are not logged in, we will import your build into what we call an <strong>anonymous build</strong>. You will not be able to edit the name, skills or gear on the build, but you will be able to use the Calculators and Item Simulators. Anonymous builds are automatically deleted after a period of ninety (90) days of no access. Please bookmark or save the link to your build for future use!</p>
	<p>If you'd like to edit and change this your build in the future, please <a href="/login">login</a> or <a href="/register">create an account</a> before creating it.</p>
</div>
<? endif ?>
<div class='row'>
	<div class='span6'>
		<div class='content-page'>
			@include('build.create.form')
		</div>
	</div>
	<div class='span6'>
		<div class='content-page'>
			<h3>Import your Character!</h3>
			<div id="import-tabs">
			<ul class="nav nav-tabs">
				@if(Auth::user() && Auth::user()->battletag && Auth::user()->region)
					<li class='active'><a href="#import-characters" data-toggle="tab">My Characters</a></li>
					<li><a href="#import-others" data-toggle="tab">By BattleTag</a></li>
				@else
					<li class='active'><a href="#import-others" data-toggle="tab">By BattleTag</a></li>
				@endif
			</ul>
			<div class='tab-content'>
				@if(Auth::user())
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
			</div>
		</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
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