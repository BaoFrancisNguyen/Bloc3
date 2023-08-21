<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=127.0.0.1;dbname=fichier_clients", "root", "");

// Récupérer les catégories socio-professionnelles distinctes
$query = $pdo->query("SELECT DISTINCT cat_socio_pro FROM clients");

// Créer un tableau associatif des catégories
$categories = [];
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $categories[] = $row['cat_socio_pro'];
}

// Renvoyer les catégories au format JSON
echo json_encode($categories);
?>



