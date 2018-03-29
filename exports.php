<?php
require_once 'global.php';

function processCaptcha() {
	if (isset($conf_data) && !isset($conf_data["captchasecret"])) {
		return false; // Just to be safe
	}

	$post_data = http_build_query(
		array(
			'secret' => $conf_data["captchasecret"],
			'response' => $_POST['g-recaptcha-response'],
			'remoteip' => $_SERVER['REMOTE_ADDR']
		)
	);
	$opts = array('http' =>
		array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $post_data
		)
	);
	$context  = stream_context_create($opts);
	$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
	$result = json_decode($response);
	if (!$result->success) {
		return false;
	}

	return true;
}

function validate() {
	if ($_POST['output-format'] != "csv" && $_POST['output-format'] != "json" && $_POST['output-format'] != "html") {
		return false;
	}

	if ($_POST['sort'] != "asc" && $_POST['sort'] != "desc") {
		return false;
	}
	return true; // TODO check output format, asc/desc, date validity etc
}

if (!empty($_POST['g-recaptcha-response'])) {
	if (processCaptcha()) {
		if (validate()) {
			$export_store = new GDS\Store('Exports'); // TODO: cron job to clear old
			/*$export_store->fetchOne("SELECT * FROM Exports WHERE ascending = @asc AND output-format = @output", [
				'asc' => ($_POST['sort'] == 'asc'),
				'output' => $_POST['output-format']
			]);*/
			$id = uniqid();
			$export_ent = $export_store->createEntity([
				'id' => $id,
				'time' => new DateTime(),
				'asc' => ($_POST['sort'] == 'asc'),
				'output' => $_POST['output-format']
			]);
			$export_store->upsert($export_ent);
			header('Location: /exports/download.' . $_POST['output-format'] . '?q=' . $id);
			exit;
		} else {
			header('Location: /exports');
			exit;
		}
	} else {
		header('Location: /exports');
		exit;
	}
} else {
	$smarty->display('exports.tpl');
}
