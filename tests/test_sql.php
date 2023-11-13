<?php

$dbhost = "database"; // name of the dockerized db service
$dbuser = "bloc3";
$password = "bloc3";
$db = "bloc3";


$conn = new mysqli($dbhost, $dbuser, $password, $db);

// check the connection
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}