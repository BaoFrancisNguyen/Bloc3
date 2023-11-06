<?php

// Récupération des données depuis la base de données
$sql = "SELECT id, login, role FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';

    while ($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["login"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "</tr>";
    }
    echo '</table>';
} else {
    echo "<tr><td colspan='3'>Aucune donnée trouvée.</td></tr>";
}

