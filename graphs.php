<?php
require_once 'global.php';

function queryData($obj_store, $limit) {
	$data = $obj_store->fetchAll("SELECT * FROM Measurement ORDER BY recorded DESC LIMIT @limit", [
		"limit" => $limit
	]);
	$dataArray = [];
	foreach($data as $obj_ent) {
		array_push($dataArray, $obj_ent->getData());
	}
	return array_reverse($dataArray);
}

$output = [
	"metadata" => [], 
	"values" => []
];

$average = [];
$graphLength = 200;
$data = queryData($obj_store, $graphLength);

foreach($config as $key => $value) {
	$output["metadata"][] = [
		"unit" => $value["unit"],
		"measurement" => $value["measurement"],
		"min" => $value["graphMin"],
		"max" => $value["graphMax"],
		"sensorID" => $key
	];
	$output["values"][$key] = [];
	$average[$key] = [];
}

$dataLength = count($data);
for ($i = 0; $i < $dataLength; $i++) {
	foreach($data[$i] as $key => $value) {
		if (!isset($config[$key])) {
			// ignore
		} else if (isset($average[$key])) {
			array_push($average[$key], floatval($value));
		}
	}
	if (($i % 5) == 4) { // every 5 minutes
		foreach($average as $key => $value) {
			$output["values"][$key][] = round((array_sum($value) / 5), $config[$key]["graphDecimal"]);
			$average[$key] = [];
		}
	}
}
if ($dataLength < $graphLength) {
	foreach($output["values"] as $key => &$value) {
		while (count($value) < ($graphLength / 5)) {
			array_unshift($value, NULL);
		}
	}
}

echo json_encode($output);
