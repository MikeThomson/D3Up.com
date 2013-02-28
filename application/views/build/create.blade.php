@layout('template.main')

@section('content')
<div class="title-block">
	<div class="title-inner">
		<h5 class='meta'>
			Create a Build
		</h5>
		<h3 class="title">
			<a>Create / Import a Diablo 3 Character Build</a>
		</h3>
		<p class='meta'>
			By creating or importing a character build into D3Up.com's Build Calculator, you'll gain access to all of our DPS, EHP and Item Comparison tools. Follow the instructions below or for more information check out the <a href="http://d3up.com/guide/12/creating-your-build-on-d3up-com">Creating your Build on D3Up.com</a> guide.
		</p>
	</div>
</div>
<? if(!Auth::check()): ?>
<div class='alert'>
	<h4><strong style='color: #f00'>Warning! You are not logged in.</strong></h4>
	<p>Since you are not logged in, we will import your build into what we call an <strong>anonymous build</strong>. You will not be able to edit the name, skills or gear on the build, but you will be able to use the Calculators and Item Simulators. Please bookmark or save the link to your build for future use!</p>
	<p>If you'd like to edit and change this your build in the future, please <a href="/user/login">login</a> or <a href="/user/register">create an account</a> before creating it.</p>
</div>
<? endif ?>
{{ Form::open('login', 'test', array('class' => 'form-signin')) }}	
	<div class='row'>
		<div class='span6'>
			<div class='content-page'>
				@include('build.create.form')
			</div>
		</div>
		<div class='span6'>
			<div class='content-page'>
				<h3>Import your build from Battle.net</h3>
				<div id="import-tabs">
				<ul class="nav nav-tabs">
					@if(Auth::user() && Auth::user()->battletag && Auth::user()->region)
						<li class='active'><a href="#import-characters" data-toggle="tab">My Characters</a></li>
						<li><a href="#import-others" data-toggle="tab">Specify Other BattleTag</a></li>
					@else
						<li class='active'><a href="#import-others" data-toggle="tab">Specify BattleTag</a></li>
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
{{ Form::close() }}
<script type="text/javascript">
	// $(function(){ 
	// 	$("#import-tabs").tabs();
	// 	var charList = $("#characters"),
	// 			charListManual = $("#manual-characters"),
	// 			battletag = $("#battle-tag"),
	// 			region = $("#region"),
	// 			search = $("#search-battle-tag").button(),
	// 			importer = $("#import-find"),
	// 			characters = $("#import-character"),
	// 			research = $("#repeat-search").button(),
	// 			classElement = $("#class-element select");
	// 	$("#import-tabs > ul li a").click(function() {
	// 		charList.find("option").each(function() {
	// 			$(this).removeAttr("selected");
	// 		});
	// 		charListManual.find("option").each(function() {
	// 			$(this).removeAttr("selected");
	// 		});
	// 	});
	// 	characters.hide();
	// 	research.click(function() {
	// 		characters.hide();
	// 		importer.show();
	// 		return false;
	// 	});
	// 	search.click(function() {
	// 		characters.show();
	// 		importer.hide();
	// 		$.ajax({
	// 			method: 'GET',
	// 			dataType: 'json',
	// 			data: {
	// 				battletag: battletag.val(),
	// 				region: region.val(),
	// 			},
	// 			success: function(data) {
	// 				if(data == null) {
	// 					charListManual.empty().append("<option value=''>Error: No Characters found!</option>");
	// 				} else {
	// 					charListManual.empty().append("<option value=''>Select a Character...</option>");
	// 					$.each(data, function(k,v) {
	// 						var option = $("<option>"),
	// 								hcLabel = '';
	// 						option.val(v.id);
	// 						if(v.hardcore) {
	// 							hcLabel = 'HC';
	// 						} else {
	// 							hcLabel = 'SC';
	// 						}
	// 						option.attr("data-hardcore", v.hardcore);
	// 						option.attr("data-class", v.class);
	// 						option.attr("data-name", v.name);
	// 						option.attr("data-paragon", v.paragonLevel);
	// 						option.html("[" + hcLabel + "][" + v.level + "] " + v.name + " - " + v.class.replace(/-/g, ' ').capitalize());
	// 						charListManual.append(option);
	// 					});
	// 				}
	// 			},
	// 			error: function(jqXHR, textStatus, errorThrown) {
	// 				charListManual.empty().append("<option value=''>Error: No Characters found!</option>");
	// 			}
	// 		});
	// 		return false;
	// 	});
	// 	charListManual.bind('change', function() {
	// 		var name = $(this).find(":selected").attr("data-name"),
	//         paragon = $(this).find(":selected").attr("data-paragon"),
	// 				cls = $(this).find(":selected").attr("data-class"), 
	// 				clsPick = $("#class-element select").find("option[value=" + cls + "]"),
	// 				isHardcore = $(this).find(":selected").attr("data-hardcore"),
	// 				hardcore = $("#hardcore");
	// 		$("#class-element select").find("option").each(function() {
	// 			$(this).removeAttr("selected");
	// 		})
	// 		if(isHardcore == "true") {
	// 			hardcore.attr("checked", "checked");
	// 		} else {
	// 			hardcore.attr("checked", false);
	// 		}
	// 		$("#name-element input").attr("value", name);
	// 		clsPick.attr("selected", "selected");
	// 		$("#paragon-element input").attr("value", paragon);
	// 	});
	// 	charList.bind('change', function() {
	// 		var name = $(this).find(":selected").attr("data-name"),
	// 		    paragon = $(this).find(":selected").attr("data-paragon"),
	// 				cls = $(this).find(":selected").attr("data-class"), 
	// 				clsPick = $("#class-element select").find("option[value=" + cls + "]"),
	// 				isHardcore = $(this).find(":selected").attr("data-hardcore"),
	// 				hardcore = $("#hardcore");
	// 		$("#class-element select").find("option").each(function() {
	// 			$(this).removeAttr("selected");
	// 		});
	// 		if(isHardcore == "true") {
	// 			hardcore.attr("checked", "checked");
	// 		} else {
	// 			hardcore.attr("checked", false);
	// 		}
	// 		$("#name-element input").attr("value", name);
	// 		clsPick.attr("selected", "selected");
	// 		$("#paragon-element input").attr("value", paragon);
	// 	});
	// });
</script>

@endsection