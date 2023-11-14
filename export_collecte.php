<?php
//configuration de la base de données

// Vérifiez si l'action d'exportation a été demandée
if (isset($_POST['export_data'])) {
    $rowCount = isset($_POST['row_count']) ? intval($_POST['row_count']) : 0;
    exportCollecteDataToCSV($rowCount);
}

function exportCollecteDataToCSV($rowCount) {
    // Connexion à la base de données

    require "sql.php";
    $conn = new mysqli($dbhost, $dbuser, $password, $db);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Requête pour obtenir les données
    $sql = "SELECT * FROM collectes LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rowCount);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ouvrir le fichier en écriture
        $fp = fopen('php://output', 'w');

        // En-tête pour forcer le téléchargement du fichier
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export_collecte.csv"');

        // En-tête du CSV
        fputcsv($fp, array('Collecte_id', 'Date_achat', 'Prix_panier'));

        // Ajouter les lignes de données
        while ($row = $result->fetch_assoc()) {
            fputcsv($fp, $row);
        }

        fclose($fp);
    } else {
        echo "0 résultats";
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>
