<?php
// Connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "fichier_clients";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_client = $_POST["id_client"];



    // Vérifier si l'ID client existe déjà
    $check_query = "SELECT id_client FROM clients WHERE id_client = '$id_client'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo '<script>alert("Le client est déjà existant dans la base."); window.location.href = "formulaire_client.html";</script>';
    } else {
        // Si l'ID client n'existe pas, insérer les données dans la base
        $nb_enfant = $_POST["nb_enfant"];
        $cat_socio_pro = $_POST["cat_socio_pro"];
        $prix_panier = $_POST["prix_panier"];
        $id_collect = $_POST["id_collect"];

        $insert_query = "INSERT INTO clients (id_client, nb_enfant, cat_socio_pro, prix_panier, id_collect) 
                         VALUES ('$id_client', '$nb_enfant', '$cat_socio_pro', '$prix_panier', '$id_collect')";

        if ($conn->query($insert_query) === TRUE) {
            echo '<script>alert("Client ajouté avec succès.");</script>';
        } else {
            echo "Erreur lors de l'ajout du client: " . $conn->error;
        }
    }

    $conn->close();
}
?>





