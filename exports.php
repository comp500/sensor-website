<?php
require 'global.php';

if (isset($_POST['g-recaptcha-response'])) {
	echo "Well done! You submitted a form.";
} else {
	$smarty->display('exports.tpl');
}

?>