<?php

// Test file for DB
include '../dbhook.php';


$stmt = 'SELECT * FROM modules';

DatabaseHook::configure('./db_connect.xml');
$dbHook = DatabaseHook::getInstance();
$result = $dbHook->execute($stmt);
print_r($result);

?>