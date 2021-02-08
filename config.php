<?php

$databaseHost = 'localhost';
$databaseName = 'peta';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if($mysqli->connect_error){
    die("Koneksi Gagal: ".$mysqli->connect_error);
}

?>