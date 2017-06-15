<?php
require_once 'global.php';

function outputCSV($data, $titles) {
	foreach($data as $obj_ent) {
		echo "Temperature: {$obj_ent['0']}, Recorded: {$obj_ent['recorded']} <br />", PHP_EOL;
	}
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
	foreach($entityArray as $obj_ent) { // modify based on POST params
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
				$smarty->assign('titles', $titles);
				$smarty->display('exporthtml.tpl');
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
