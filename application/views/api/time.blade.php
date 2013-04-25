@layout('template.main')

@section('content')
	<style type="text/css" media="screen">
	.table a,
		.table {
			color: #000;
		}
	</style>
	<h2>D3Up.com API Response Times</h2>
	<p>Test page for how long API calls take to make</p>
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
						'/api/build',
						'/api/build?class=barbarian',
						'/api/build?class=barbarian&skills=sprint~c|whirlwind~c',
						'/api/build?sort=dps',
						'/api/build?sort=ehp',
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
									loading = $("<td>Timing...</td>");
							target.append(row.append(query));
					  }
				}).done(function () {
					var row = $("<tr>"),
							link = $("<a href='" + url + "'>" + url + "</a>"),
							query = $("<td>URL: </td>").append(link),
							diff = (now() - before),
							time = $("<td>" + diff + "ms</td>");
					if(diff < 100) {
						row.addClass('success');
					} else if(diff < 300) {
						row.addClass('warning');						
					} else {
						row.addClass('error');												
					}
					target.append(row.append(query, time));
					$("#temp").remove();
				});
			});
		});
	</script>
@endsection