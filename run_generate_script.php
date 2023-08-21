<?php
if (!isset($_GET['categorie'])) {
    echo "Erreur: Catégorie non fournie.";
    exit;
}

$categorie = $_GET['categorie'];

$pythonPath = "C:/Users/Francis/AppData/Local/Microsoft/WindowsApps/python3.10.exe";
$scriptPath = "c:/xampp/htdocs/projet/generate_graph.py";
$command = "{$pythonPath} {$scriptPath} " . escapeshellarg($categorie);

$output = [];
$returnVar = null;
exec($command, $output, $returnVar);

echo "Command executed: {$command}<br>";
echo "Output: <br>";
foreach ($output as $line) {
    echo $line . "<br>";
}
echo "Return: " . $returnVar;
?>


