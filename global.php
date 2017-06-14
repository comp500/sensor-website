<?php
require_once __DIR__ . '/vendor/autoload.php';
$smarty = new Smarty(); // initialise smarty

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

?>