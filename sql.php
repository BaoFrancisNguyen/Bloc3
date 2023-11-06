<?php

$martymode = true;

$dbhost = $martymode ? "127.0.0.1" : "database";
$dbuser = "bloc3";
$password = "bloc3";
$db = "bloc3";

/*
try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $password);
    echo "db connection works !";
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
*/

$conn = new mysqli($dbhost, $dbuser, $password, $db);

// check the connection
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

?>