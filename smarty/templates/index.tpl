<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="src/favicon.ico">
	<!--<link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Ubuntu" rel="stylesheet"> not used yet-->
	<title>PiWeather</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<!-- Custom styles for this template -->
	<link href="static/style.css" rel="stylesheet">

</head>

<body>

	<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
		<a class="navbar-brand" href="#">RPi Weather Station</a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="output.csv">Exports</a>
			</li>
		</ul>
	</nav>
	
	{if $ready}
	<div class="alert alert-info" role="alert">
		<strong>Heads up!</strong> This software could break at any time.
	</div>
	<div class="container">
		<h3>Latest data</h3>
		<div class="row">
			{foreach $sensors as $sensor}
			<div class="col-md-3">
				<div class="card sensor-card">
					<div class="card-block text-center">
						<h1 class="display-3">{$sensor.value}{if $sensor.small}<strong class="small-unit">{$sensor.unit}</strong>{else}{$sensor.unit}{/if}</h1>
						<p class="lead">{$sensor.measurement}</p>
						<hr>
						<p class="lead">{$sensor.location}</p>
					</div>
				</div>
			</div>
			{/foreach}
		</div>
		<p class="lead">
			Data recorded <span class="measurementTime">{$measurementTime}</span> seconds ago
		</p>
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
		<strong>Warning!</strong> There is no data available yet.
	</div>
	<div class="container">
		<a href="/"><h2>Click to refresh</h2></a>
	</div>
	{/if}
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">Source code on <a href="https://github.com/comp500/sensor-reporter">GitHub</a>{if isset($commitHash)}<br>Running git commit <a href="https://github.com/comp500/sensor-reporter/commit/{$commitHash}">{$commitHash}</a>{/if}</p>
		</div>
	</footer>
	{if $ready}
	<script defer src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js" integrity="sha256-VNbX9NjQNRW+Bk02G/RO6WiTKuhncWI4Ey7LkSbE+5s=" crossorigin="anonymous"></script>
	<script defer src="static/graphloader.js"></script>
	{/if}
</body>

</html>