@layout('template.main')

@section('content')
	<style type="text/css" media="screen">
	.table a,
		.table {
			color: #000;
		}
	</style>
	<h2>D3Up.com API Response Timers</h2>
	<div class="pull-right">
		<span class='label label-success'>&lt; 100ms</span>
		<span class='label label-warning'>101ms - 299ms</span>
		<span class='label label-error'>&gt; 300ms</span>
	</div>
	<p>Issues a request against all API calls and measures the time it takes to respond.</p>
	<table id="results" class='table table-bordered'></table>
	
	<script type="text/javascript" charset="utf-8">
	/*
	 * jQuery.ajaxQueue - A queue for ajax requests
	 * 
	 * (c) 2011 Corey Frang
	 * Dual licensed under the MIT and GPL licenses.
	 *
	 * Requires jQuery 1.5+
	 */
	(function(a){var b=a({});a.ajaxQueue=function(c){function g(b){d=a.ajax(c).done(e.resolve).fail(e.reject).then(b,b)}var d,e=a.Deferred(),f=e.promise();b.queue(g),f.abort=function(h){if(d)return d.abort(h);var i=b.queue(),j=a.inArray(g,i);j>-1&&i.splice(j,1),e.rejectWith(c.context||c,[f,h,""]);return f};return f}})(jQuery);
	function now() { return (new Date).getTime(); }
	$(document).ready(function() {
			var target = $("#results"),
					tests = [
						'/api/builds',
						'/api/builds/barbarian',
						'/api/builds/barbarian?actives=sprint~c|whirlwind~c',
						'/api/builds?sort=dps',
						'/api/builds?sort=ehp',
						'/api/builds/monk?sort=dps',
						'/api/builds/demon-hunter?sort=ehp',
						'/api/builds/wizard?actives=blizzard~c&sort=dps',
						'/api/user/item',
						'/api/user/item?type=chest',
						'/api/user/item?type=sword&sort=newest',
						'/api/user/build',
						'/api/user/build?class=barbarian',
						'/api/user/build?class=monk&sort=dps',
					];
			$.each(tests, function(idx, url) {
				var before = now();
				$.ajaxQueue({
				    type: "GET",
						dataType: 'json',
				    url: url,
					  beforeSend: function () {
							before = now();
							var row = $("<tr id='temp' class='info'>"),
									link = $("<a href='" + url + "'>" + url + "</a>"),
									query = $("<td>URL: </td>").append(link),
									loading = $("<td>Timing...</td>"),
									results = $("<td>Timing...</td>");
							target.append(row.append(query, loading, results));
					  }
				}).done(function (data) {
					var row = $("<tr>"),
							link = $("<a href='" + url + "'>" + url + "</a>"),
							query = $("<td>URL: </td>").append(link),
							diff = (now() - before),
							time = $("<td>" + diff + "ms</td>"),
							count = $("<td>" + Object.keys(data).length + " Objects</td>");
					if(diff < 100) {
						row.addClass('success');
					} else if(diff < 300) {
						row.addClass('warning');						
					} else {
						row.addClass('error');												
					}
					target.append(row.append(query, time, count));
					$("#temp").remove();
				});
			});
		});
	</script>
@endsection