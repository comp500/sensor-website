<?php
require 'global.php';

foreach($obj_store->fetchAll() as $obj_book) {
	$data = $obj_book->getData();
    echo "Temperature: {$data['0']}, Recorded: {$data['recorded']} <br />", PHP_EOL;
}