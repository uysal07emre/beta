<?php

$db_host = 'localhost';
$db_name = 'test2';
$db_user = 'root';
$db_password = 'root';
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);