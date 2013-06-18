<script id="build-gear-modify-pane" type="text/x-handlebars-template">
{{ HTML::hb('#each modifying')}}
	<div class="accordion-group" data-item-id="{{ HTML::hb('id') }}" data-slot="{{ HTML::hb('@key') }}">
		<div class="accordion-heading">
	    <div class="accordion-toggle" data-toggle="collapse" href=".collapse-{{ HTML::hb('id') }}">
				<i class="icon-chevron-down"></i>
				{{ HTML::hb('name') }}
	    </div>
	  </div>
	  <div class="collapse-{{ HTML::hb('id') }} accordion-body in">
	    <div class="accordion-inner">
			{{ HTML::hb('#each attrs')}}
				<label for="{{ HTML::hb('@key') }}">{{ HTML::hb('@key') }}</label>
				<input name="{{ HTML::hb('@key') }}">
			{{ HTML::hb('/each') }}
	    </div>
	  </div>
	</div>
{{ HTML::hb('/each')}}
</script>

<div id="build-gear-modify">

</div>