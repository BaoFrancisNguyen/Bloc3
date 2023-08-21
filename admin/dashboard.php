<!DOCTYPE html>
<html>
<head>
    <title>Frantz Project</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Golden Line</h1>
    </header>
    <h2>Outils dashbord</h2>

    <form id="generateForm">
        <label for="dataChoice">Choisir les données :</label>
        <select id="dataChoice">
            <option value="achats">Achats</option>
            <!-- Ajoutez d'autres options ici si nécessaire -->
        </select>
        <button type="button" onclick="runGenerateScript()">Générer un graph</button>
    </form>

    <script>
        function runGenerateScript() {
            var dataChoice = document.getElementById('dataChoice').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'run_generate_script.php?data_choice=' + dataChoice, true);
            xhr.onload = function () {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        // Mettre à jour l'image à l'aide d'une nouvelle valeur de timestamp pour éviter la mise en cache
                        document.querySelector('img').src = "graph.png?" + new Date().getTime();
                    } else {
                        alert(response.message);
                    }
                }
            };
            xhr.send();
        }
    </script>
    
    <img src="graph.png?time=<?php echo time(); ?>" alt="Generated Graph">
</body>
</html>
