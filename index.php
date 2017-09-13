<?php
require_once 'global.php';

function queryData($obj_store) {
	$data = $obj_store->fetchAll("SELECT * FROM Measurement ORDER BY recorded DESC LIMIT 1");
	$dataArray = [];
	foreach($data as $obj_ent) {
		array_push($dataArray, $obj_ent->getData());
	}
	return array_reverse($dataArray);
}

$data = queryData($obj_store);
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
