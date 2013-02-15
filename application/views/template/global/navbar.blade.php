<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="/">D3Up V2.0</a>
      <div class="nav-collapse">
        <ul class="nav">
          <li class="dropdown">
            <a href="#" class="build-select dropdown-toggle" data-toggle="dropdown">							
							<img src="/img/icons/barbarian.png" class="build-icon pull-left">
							<div class='build-name'>Jesta</div>
							<small>
								<span class="level">Level 60</span>, Paragon <span class="paragon">60</span>
							</small>
							<b class="caret"></b>
						</a>
						<div class="dropdown-menu">
	            <ul>
								<li class='build-select'>
									<a href="#">
										<img src="/img/icons/barbarian.png" class="build-icon pull-left">
										<div class='build-name'>Jesta</div>
										<small>
											<span class="level">Level 60</span>, Paragon <span class="paragon">60</span>
										</small>
									</a>
								</li>
								<li class='build-select'>
									<a href="#">
										<img src="/img/icons/monk.png" class="build-icon pull-left">
										<div class='build-name'>Jesta</div>
										<small>
											<span class="level">Level 60</span>, Paragon <span class="paragon">8</span>
										</small>
									</a>
								</li>
								<li class='build-select'>
									<a href="#">
										<img src="/img/icons/demon-hunter.png" class="build-icon pull-left">
										<div class='build-name'>Jesta</div>
										<small>
											<span class="level">Level 60</span>, Paragon <span class="paragon">3</span>
										</small>
									</a>
								</li>
								<li class='build-select'>
									<a href="#">
										<img src="/img/icons/wizard.png" class="build-icon pull-left">
										<div class='build-name'>Jesta</div>
										<small>
											<span class="level">Level 60</span>, Paragon <span class="paragon">0</span>
										</small>
									</a>
								</li>
								<li class='build-select'>
									<a href="#">
										<img src="/img/icons/witch-doctor.png" class="build-icon pull-left">
										<div class='build-name'>Jesta</div>
										<small>
											<span class="level">Level 12</span>
										</small>
									</a>
								</li>
								<li>
									<div class='btn-group'>
										<a href="#" class='btn btn-mini'>Create Build</a>
										<a href="#" class='btn btn-mini'>All Builds</a>
									</div>
								</li>
	            </ul>
						</div>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('d3up.builds') }} <b class="caret"></b></a>
						<div class="dropdown-menu">
	            <ul>
								<li class='barbarian'><a href="/build?class=barbarian">{{ __('build.barbarian') }}</a></li>
								<li class='demon-hunter'><a href="/build?class=demon-hunter">{{ __('build.demon-hunter') }}</a></li>
								<li class='monk'><a href="/build?class=monk">{{ __('build.monk') }}</a></li>
								<li class='witch-doctor'><a href="/build?class=witch-doctor">{{ __('build.witch-doctor') }}</a></li>
								<li class='wizard'><a href="/build?class=wizard">{{ __('build.wizard') }}</a></li>
	            </ul>
						</div>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('d3up.guides') }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Build #1</a></li>
              <li><a href="#">Build #2</a></li>
              <li><a href="#">Build #3</a></li>
              <li><a href="#">Build #4</a></li>
              <li><a href="#">Build #5</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('d3up.items') }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Build #1</a></li>
              <li><a href="#">Build #2</a></li>
              <li><a href="#">Build #3</a></li>
              <li><a href="#">Build #4</a></li>
              <li><a href="#">Build #5</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right" action="">
          <input type="text" class="search-query span3" placeholder="Search by BattleTag (Name#1234)">
        </form>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('.dropdown-toggle').dropdown();
	});
</script>