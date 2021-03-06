{extends file="skeleton.tpl"}
{block name=body}
	{if $ready}
	{if isset($confdata.alert)}
	<div class="alert alert-info" role="alert">
		{if isset($confdata.alertbold)}<strong>{$confdata.alertbold}</strong> {/if}{$confdata.alert}
	</div>
	{/if}
	<div class="container">
		{if isset($confdata.preface)}
		<div class="jumbotron">
			{if isset($confdata.prefacetitle)}<h1 class="display-4">{$confdata.prefacetitle}</h1>{/if}
			<p class="lead">{$confdata.preface}</p>
			{if isset($confdata.prefacebutton)}
			<p class="lead">
				<a class="btn btn-primary btn-lg" href="{$confdata.prefacehref}" role="button">{$confdata.prefacebutton}</a>
			</p>
			{/if}
			{if isset($measurementTime)}
			<p class="lead">
				System status:
					{if $measurementTime > 172800}
					<span class="text-danger">Broken (greater than two days since last recording)</span>
					{elseif $measurementTime > 3600}
					<span class="text-warning">Problematic (greater than one hour since last recording)</span>
					{elseif $measurementTime > 300}
					<span class="text-info">Slow (greater than 5 minutes since last recording)</span>
					{else}
					<span class="text-success">Fully operational</span>
					{/if}
			</p>
			{/if}
		</div>
		{else}
		{if isset($measurementTime)}
			<p>
				System status:
					{if $measurementTime > 172800}
					<span class="text-danger">Broken (greater than two days since last recording)</span>
					{elseif $measurementTime > 3600}
					<span class="text-warning">Problematic (greater than one hour since last recording)</span>
					{elseif $measurementTime > 300}
					<span class="text-info">Slow (greater than 5 minutes since last recording)</span>
					{else}
					<span class="text-success">Fully operational</span>
					{/if}
			</p>
		{/if}
		{/if}

		<h3>Latest data</h3>
		<div class="row">
			{foreach $sensors as $sensor}
			<div class="col-md-3">
				<div class="card sensor-card">
					<div class="card-block text-center">
						<h1 class="display-3" style="color: {$sensor.color}">
						{$sensor.value}{if isset($sensor.small) && $sensor.small}<strong class="small-unit">{$sensor.unit}</strong>{else}{$sensor.unit}{/if}
						</h1>
						<p class="lead">{$sensor.measurement}</p>
						<hr>
						<p class="lead">{$sensor.location}</p>
					</div>
				</div>
			</div>
			{/foreach}
		</div>
		{if isset($measurementTime)}<p class="lead">
			Data recorded <span class="measurementTime">{$measurementTime}</span> seconds ago
		</p>{/if}
		<h3>Graphs</h3>
		<div class="row">
			{foreach $sensors as $sensor}
			<div class="col-md-6">
				<div class="card">
					<div class="card-block">
						<h4 class="card-title">{$sensor.measurement}</h4>
						<h6 class="card-subtitle text-muted">Sensor {$sensor.sensorID} in {$sensor.location}</h6>
					</div>
					<div class="graph-container">
						<canvas id="graph-{$sensor.sensorID}"></canvas>
					</div>
				</div>
			</div>
			{/foreach}
		</div>
	</div>
	{else}
	<div class="alert alert-warning" role="alert">
		<strong>Warning!</strong> There is no data available yet. The server may be starting, so please wait a few minutes and try again.
	</div>
	<div class="container">
		<a href="/"><h2>Click to refresh</h2></a>
	</div>
	{/if}
{/block}
{block name=js}
	<script defer src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js" integrity="sha256-VNbX9NjQNRW+Bk02G/RO6WiTKuhncWI4Ey7LkSbE+5s=" crossorigin="anonymous"></script>
	<script defer src="static/graphloader.js"></script>
{/block}
{assign "page" "index"}