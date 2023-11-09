<?php
ob_start(); //activer la mise en tampon de sortie

$username = $_POST["username"];
$password = $_POST["password"];
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$role = $_POST["role"];

// Vérifier si l'utilisateur existe déjà
$check_user_sql = "SELECT id FROM admin WHERE login = '$username'";
$check_result = $conn->query($check_user_sql);

if ($check_result->num_rows > 0) {
    echo "Cet utilisateur existe déjà dans la base de données.";
    header("Refresh: 5; URL=/admin/admin.php"); // Redirige après 5 secondes
    $conn->close();
    exit();
}

// Insérer dans la base de données
$sql = "INSERT INTO admin (login, password, role) VALUES ('$username', '$hashed_password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Utilisateur ajouté avec succès. Vous serez redirigé dans quelques secondes...";
    header("Refresh: 5; URL=/admin/admin.php"); // Redirige après 5 secondes
    exit();
} else {
    echo "Erreur lors de l'ajout de l'utilisateur: " . $conn->error;
}


