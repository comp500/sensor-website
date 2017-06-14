<?php
require_once __DIR__ . '/vendor/autoload.php';
$smarty = new Smarty(); // initialise smarty

// set smarty directories
$smarty->setTemplateDir(__DIR__ . '/smarty/templates/');
$smarty->setConfigDir(__DIR__ . '/smarty/configs/');

if (getenv("GAE_INSTANCE") == false) { // check if running on google cloud
	$smarty->setCompileDir(__DIR__ . '/smarty/templates_c/');
	$smarty->setCacheDir(__DIR__ . '/smarty/cache/');
} else { // use cloud storage for compile dirs
	$smarty->setCompileDir('gs://' . getenv("GCLOUD_PROJECT") . '/smarty_tmp/templates_c/');
	$smarty->setCacheDir('gs://' . getenv("GCLOUD_PROJECT") . '/smarty_tmp/cache/');
}

?>