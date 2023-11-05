<?php
$servername = "localhost";
$username = "bloc3";
$password = "bloc3";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $role = $_POST["role"];

    // Vérifier si l'utilisateur existe déjà
    $check_user_sql = "SELECT id FROM admin WHERE login = '$username'";
    $check_result = $conn->query($check_user_sql);
    if ($check_result->num_rows > 0) {
        echo "Cet utilisateur existe déjà dans la base de données.";
        header("Refresh: 5; URL=admin.html"); // Redirige après 5 secondes
        $conn->close();
        exit();
    }

    // Insérer dans la base de données
    $sql = "INSERT INTO admin (login, password, role) VALUES ('$username', '$hashed_password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur ajouté avec succès. Vous serez redirigé dans quelques secondes...";
        header("Refresh: 5; URL=admin.html"); // Redirige après 5 secondes
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $conn->error;
    }
}

$conn->close();
?>












Regenerate


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $role = $_POST["role"];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur ajouté avec succès. Vous serez redirigé dans quelques secondes vers la page precedente...";
        header("Refresh: 5; URL=admin.html"); // Redirige après 5 secondes
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $conn->error;
    }
}

$conn->close();
?>






