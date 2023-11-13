<?php


// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Requête SQL pour récupérer le mot de passe haché de l'utilisateur
    $sql = "SELECT * FROM admin WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérification de l'existence de l'utilisateur
    if ($result->num_rows > 0) {
       
        $row = $result->fetch_assoc();
        $provide_password = $_POST['password'];

        // Vérification du mot de passe
        if (password_verify($provide_password, $hashed_password)) {
            // Authentification réussie
            $_SESSION["is_logged_in"] = 1;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row['role'];
            
            // Redirection vers la page d'administration
            
            if ($row['role'] == 'admin') {
                header('Location: ../admin/admin.php');
            }
            else {
                header('Location: /');
            }
            
            exit;
        } else {
            
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Nom d'utilisateur introuvable.";
    }

    $stmt->close();
}