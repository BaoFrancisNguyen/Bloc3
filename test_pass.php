<?php
// Remplacez ceci par le mot de passe haché récupéré de la base de données.
$hashed_password_from_db = 8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918;

// Remplacez ceci par le mot de passe en clair que vous voulez vérifier.
$plain_password_to_test = admin;

// Vérification du mot de passe
if (password_verify($plain_password_to_test, $hashed_password_from_db)) {
    echo 'Le mot de passe est correct.';
} else {
    echo 'Le mot de passe est incorrect.';
}
?>
