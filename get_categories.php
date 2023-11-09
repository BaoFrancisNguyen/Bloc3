<?php


$query = "SELECT DISTINCT cat_socio_pro FROM clients"; // Sélectionne les catégories distinctes depuis la table clients
$result = $conn->query($query);

$categories = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row['cat_socio_pro'];
    }
}

echo json_encode(["categories" => $categories]);
