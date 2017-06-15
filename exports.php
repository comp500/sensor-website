<?php
require_once 'global.php';

function outputCSV($data, $titles) {
	echo "Time";
	$titlesLength = count($titles);
	for ($i = 0; $i < $titlesLength; $i++) {
		echo "," . $titles[i];
	}
	echo PHP_EOL;
	foreach($data as $obj_ent) {
		echo $obj_ent['recorded'];
		for ($i = 0; $i < $titlesLength; $i++) {
			echo "," . $obj_ent[(string)$i];
		}
		echo PHP_EOL;
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
