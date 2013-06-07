<style type="text/css" media="screen">
	.quick-stats {
		margin-bottom: 0;
	}
	.quick-stats th,
	.quick-stats td {
		line-height: 1em;
		text-align: center;
		padding: 2px 20px;
	}
	.quick-stats .dps,
	.quick-stats .ehp {
		display: block;
		font-weight: bold;
		font-size: 1.4em;
		line-height: 1em;
		color: #eee;
	}
	.quick-stats .dps {
		color: #F50;
	}
	.quick-stats .ehp {
		color: #5F0;
	}
</style>
<table class="table build-stats quick-stats">
	<thead>
		<tr>
			<th>DPS</th>
			<th>EHP</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<span class="dps">{{ HTML::hb('prettyStat stats.dps.dps "dps"') }}</span>
			</td>
			<td>
				<span class="ehp">{{ HTML::hb('prettyStat stats.ehp.ehp "ehp"') }}</span>
			</td>
		</tr>
	</tbody>	
</table>