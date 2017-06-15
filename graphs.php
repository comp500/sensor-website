<?php
require_once 'global.php';

$output = [
	"metadata" => [], 
	"values" => []
];

foreach($config as $key => $value) {
	$output["metadata"][] = [
		"unit" => $value["unit"],
		"measurement" => $value["measurement"],
		"min" => $value["graphMin"],
		"max" => $value["graphMax"],
		"sensorID" => $key
	];
	$output["values"][$key] = [];
	for ($i = 0; $i < 40; $i++) {
		$output["values"][$key][] = $i;
	}
}

echo json_encode($output);