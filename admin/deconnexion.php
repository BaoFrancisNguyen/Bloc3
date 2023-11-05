<?php
// Supprimez la session existante
session_start();
session_unset();
session_destroy();

// Redirigez vers la page de connexion
require "../public/index.php";
exit();
?>