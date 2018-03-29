<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>{if isset($confdata.sitetitle)}{$confdata.sitetitle}{else}RPi Weather Station{/if}</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<!-- Custom styles -->
	<link href="/static/style.css" rel="stylesheet">

</head>

<body>

	<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
		<a class="navbar-brand" href="/">{if isset($confdata.sitetitle)}{$confdata.sitetitle}{else}RPi Weather Station{/if}</a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item{if $page == 'index'} active{/if}">
				<a class="nav-link" href="/">Home{if $page == 'index'} <span class="sr-only">(current)</span>{/if}</a>
			</li>
			<li class="nav-item{if $page == 'exports'} active{/if}">
				<a class="nav-link" href="/exports">Exports{if $page == 'exports'} <span class="sr-only">(current)</span>{/if}</a>
			</li>
		</ul>
	</nav>
	
	{block name=body}{/block}
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">
			{if $confdata.github}
				Source code on <a href="https://github.com/comp500/sensor-website">GitHub</a>{if isset($commitHash)}<br>Running git commit <a href="https://github.com/comp500/sensor-website/commit/{$commitHash}">{$commitHash}</a>{/if}
			{/if}
			{if isset($confdata.foottext)}
				{$confdata.foottext}{if isset($confdata.footlink)}<a href="{$confdata.foothref}">{$confdata.footlink}</a>{/if}
			{/if}
			</p>
		</div>
	</footer>
	
	{block name=js}{/block}
	{literal}
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-105993096-2', 'auto');
	  ga('send', 'pageview');

	</script>
	{/literal}
</body>

</html>
