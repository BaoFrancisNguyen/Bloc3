<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// check if session is starting, run the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../dump_anything.php";

// Connection on database
$servername = "database";
$username_db = "bloc3";
$password_db = "bloc3";
$dbname = "bloc3";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// check the connection
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    //dump_anything($username);
    //dump_anything($password);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //dump_anything($hashed_password);
/*
    // Préparation de la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO admin (login, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password); // Utilisez $hashed_password ici
    $stmt->execute();
*/

    // Requête SQL pour récupérer le mot de passe haché de l'utilisateur
    $sql = "SELECT * FROM admin WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    //dump_anything($result);

    // Vérification de l'existence de l'utilisateur
    if ($result->num_rows > 0) {
       //TODO get the password from the result
       
    $row = $result->fetch_assoc();

    //dump_anything($hashed_password);
        $provide_password = $_POST['password'];
        // Vérification du mot de passe
        if (password_verify($provide_password, $hashed_password)) {
            // Authentification réussie
            $_SESSION["is_logged_in"] = 1;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row['role'];
            
    
            // Redirection vers la page d'administration
            header('Location: ../admin/admin.html');
            exit;
        } else {
            
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Nom d'utilisateur introuvable.";
    }

    $stmt->close();
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
