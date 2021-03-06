<?php
require_once 'global.php';

$data = $obj_store->fetchOne("SELECT * FROM Measurement ORDER BY recorded DESC")->getData();
$templateData = [];
foreach($config as $key => $value) {
	$liveval = 0;
	if (isset($data[$key])) {
		$liveval = round(floatval($data[$key]), $value["htmlDecimal"]);
	}
	$sensor = [
		"value" => $liveval,
		"unit" => $value["unit"],
		"measurement" => $value["measurement"],
		"location" => $value["location"],
		"sensorID" => $key,
		"color" => $value["color"]
	];
	if (isset($value["small"]) && $value["small"]) {
		$sensor["small"] = true;
	}
	$templateData[] = $sensor;
}

if (isset($data["recorded"])) {
	$measurementTime = time() - strtotime($data["recorded"]);
}

$smarty->assign('ready', true);
$smarty->assign('sensors', $templateData);
if (isset($measurementTime) && $measurementTime > 0) {
	$smarty->assign('measurementTime', $measurementTime);
}
$smarty->display('index.tpl');
