<?php
// Supprimez la session existante
session_start();
session_unset();
session_destroy();

// Redirigez vers la page de connexion
header("Location: ../public/index.php");
exit();
?>