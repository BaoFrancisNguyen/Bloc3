<?php

        // Connexion à la base de données
        $servername = "database";
        $username_db = "bloc3";
        $password_db = "bloc3";
        $dbname = "bloc3";

        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données: " . $conn->connect_error);
        }

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

        $conn->close();
        ?>