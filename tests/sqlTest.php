<?php

$dbhost = "127.0.0.1"; // name of the dockerized db service
$dbuser = "root";
$password = "password";
$db = "testdb";


$conn = new mysqli($dbhost, $dbuser, $password, $db);

// check the connection
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}