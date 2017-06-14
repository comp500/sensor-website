<?php
require 'global.php';

foreach($obj_store->fetchAll() as $obj_book) {
    echo "Temperature: {$obj_book['0']}, Recorded: {$obj_book->recorded} <br />", PHP_EOL;
}