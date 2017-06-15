<?php
require_once 'global.php';

function outputCSV($data, $titles) {
	$titlesLength = count($titles);
	echo "Time";
	for ($i = 0; $i < $titlesLength; $i++) {
		echo "," . $titles[$i];
	}
	echo "\n";
	foreach($data as $obj_ent) {
		echo $obj_ent['recorded'];
		foreach ($obj_ent as $key => $value) {
			if ($key == 'recorded') {
				// ignore
			} else {
				echo "," . $value;
			}
		}
		echo "\n";
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

function processCaptcha() {
	// no-op for now
	return true;
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

if (!empty($_POST['g-recaptcha-response'])) {
	if (processCaptcha()) {
		if (validateDates()) {
			if ($_POST['sort'] == "asc") {
				$data = queryData($obj_store, true);
			} else {
				$data = queryData($obj_store, false);
			}
			$titles = [];
			foreach($config as $key => $value) {
				$titles[] = $value["measurement"];
			}
			if ($_POST['output-format'] == 'html') {
				$smarty->assign('data', $data);
				$smarty->assign('dataLength', count($data));
				$smarty->assign('titles', $titles);
				$smarty->display('exporthtml.tpl');
			} else if ($_POST['output-format'] == 'json') {
				outputJSON($data, $config);
			} else {
				outputCSV($data, $titles); // default to csv output
			}
		} else {
			// redirect to error page?
		}
	} else {
		// redirect to error page?
	}
} else {
	$smarty->display('exports.tpl');
}
