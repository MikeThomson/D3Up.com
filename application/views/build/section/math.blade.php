<ul class="nav nav-pills">
  <li class="active">
		<a href="#math-intro" data-toggle="tab">
			{{ __('build.math') }}
		</a>
	</li>
  <li>
		<a href="#math-dps" data-toggle="tab">
			{{ __('build.dps') }}
		</a>
	</li>
  <li>
		<a href="#math-ehp" data-toggle="tab">
			{{ __('build.ehp') }}
		</a>
	</li>
</ul>
<div class="tab-content" id="math-section">
  <div class="tab-pane active" id="math-intro">
	@include("build.section.math.intro")
  </div>
  <div class="tab-pane" id="math-dps">
	@include("build.section.math.dps")
  </div>
  <div class="tab-pane" id="math-ehp">
	@include("build.section.math.ehp")
  </div>
</div>