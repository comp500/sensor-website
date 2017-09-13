<?php
require_once __DIR__ . '/vendor/autoload.php';

$smarty = new Smarty(); // initialise smarty

//$smarty->assign('commitHash', 'do not click this');

// set smarty directories
$smarty->setTemplateDir(__DIR__ . '/smarty/templates/');
$smarty->setConfigDir(__DIR__ . '/smarty/configs/');

if (!isset($_SERVER['DEFAULT_VERSION_HOSTNAME'])) { // check if running on google cloud
	$smarty->setCompileDir(__DIR__ . '/smarty/templates_c/');
	$smarty->setCacheDir(__DIR__ . '/smarty/cache/');
} else { // use cloud storage for compile dirs
	$smarty->setCompileDir('gs://' . $_SERVER['DEFAULT_VERSION_HOSTNAME'] . '/smarty_tmp/templates_c/');
	$smarty->setCacheDir('gs://' . $_SERVER['DEFAULT_VERSION_HOSTNAME'] . '/smarty_tmp/cache/');
}

$obj_store = new GDS\Store('Measurement');

$config = json_decode(<<<EOD
{
	"0": {
		"graphDecimal": 1,
		"exportDecimal": 1,
		"interval": 60000,
		"unit": "&#176;C",
		"measurement": "Temperature",
		"location": "Geography office",
		"htmlDecimal": 1,
		"graphMin": 0,
		"graphMax": 35
	},
	"1": {
		"graphDecimal": 0,
		"exportDecimal": 0,
		"interval": 60000,
		"unit": "%",
		"measurement": "Humidity",
		"location": "Geography office",
		"htmlDecimal": 1,
		"graphMin": 10,
		"graphMax": 95
	},
	"2": {
		"graphDecimal": 0,
		"exportDecimal": 0,
		"interval": 60000,
		"unit": "hPa",
		"small": true,
		"measurement": "Pressure",
		"location": "Geography office",
		"htmlDecimal": 0,
		"graphMin": 990,
		"graphMax": 1040
	},
	"4": {
		"graphDecimal": 0,
		"exportDecimal": 0,
		"interval": 60000,
		"unit": "lx",
		"small": true,
		"measurement": "Light",
		"location": "Geography office",
		"htmlDecimal": 0,
		"graphMin": 0,
		"graphMax": 65535
	}
}
EOD
, true);

?>
