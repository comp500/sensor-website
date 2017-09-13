<?php
require_once 'global.php';

$data = $obj_store->fetchOne("SELECT * FROM Measurement ORDER BY recorded DESC")->getData();
$templateData = [];
foreach($config as $key => $value) {
	$liveval = 0;
	if (isset($data[$key])) {
		$liveval = $data[$key];
	}
	$sensor = [
		"value" => $liveval,
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
