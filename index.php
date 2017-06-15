<?php
require 'global.php';

$smarty->assign('ready', true);
$smarty->assign('sensors', $latest);
$smarty->assign('measurementTime', 2);
$smarty->display('index.tpl');
