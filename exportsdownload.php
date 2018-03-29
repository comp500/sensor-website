<?php
require_once 'global.php';

function outputCSV($data, $titles) {
	$titlesLength = count($titles);
	echo "Time";
	for ($i = 0; $i < $titlesLength; $i++) {
		echo "," . $titles[$i];
	}
	echo PHP_EOL;
	foreach($data as $obj_ent) {
		echo $obj_ent['recorded'];
		foreach ($obj_ent as $key => $value) {
			if (is_numeric($key)) {
				echo "," . $value;
			} else {
				// ignore
			}
		}
		echo PHP_EOL;
	}
}

function outputJSON($data, $config) {
	$output = [
		"metadata" => [],
		"data" => $data
	];
	foreach($config as $key => $value) {
		$output["metadata"][] = [
			"unit" => $value["unit"],
			"measurement" => $value["measurement"],
			"min" => $value["graphMin"],
			"max" => $value["graphMax"],
			"sensorID" => $key
		];
	}
	echo json_encode($output);
}

function queryData($obj_store, $ascending) {
	$dataArray = [];
	if ($ascending) {
		$entityArray = $obj_store->fetchAll("SELECT * FROM Measurement ORDER BY recorded ASC");
	} else {
		$entityArray = $obj_store->fetchAll("SELECT * FROM Measurement ORDER BY recorded DESC");
	}
	foreach($entityArray as $obj_ent) {
		array_push($dataArray, $obj_ent->getData());
	}
	return $dataArray;
}

function validateDates() {
	return true;
}

if (!empty($_GET['q'])) {
	$export_store = new GDS\Store('Exports');
	$export = $export_store->fetchOne("SELECT * FROM Exports WHERE id = @id", [
		'id' => $_GET['q']
	]);
	
	if ($export == NULL) {
		header('Location: /exports');
		exit;
	}
	
	if ($export->sort == "asc") {
		$data = queryData($obj_store, true);
	} else {
		$data = queryData($obj_store, false);
	}
	$titles = [];
	foreach($config as $key => $value) {
		$titles[] = $value["measurement"];
	}
	if ($export->output == 'html') {
		$smarty->assign('data', $data);
		$smarty->assign('dataLength', count($data));
		$smarty->assign('titles', $titles);
		$smarty->display('exporthtml.tpl');
	} else if ($export->output == 'json') {
		header('Content-Type: application/json');
		outputJSON($data, $config);
	} else {
		header('Content-Type: text/csv');
		outputCSV($data, $titles); // default to csv output
	}
} else {
	header('Location: /exports');
	exit;
}
