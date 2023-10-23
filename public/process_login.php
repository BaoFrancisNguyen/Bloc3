<?php

// Connexion à la base de données
$servername = "database";
$username = "bloc3";
$password = "bloc3";
$dbname = "bloc3";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Utilisation de requêtes préparées pour prévenir les injections SQL
    $sql = "SELECT * FROM admin WHERE login = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["role"] == 'admin') {
            // L'administrateur est authentifié avec succès
            session_start();
            $_SESSION["username"] = $username;
            header("Location: admin/admin.html"); // Redirigez vers la page admin après la connexion
        } else {
            // L'utilisateur standard est authentifié avec succès
            session_start();
            $_SESSION["username"] = $username;
            header("Location: index.html"); // Redirigez vers la page d'accueil après la connexion
        }
    } else {
        // Échec de l'authentification
        $error_message = "Identifiant ou mot de passe incorrect.";
    }
}

if (isset($_GET['error']) && $_GET['error'] == 'usernotfound') {
    echo '<p style="color: red;">L\'identifiant n\'existe pas. Veuillez contacter l\'administrateur.</p>';
}
?>
