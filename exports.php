<?php
require 'global.php';

function outputCSV($data) {
	foreach($data as $obj_ent) {
		echo "Temperature: {$obj_ent['0']}, Recorded: {$obj_ent['recorded']} <br />", PHP_EOL;
	}
}

function processCaptcha() {
	// no-op for now
	return true;
}

function queryData($obj_store) {
	$dataArray = array();
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
			if ($_POST['output-format'] == 'csv') {
				outputCSV($data);
			} else {
				// unexpected, not caught by validation
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
