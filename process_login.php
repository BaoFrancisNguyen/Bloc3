
<?php
// check if session is starting, run the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connection on database
$servername = "database";
$username = "bloc3";
$password = "bloc3";
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

    // Requête SQL pour récupérer le mot de passe haché de l'utilisateur
    $sql = "SELECT id, password FROM admin WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Vérification de l'existence de l'utilisateur
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Vérification du mot de passe
        if (password_verify($password, $hashed_password)) {
            // Authentification réussie
            $_SESSION["is_logged_in"] = 1;
            $_SESSION["username"] = $username;
            
            // Redirection vers la page d'administration
            header('Location: admin/admin.html');
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
