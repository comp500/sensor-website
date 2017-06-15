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

function queryData($obj_store) {
	$dataArray = [];
	foreach($obj_store->fetchAll() as $obj_ent) { // modify based on POST params
		array_push($dataArray, $obj_ent->getData());
	}
	return $dataArray;
}

function validate() {
	return true;
}

if (!empty($_POST['g-recaptcha-response'])) {
	if (processCaptcha()) {
		if (validate()) {
			$data = queryData($obj_store);
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
