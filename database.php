<?php

$server = 'fdb27.125mb.com:3306';
$username = '3785630_stressy';
$password = 'Iot2021_01';
$database = '3785630_stressy';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
 die('Connection Failed: ' . $e->getMessage());
}

?>
