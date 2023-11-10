<?php
// Supprimez la session existante

session_unset();
session_destroy();

// Redirigez vers la page de connexion
header("Location: /");
exit();
