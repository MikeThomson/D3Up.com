<div class="page math" id="ehp-math">
	<h2>{{ __('build.math-ehp-title', array('name' => HTML::buildLink($build))) }}</h2>
	<p>{{ __('build.math-ehp-intro') }}</p>
	<p class='alert'>Please note, that the standard EHP does NOT use Dodge and Block, the EHP w/ Block and EHP w/ Dodge values do however include them. Standard EHP factors in values that work against ALL sources of damage, and since there are damage sources in the game that you cannot block or dodge, I've chosen not to include them.</p>
  <p>The standard EHP calculations uses the following stats:</p>
  <ul>
    <li>Armor</li>
    <li>All Resist</li>
    <li>% Damage Reduction</li>
  </ul>

	<h4>Calculating your Health</h4>
  <p>The first thing we need in order to calculate standard EHP is how much health your character has.</p>
<pre>
@if($build->level < 35)
<span>health</span> = (36 + 4 * <span>level</span> + 10 * <span>vitality</span>) * (1 + (<span>+% Life</span> * 0.01))
@else
<span>health</span> = (36 + 4 * <span>level</span> + (<span>level</span> - 25) * <span>vitality</span>) * (1 + (<span>+% Life</span> * 0.01))
@endif
</pre>
  <p>If we plug in your build's numbers, it turns out looking like this:</p>
<pre>
@if($build->level < 35)
<span>{{ HTML::hb('stats.life')}}</span> = (36 + 4 * <span>{{ $build->level }}</span> + 10 * <span>{{ HTML::hb('stats.vitality')}}</span>) * (1 + (<span>{{ HTML::hb('stats.plus-life')}}</span> * 0.01))
@else
<span>{{ HTML::hb('stats.life')}}</span> = (36 + 4 * <span>{{ $build->level }}</span> + (<span>{{ $build->level }}</span> - 25) * <span>{{ HTML::hb('stats.vitality')}}</span>) * (1 + (<span>{{ HTML::hb('stats.plus-life')}}</span> * 0.01))
@endif
</pre>
	<p>Making your total life {{ HTML::hb('stats.life')}}.</p>

  <h4>Calculating your Damage Reduction (Armor)</h4>
	<p>The first type of damage reduction comes from armor, which reduces all types of damage by a flat percentage.</p>
	<pre><span>Damage Reduction</span> =  <span>Armor</span> / ( 50 * <span>Monster Level</span> + <span>Armor</span> )</pre>
	<p>By default, all damage done to you is calculated against a level 63 monster. With that being said, here's the calculations plugging in your characters details:</p>
	<pre><span>{{ HTML::hb('prettyStat stats.armorReduction "armorReduction"')}} ({{ HTML::hb('round stats.armorReduction 4')}})</span> =  <span>{{ HTML::hb('prettyStat stats.armor')}}</span> / ( 50 * <span>63</span> + <span>{{ HTML::hb('prettyStat stats.armor')}}</span> )</pre>
	<p>The armor value alone on your character reduces damage you take by {{ HTML::hb('prettyStat stats.armorReduction "armorReduction"')}}.</p>

	<h4>Calculating your Damage Reduction (All Resist)</h4>
	<p>Next up in damage reduction is your All Resist stat, which reduces all incoming damage once again by a separate percentage.</p>
	<pre><span>Damage Reduction</span> = ( <span>All Resist</span> / (5 * <span>Monster Level</span> * <span>All Resist</span> ) )</pre>
	<p>Once again by default, all damage done to you is calculated against a level 63 monster. Here's the calculations plugging in your characters details:</p>
	<pre><span>{{ HTML::hb('prettyStat stats.percent-resist-all "percent-resist-all"')}} ({{ HTML::hb('round stats.percent-resist-all 4')}})</span> =  <span>{{ HTML::hb('prettyStat stats.resist-all')}}</span> / ( 5 * <span>63</span> + <span>{{ HTML::hb('prettyStat stats.resist-all')}}</span> )</pre>
	<p>The value of your Resist All stat on your character reduces damage you take by another {{ HTML::hb('prettyStat stats.armorReduction "armorReduction"')}}.</p>
	
	<h4>Calculating Damage Taken Percentage</h4>
	<p>In this step, we are going to merge the two above values with any flat damage reductions from passives, skills or even your class. All of the extra bonuses you receive are shown in the calculation as "Reduction(Bonus)".</p>
	@if($build->class == 'monk' || $build->class == 'barbarian')
	<p>Please note, as a Monk or Barbarian, there is an extra 30% damage reduction tacked onto the end of the calculation.</p>
	<pre><span>Taken</span> = (1-<span>Reduction(Armor)</span>) * (1-<span>Reduction(Resist)</span>) * (1-<span>Reduction(Bonus)</span>) * (1-30%)</pre>
	@else
	<pre><span>Taken</span> = (1-<span>Reduction(Armor)</span>) * (1-<span>Reduction(Resist)</span>) * (1-<span>Reduction(Bonus)</span>)</pre>
	@endif
	<p>Let's go ahead and plug in the numbers from your build.</p>
	@if($build->class == 'monk' || $build->class == 'barbarian')
	<pre><span>{{ HTML::hb('prettyStat stats.damageTaken "damageTaken"')}}</span> = (1 - <span>{{ HTML::hb('round stats.armorReduction 4')}}</span>) * (1 - <span>{{ HTML::hb('round stats.percent-resist-all 4')}}</span>) * (1-<span>{{ HTML::hb('prettyStat stats.plus-damage-reduce')}}</span>) * (1-30%)</pre>
	@else
	<pre><span>{{ HTML::hb('prettyStat stats.damageTaken "damageTaken"')}}</span> = (1 - <span>{{ HTML::hb('round stats.armorReduction 4')}}</span>) * (1 - <span>{{ HTML::hb('round stats.percent-resist-all 4')}}</span>) * (1-<span>{{ HTML::hb('prettyStat stats.plus-damage-reduce')}}</span>)</pre>
	@endif
	<p>After all reduction is calculated, you actually only take {{ HTML::hb('prettyStat stats.damageTaken "damageTaken"')}} of the damage dealt.</p>
	<h4>Finally, calculating your EHP Value</h4>
	<p>Now that we know how much damage you actually take, we can divide your life by that value in order to calculate your EHP.</p>
	<pre><span>EHP</span> = <span>Life</span> / <span>Percentage Damage Taken</span></pre>
	<p>Add in the values from above:</p>
	<pre><span>{{ HTML::hb('prettyStat stats.ehp')}}</span> = <span>{{ HTML::hb('prettyStat stats.life')}}</span> / <span>{{ HTML::hb('stats.damageTaken')}}</span></pre>
	<p>Now you end up with <strong>{{ HTML::hb('prettyStat stats.ehp')}}</strong> EHP!</p>
  <p>Feel free to use these calculations in your applications, spreadsheets or websites!</p>
</div>