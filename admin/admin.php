<?php

        // Connexion à la base de données
        $servername = "127.0.0.1        ";
        $username = "root";
        $password = "";
        $dbname = "fichier_employes";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données: " . $conn->connect_error);
        }

        // Récupération des données depuis la base de données
        $sql = "SELECT id_user, username, role FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_user"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["role"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Aucune donnée trouvée.</td></tr>";
        }

        $conn->close();
        ?>