<div>
	<script id="handlebar-stats" type="text/x-handlebars-template">
	
		{{-- Highlight: Used to highlight DPS/EHP and other major stats at the top. --}}
		@render('build.section.stats.highlight')

		{{-- Damage Stats: Used to display raw damage and DPS numbers, nothing weapon or skill specific. --}}
		@render('build.section.stats.damage')

		{{-- Base Stats: Base stats like Str, Dex, etc --}}
		@render('build.section.stats.base')

		{{-- Defensive Stats: Summary of Defensive Stats --}}
		@render('build.section.stats.defensive')

		{{-- Resistances: Specific Resistances --}}
		@render('build.section.stats.resistances')

		{{-- EHP: Specific versions of all your EHP --}}
		@render('build.section.stats.ehp')

		{{-- Health Stats: Summary of Health and Regen Mechanics --}}
		@render('build.section.stats.health')

	</script>
</div>
