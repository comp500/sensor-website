<?php
require 'global.php';

$smarty->assign('ready', true);
$smarty->assign('sensors', [
	0 => [
		'value' => '99.9',
		'unit' => 'arb.',
		'small' => true,
		'measurement' => 'Arbitrary Units',
		'location' => 'The Cloud',
		'sensorID' => 0
	]
]);
$smarty->assign('measurementTime', 2);
$smarty->assign('commitHash', 'do not click this');
$smarty->display('index.tpl');

?>