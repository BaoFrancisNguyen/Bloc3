<?php
if (!isset($_GET['categorie'])) {
    echo "Erreur: Catégorie non fournie.";
    exit;
}

$categorie = $_GET['categorie'];
$command = "python3.10 c:/xampp/htdocs/projet/generate_graph.py " . escapeshellarg($categorie) . " panier_moyen";
exec($command, $output, $return);

echo "Command executed: " . $command . "<br>";
foreach ($output as $line) {
    echo $line . "<br>";
}
echo "Return: " . $return;
?>
