<!DOCTYPE html>
<html>
<head>
    <title>Page Admin - GoldenLine</title>
</head>
<body>
    <h2>Ajouter un Nouvel Utilisateur</h2>
    <form action="ajouter_utilisateur.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="admin">Administrateur</option>
            <option value="user">Utilisateur</option>
        </select>
        
        <button type="submit">Ajouter Utilisateur</button>
    </form>
    <hr>

    <h2>Extraction Visuelle de la Table 'admin'</h2>
    
    <table border="1">
        <tr>
            <th>ID Utilisateur</th>
            <th>login d'Utilisateur</th>
            <th>Rôle</th>
        </tr>

<?php

// Récupération des données depuis la base de données
$sql = "SELECT id, login, role FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["login"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Aucune donnée trouvée.</td></tr>";
}

?>

    </table>
    <a href="deconnexion.php">Deconnexion</a>
</body>
</html>