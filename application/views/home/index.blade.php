@section('content')
@include('template.search')
<div class='row bck white rounded'>
	<div class='column_9'>
		<h1 class='text small margin-bottom margin-top'>
			D3Up.com - Diablo 3 Build Calculator for EHP and DPS
		</h1>
		<div class='screenshot rounded bck dark margin-bottom' style="background-image: url('/img/screenshot.png')">
			<div class='text bold padding-5'>
				Feature Description
			</div>
		</div>
		<div class='screenshot rounded bck dark margin-bottom' style="background-image: url('/img/screenshot.png')">
			<div class='text bold padding-5'>
				Feature Description
			</div>
		</div>
		<div class='screenshot rounded bck dark margin-bottom' style="background-image: url('/img/screenshot.png')">
			<div class='text bold padding-5'>
				Feature Description
			</div>
		</div>
		<div class='screenshot rounded bck dark margin-bottom' style="background-image: url('/img/screenshot.png')">
			<div class='text bold padding-5'>
				Feature Description
			</div>
		</div>
	</div>
	<div class='column_3'>
		<?
			$partners = array('rdiablo', 'loothunter', 'd3bit');
			shuffle($partners);
		?>
		@include('template.partners.'.$partners[0])
	</div>
</div>
@include('home.updates')
@endsection