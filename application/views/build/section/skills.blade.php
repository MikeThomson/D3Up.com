<style type="text/css" media="screen">
	.skills {
		padding: 0;
		margin: 0;
		list-style: none;
/*		border: 1px solid #fff;*/
	}
	.skills .skill {
/*		border: 1px solid #fff;*/
	}
	.skills .skill .skill-icon {
		float: left;
		width: 36px;
		height: 36px;
	}
	.skills .skill .skill-details h3 {
		font-size: 28px;
	}
	.skills .skill .skill-details {
		margin-left: 50px;
	}
</style>
<ul class="nav nav-pills">
  <li class='active'><a href="#skills-overview" data-toggle="tab">Overview</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="skill-overview">
		<ul class='skills'>
			{{ HTML::hb('#each stats.skillData') }}
				<li class='skill' data-skill='{{ HTML::hb('@key') }}'>
					<div class='skill-icon icon-frame'>
						<img src='/img/icons/{{ $build->class }}-{{ HTML::hb('skillName @key') }}.png'>
					</div>
					<div class='skill-details row-fluid'>
						<div class='span9'>
							<h3>Skill Name</h3>
						</div>
						<div class='span3'>
							{{ HTML::hb('dps') }}
						</div>
					</div>
				</li>
			{{ HTML::hb('/each') }}
			@foreach($build->passives as $skill)
			<li class='skill' data-skill='{{ $skill }}'>
				<div class='skill-icon icon-frame'>
					<img src='/img/icons/{{ $build->class }}-{{ explode("~", $skill)[0] }}.png'>
				</div>
				<div class='skill-details'>
					<h3>{{ $skill }}</h3>
				</div>
			</li>
			@endforeach
		</ul>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
	$('#gear-overview a[data-toggle="tab"]').on('show', function (e) {
		$('#gear-overview .nav').hide();
		$('#gear-overview .return-home').bind('click', function() {
			$(this).closest('.item-detail').removeClass("active");
			$('#gear-overview .nav').show();
		});
		// console.log(e.target);
	})
</script>