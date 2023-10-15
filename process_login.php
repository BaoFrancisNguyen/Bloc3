<?php
// Connexion à la base de données
$servername = "localhost";
$username = "bloc3";
$password = "bloc3";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Remplacez "users" par le nom de table d'utilisateurs
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["role"] == 'admin') {
            // L'administrateur est authentifié avec succès
            session_start();
            $_SESSION["username"] = $username;
            header("Location: admin.html"); // Redirigez vers la page admin après la connexion
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

if(isset($_GET['error']) && $_GET['error'] == 'usernotfound') {
    echo '<p style="color: red;">L\'identifiant n\'existe pas. Veuillez contacter l\'administrateur.</p>';
}
?>