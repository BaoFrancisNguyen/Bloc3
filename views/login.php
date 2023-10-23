<!DOCTYPE html>
<html>
    <head>
        <title>Connexion - GoldenLine</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .login-container {
                background-color: #fff;
                padding: 2rem;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .login-container label {
                display: block;
                margin-bottom: 0.5rem;
            }

            .login-container input {
                width: 100%;
                padding: 0.5rem;
                margin-bottom: 1rem;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            .login-container button {
                background-color: #333;
                color: #fff;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 3px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <header style="text-align: center;">
            <h1>GoldenLine</h1>
            <img src="personnes-floues.jpg" alt="Image de fond" style="margin-left: -30%; width: 120%;">
        </header>
        <div class="login-container">
            <h2>Connexion</h2>
            <form action="../public/process_login.php" method="post">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Se Connecter</button>
            </form>
        </div>
    </body>
</html>