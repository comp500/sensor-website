<?php
require 'global.php';

foreach($obj_store->fetchAll() as $obj_book) {
    echo "Title: {$obj_book->time}, ISBN: {$obj_book->isbn} <br />", PHP_EOL;
}