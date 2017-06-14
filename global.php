<?php
require_once __DIR__ . '/vendor/autoload.php';
$smarty = new Smarty(); // initialise smarty

// set smarty directories
$smarty->setTemplateDir(__DIR__ . '/smarty/templates/');
$smarty->setCompileDir(__DIR__ . '/smarty/templates_c/');
$smarty->setConfigDir(__DIR__ . '/smarty/configs/');
$smarty->setCacheDir(__DIR__ . '/smarty/cache/');


?>