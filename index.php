<?php
require_once 'global.php';

$templateData = [];
foreach($config as $key => $value) {
	$sensor = [
		"value" => $latest[$key],
		"unit" => $value["unit"],
		"measurement" => $value["measurement"],
		"location" => $value["location"],
		"sensorID" => $key
	];
	if (isset($value["small"]) && $value["small"]) {
		$sensor["small"] = true;
	}
	$templateData[] = $sensor;
}

$smarty->assign('ready', true);
$smarty->assign('sensors', $templateData);
$smarty->assign('measurementTime', 2);
$smarty->display('index.tpl');
