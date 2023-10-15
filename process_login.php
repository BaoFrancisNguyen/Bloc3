<?php

// Connexion à la base de données
$servername = "database";
$username = "bloc3";
$password = "bloc3";
$dbname = "bloc3";
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (\Throwable $th) {
    dump_errors($th);
    die();
}
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

$_SESSION["is_logged_in"] = 0;

// // Traitement du formulaire de connexion
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     $sql = "SELECT * FROM admin WHERE login = '$username' AND password = '$password'";
//     $result = $conn->query($sql);

//     die(var_dump($result));

    // if ($result->num_rows == 1) {
    //     $row = $result->fetch_assoc();
    //     if ($row["role"] == 'admin') {
    //         // L'administrateur est authentifié avec succès
    //         session_start();
    //         $_SESSION["username"] = $username;
    //         header("Location: admin.html"); // Redirigez vers la page admin après la connexion
    //     } else {
    //         // L'utilisateur standard est authentifié avec succès
    //         session_start();
    //         $_SESSION["username"] = $username;
    //         header("Location: index.html"); // Redirigez vers la page d'accueil après la connexion
    //     }
    // } else {
    //     // Échec de l'authentification
    //     $error_message = "Identifiant ou mot de passe incorrect.";
    // }
// }

// if(isset($_GET['error']) && $_GET['error'] == 'usernotfound') {
//     echo '<p style="color: red;">L\'identifiant n\'existe pas. Veuillez contacter l\'administrateur.</p>';
// }