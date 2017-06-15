<?php

$export_store = new GDS\Store('Exports');

// delete ALL exports entites
$arr_exports = $export_store->fetchAll();
$export_store->delete($arr_exports);