<?php
require_once 'global.php';

function processCaptcha() {
	// no-op for now
	return true;
}

function validate() {
	return true;
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
			$export_ent = $obj_book_store->createEntity([
				'id' => $id,
				'time' => new DateTime(),
				'asc' => ($_POST['sort'] == 'asc'),
				'output' => $_POST['output-format']
			]);
			$export_store->insert($export_ent);
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
