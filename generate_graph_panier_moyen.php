<?php
if (!isset($_GET['categorie'])) {
    echo "Erreur: Catégorie non fournie.";
    exit;
}

$categorie = $_GET['categorie'];
$command = "python3.10 generate_graph.py " . escapeshellarg($categorie) . " prix_panier";
exec($command, $output, $return);

echo "Command executed: " . $command . "<br>";
foreach ($output as $line) {
    echo $line . "<br>";
}
echo "Return: " . $return;
?>


