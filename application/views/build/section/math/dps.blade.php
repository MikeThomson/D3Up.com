<?
  $isDW = false; 
  if($build->gear['offhand'] && $build->gear['offhand']->id) {
    if(in_array($build->gear['offhand']->type, explode("|", "axe|ceremonial-knife|hand-crossbow|dagger|fist-weapon|mace|mighty-weapon|spear|sword|wand|2h-mace|2h-axe|bow|daibo|crossbow|2h-mighty|polearm|staff|2h-sword"))) {
      $isDW = true;
    }
  }
?>
<div class="page math" id="dps-math">
  <p>Note: This is an experimental tab! Still working out the bugs.</p>
  <p>In an effort to improve the calculator, this page outlines all of the steps to calculate this builds DPS. Please feel free to check it over and submit any corrections!</p>
  <h4>SCRAM Basics</h4>
  <p>The basis of the calculations uses the SCRAM method, as follows:</p>
  <ul>
    <li>S = Primary Attribute Bonus</li>
    <li>C = Critical Hit and Critical Hit Damage</li>
    <li>R = Attacks per Second</li>
    <li>A = Average Hit</li>
    <li>M = Damage Modifiers</li>
  </ul>
  <p>Once you have all of these numbers defined, your DPS is equal to:</p>
  <pre>DPS = S * C * R * A * M</pre>
  <p>Over the course of the rest of this panel, we will be using the stats from this build in our calculations.</p>
  <h4>Calculating "S"</h4>
  <p>The {{ HTML::hb('meta.heroClass') }} uses {{ HTML::hb('stats.primary') }} as it's primary stat and this build has a total of <span data-display='long-round' data-value="primary-stat">Y</span> {{ HTML::hb('prettyStat stats.primary') }} including all gear and levels.</p>
  <pre>S = 1 + ({{ HTML::hb('stats.primary') }} * 0.01)</pre>
  <pre>S = 1 + ({{ HTML::hb('prettyStat stats.primary-stat') }} * 0.01)</pre>
  <pre>S = {{ HTML::hb('prettyStat stats.scram-s') }}</pre>
  <h4>Calculating "C"</h4>
  <p>"C" is a combination of your Critical Hit Chance as well as your Critical Hit Damage. By multiplying the increase in damage by the chance to critically hit, we come up with C.</p>
  <ul>
    <li>Critical Hit Chance: {{ HTML::hb('prettyStat stats.critical-hit') }}%</li>
    <li>Critical Hit Damage: {{ HTML::hb('prettyStat stats.critical-hit-damage') }}%</li>
  </ul>
  <pre>C = 1 + (<span>crit chance</span> * 0.01) * (<span>crit damage</span> * 0.01)</pre>
  <pre>C = 1 + ({{ HTML::hb('prettyStat stats.critical-hit') }}% * 0.01) * ({{ HTML::hb('prettyStat stats.critical-hit-damage') }}% * 0.01)</pre>
  <pre>C = {{ HTML::hb('prettyStat stats.scram-c') }}</pre>
  <h4>Calculating "R"</h4>
  <p>"R" is the rate at which you attack, including all attack speed bonuses.</p>
  <? if($isDW): ?>
  <p>When dual-wielding, you also gain a +15% Increase to your attack speed.</p>
  <ul>
    <li>Mainhand Speed: {{ HTML::hb('prettyStat stats.dps-speed-mh') }} attacks per second</li>
    <li>Offhand Speed: {{ HTML::hb('prettyStat stats.dps-speed-oh') }} attacks per second</li>
    <li>+% Attack Speed: {{ HTML::hb('prettyStat stats.attack-speed-incs') }}%</li>
    <li>Dual Wield Bonus: <span>15</span>%</li>
  </ul>
<pre>
MHAPS = MH Speed * (1 + +% Attack Speed + 0.15)
OHAPS = OH Speed * (1 + +% Attack Speed + 0.15)
R = 2 / ( 1 / MHAPS + 1 / OHAPS)
</pre>
<pre>
MHAPS = {{ HTML::hb('prettyStat stats.dps-speed-mh') }} * (1 + 0.15 + ({{ HTML::hb('prettyStat stats.attack-speed-incs') }} * 0.01))
OHAPS = {{ HTML::hb('prettyStat stats.dps-speed-oh') }} * (1 + 0.15 + ({{ HTML::hb('prettyStat stats.attack-speed-incs') }} * 0.01))
R = 2 / ( 1 / {{ HTML::hb('prettyStat stats.aps-mh') }} + 1 / {{ HTML::hb('prettyStat stats.aps-oh') }})
</pre>
<pre>R = {{ HTML::hb('prettyStat stats.scram-r') }}</pre>
  <? else: ?>
  <ul>
    <li>Mainhand Speed: {{ HTML::hb('prettyStat stats.dps-speed-mh') }} attacks per second</span></li>
    <li>+% Attack Speed: {{ HTML::hb('prettyStat stats.attack-speed-incs') }}%</li>
  </ul>
  <pre>R = Weapon Speed * (1 + % Increases);</pre>
  <pre>R = {{ HTML::hb('prettyStat stats.dps-speed-mh') }} * (1 + ({{ HTML::hb('prettyStat stats.attack-speed-incs') }} * 0.01))</pre>
  <pre>R = {{ HTML::hb('prettyStat stats.scram-r') }}</pre>
  <? endif ?>
  <h4>Calculating "A"</h4>
  <p>"A" is your average hit, this is where most of the DPS issues come into play involving +% Elemental Damage or +% Damage.</p>
  <p>We will be using the following weapons and attributes in this step:</p>
  @if($isDW)
		@include('build.section.math.dps-dw')
	@else
		@include('build.section.math.dps-1w')
	@endif
  <h4>Calculating "M"</h4>
  <p>"M" is the total bonus damage from all of your passives and abilities.</p>
  <pre>M = 1 + {{ HTML::hb('prettyStat stats.bonus-damage') }}</pre>
  <h4>Totaling it all up...</h4>
  <p>Now we just take the last number from each of the above sections and multiply them together!</p>
  <pre>DPS = S * C * R * A * M</pre>
  <pre>DPS = {{ HTML::hb('prettyStat stats.scram-s') }} * {{ HTML::hb('prettyStat stats.scram-c') }} * {{ HTML::hb('prettyStat stats.scram-r') }} * {{ HTML::hb('prettyStat stats.scram-a') }} * {{ HTML::hb('prettyStat stats.scram-m') }}</pre>
  <pre>DPS = {{ HTML::hb('prettyStat stats.dps') }}</pre>
  <h4>Help improve this!</h4>
  <p>This isn't a perfect system, I've build it based on a number of different forum posts and blogs written about how the DPS is calculated on the Character Sheet. If you see something incorrect, please correct me (<a href="mailto:aaron.cox@greymass.com">aaron.cox@greymass.com</a>)! I want this calculator to be as precise as possible, which is the main reason I'm exposing how the math is done.</p>
  <p>Feel free to use these calculations in your applications, spreadsheets or websites!</p>
</div>