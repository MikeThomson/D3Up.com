  <ul>
    <li><span data-display-item="mainhand"></span>
      <ul>
        <li>Total Damage: {{ HTML::hb('prettyStat stats.dps-mh-min') }} - {{ HTML::hb('prettyStat stats.dps-mh-max') }}</li>
        <li>Weapon Damage: {{ HTML::hb('prettyStat stats.dps-mh-real-min') }} - {{ HTML::hb('prettyStat stats.dps-mh-real-max') }}</li>
      </ul>
    </li>
    <li><span data-display-item="offhand"></span>
      <ul>
        <li>Total Damage: {{ HTML::hb('prettyStat stats.dps-oh-min') }} - {{ HTML::hb('prettyStat stats.dps-oh-max') }}</li>
        <li>Real Weapon Damage: {{ HTML::hb('prettyStat stats.dps-oh-real-min') }} - {{ HTML::hb('prettyStat stats.dps-oh-real-max') }}</li>
      </ul>
    </li>
    <li>Minimum Damage: +{{ HTML::hb('prettyStat stats.min-damage') }}</li>
    <li>Maximum Damage: +{{ HTML::hb('prettyStat stats.max-damage') }}</li>
    <li>+% Elemental Damage: {{ HTML::hb('prettyStat stats.bonus-elemental-percent') }}%</li>
  </ul>
  <p>+% Elemental Damage uses the Minimum and Maximum damage values from your weapons, WITHOUT the +Elemental Damage affixes (+X-Y Fire/Lightning/Etc Damage). This is the value we are using called 'Real Weapon Damage'.</p>
  <p>To calculate the bonus damage from +% Elemental Damage, we need to do the following...</p>
  <pre>MH Bonus Damage = (MH Real Min Damage + Bonus Min Damage + MH Real Max Damage + Bonus Max Damage) / 2 * Bonus Ele %

OH Bonus Damage = (OH Real Min Damage + Bonus Min Damage + OH Real Max Damage + Bonus Max Damage) / 2 * Bonus Ele %</pre>
  <p>Plugging in the numbers, we get:</p>
  <pre>MH = ({{ HTML::hb('prettyStat stats.dps-mh-real-min') }} + {{ HTML::hb('prettyStat stats.min-damage') }} + {{ HTML::hb('prettyStat stats.dps-mh-real-max') }} + {{ HTML::hb('prettyStat stats.max-damage') }}) / 2 * ({{ HTML::hb('prettyStat stats.bonus-elemental-percent') }} * 100)
MH Bonus Damage = {{ HTML::hb('prettyStat stats.bonus-elemental-damage') }}

OH = ({{ HTML::hb('prettyStat stats.dps-oh-real-min') }} + {{ HTML::hb('prettyStat stats.min-damage') }} + {{ HTML::hb('prettyStat stats.dps-oh-real-max') }} + {{ HTML::hb('prettyStat stats.max-damage') }}) / 2 * ({{ HTML::hb('prettyStat stats.bonus-elemental-percent') }} * 100)
OH Bonus Damage = {{ HTML::hb('prettyStat stats.bonus-elemental-damage-oh') }}</pre>
<p>Now, for the math to determine actual average damage, which is as follows.</p>
<pre>
MH Min = (MH Weapon Min + Bonus Min)
MH Max = (MH Weapon Max + Bonus Max)
OH Min = (OH Weapon Min + Bonus Min)
OH Max = (OH Weapon Max + Bonus Max)
MH Avg = (MH Min + MH Max) / 2 + MH Bonus Damage
OH Avg = (OH Min + OH Max) / 2 + OH Bonus Damage
A = (MH Avg + OH Avg) / 2</pre>
<p>Plug in this build's numbers...</p>
<pre>
MH Min = ({{ HTML::hb('prettyStat stats.dps-mh-min') }} + {{ HTML::hb('prettyStat stats.plus-min-damage') }}) = {{ HTML::hb('prettyStat stats.dps-mh-min-total') }}

MH Max = ({{ HTML::hb('prettyStat stats.dps-mh-max') }} + {{ HTML::hb('prettyStat stats.plus-max-damage') }}) = {{ HTML::hb('prettyStat stats.dps-mh-max-total') }}

OH Min = ({{ HTML::hb('prettyStat stats.dps-oh-min') }} + {{ HTML::hb('prettyStat stats.plus-min-damage') }}) = {{ HTML::hb('prettyStat stats.dps-oh-min-total') }}

OH Max = ({{ HTML::hb('prettyStat stats.dps-oh-max') }} + {{ HTML::hb('prettyStat stats.plus-max-damage') }}) = {{ HTML::hb('prettyStat stats.dps-oh-max-total') }}


MH Avg = ({{ HTML::hb('prettyStat stats.dps-mh-min-total') }} + {{ HTML::hb('prettyStat stats.dps-mh-max-total') }}) / 2  + {{ HTML::hb('prettyStat stats.bonus-elemental-damage') }} = {{ HTML::hb('prettyStat stats.dps-mh-avg') }}

OH Avg = ({{ HTML::hb('prettyStat stats.dps-oh-min-total') }} + {{ HTML::hb('prettyStat stats.dps-oh-max-total') }}) / 2  + {{ HTML::hb('prettyStat stats.bonus-elemental-damage-oh') }} = {{ HTML::hb('prettyStat stats.dps-oh-avg') }}

A = ({{ HTML::hb('prettyStat stats.dps-mh-avg-woele') }} + {{ HTML::hb('prettyStat stats.dps-oh-avg-woele') }}) / 2 
A = {{ HTML::hb('prettyStat stats.scram-a') }}</pre>