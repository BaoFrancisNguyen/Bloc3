<?php


// Vérifier si l'ID client existe déjà
$check_query = "SELECT id_client FROM clients WHERE id_client = '$id_client'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    echo '<script>alert("Le client est déjà existant dans la base."); window.location.href = "formulaire_client.html";</script>';
}
else
{
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

