<ul class="nav nav-pills">
  <li>
		<a href="#gear-paperdoll" data-toggle="tab">
			{{ __('build.paperdoll') }}
		</a>
	</li>
  <li class="active">
		<a href="#gear-overview" data-toggle="tab">
			{{ __('build.overview') }}
		</a>
	</li>
  <li>
		<a href="#gear-contributions" data-toggle="tab">
			{{ __('build.dps_ehp_contributions') }}
		</a>
	</li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="gear-overview">
	@include("build.section.gear.overview")
  </div>
  <div class="tab-pane" id="gear-contributions">
	@include("build.section.gear.contributions")
  </div>
  <div class="tab-pane" id="gear-paperdoll">
	@include("build.section.gear.paperdoll")
  </div>
</div>