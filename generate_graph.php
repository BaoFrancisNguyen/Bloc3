<?php

error_reporting(E_ALL);

// Vérifiez si les paramètres nécessaires sont présents
if (!isset($_GET['categorie']) || !isset($_GET['type'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Erreur: Paramètres manquants."
    ]);
    exit;
}

$categorie = $_GET['categorie'];
$type = $_GET['type'];

// Sécurisez les paramètres pour éviter les exécutions de commandes malveillantes
$categorie_escaped = escapeshellarg($categorie);
$type_escaped = escapeshellarg($type);

// Exécutez le script Python avec les paramètres sécurisés
$command = "python.exe ../generat_graph.py " . $categorie_escaped . " " . $type_escaped;
$command .= "2>&1";

$retour = exec($command, $output, $return_var);

// Renvoyez la réponse au client
echo json_encode([
    "status" => ($return_var === 0) ? "success" : "error",
    "output" => implode("\n", $output)  // Convertit le tableau de sortie en une seule chaîne
]);
