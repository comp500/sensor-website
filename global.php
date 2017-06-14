<?php
require_once __DIR__ . '/vendor/autoload.php';
$smarty = new Smarty(); // initialise smarty

// set smarty directories
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');
$smarty->setConfigDir(__DIR__ . '/configs/');
$smarty->setCacheDir(__DIR__ . '/cache/');


?>