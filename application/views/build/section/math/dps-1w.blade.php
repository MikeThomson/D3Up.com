<ul>
  <li><span data-display-item="mainhand"></span>
    <ul>
      <li>Total Damage: {{ HTML::hb('prettyStat stats.dps-mh-min') }} - {{ HTML::hb('prettyStat stats.dps-mh-max') }}</li>
      <li>Real Weapon Damage: {{ HTML::hb('prettyStat stats.dps-mh-real-min') }} - {{ HTML::hb('prettyStat stats.dps-mh-real-max') }}</li>
    </ul>
  </li>
  <li>Minimum Damage: +{{ HTML::hb('prettyStat stats.min-damage') }}</li>
  <li>Maximum Damage: +{{ HTML::hb('prettyStat stats.max-damage') }}</li>
  <li>+% Elemental Damage: {{ HTML::hb('prettyStat stats.bonus-elemental-percent') }}%</li>
</ul>
<p>+% Elemental Damage appears to use the Minimum Damage values from your weapons, WITHOUT the +Elemental Damage affixes (+X-Y Fire/Lightning/Etc Damage). This is the value we are using called 'Real Weapon Damage'.</p>
<p>To calculate +% Elemental Damage, we need to do the following...</p>
<pre>Bonus Damage = (MH Real Min Damage + MH Real Max Damage + Bonus Min Damage + Bonus Max Damage) * Bonus Ele %</pre>
<p>Plugging in the numbers, we get:</p>
<pre>({{ HTML::hb('prettyStat stats.dps-mh-real-min') }} + {{ HTML::hb('prettyStat stats.min-damage') }} + {{ HTML::hb('prettyStat stats.dps-mh-real-max') }} + {{ HTML::hb('prettyStat stats.max-damage') }}) / 2 * ({{ HTML::hb('prettyStat stats.bonus-elemental-percent') }} * 0.01)
Bonus Damage = {{ HTML::hb('prettyStat stats.bonus-elemental-damage') }}</pre>
<p>Now, for the math to determine actual average damage, which is as follows.</p>
<pre>
MH Min = (MH Weapon Min + Bonus Min)
MH Max = (MH Weapon Max + Bonus Max)
MH Avg = ((MH Min + MH Max) / 2 
A = MH Avg + Elemental Damage</pre>
<p>Plug in this build's numbers...</p>
<pre>
MH Min = ({{ HTML::hb('stats.dps-mh-min') }} + {{ HTML::hb('prettyStat stats.plus-min-damage') }}) = {{ HTML::hb('prettyStat stats.dps-mh-min-total') }}

MH Max = ({{ HTML::hb('prettyStat stats.dps-mh-max') }} + {{ HTML::hb('prettyStat stats.plus-max-damage') }}) = {{ HTML::hb('prettyStat stats.dps-mh-max-total') }}

MH Avg = ({{ HTML::hb('prettyStat stats.dps-mh-min-total') }} + {{ HTML::hb('prettyStat stats.dps-mh-max-total') }}) / 2 = {{ HTML::hb('prettyStat stats.dps-mh-avg') }}

A = {{ HTML::hb('prettyStat stats.dps-mh-avg-woele') }} + {{ HTML::hb('prettyStat stats.bonus-elemental-damage') }}
A = {{ HTML::hb('prettyStat stats.scram-a') }}</pre>