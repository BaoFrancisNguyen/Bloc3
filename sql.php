<?php

$dbhost = "database"; // name of the dockerized db service
$dbuser = "bloc3";
$password = "bloc3";
$db = "bloc3";

try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $password);
    echo "db connection works !";
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>