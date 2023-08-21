<?php
// Connexion à la base de données (host, username, password, database)
$connection = new mysqli('127.0.0.7', 'root', '', 'fichier_clients');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT DISTINCT cat_socio_pro FROM clients"; // Sélectionne les catégories distinctes depuis la table clients
$result = $connection->query($query);

$categories = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row['cat_socio_pro'];
    }
}

echo json_encode(["categories" => $categories]);
?>
