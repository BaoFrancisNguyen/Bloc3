<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Starting session
session_start();

// ! kill the session
// session_destroy();

require_once "../dump_anything.php";

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == 1) {
    // Redirection vers la page d'administration si l'utilisateur est déjà connecté
    require "../admin/admin.html";
    exit;
}

$request_route = $_SERVER["REQUEST_METHOD"] . "_" . $_SERVER["REQUEST_URI"];

switch ($request_route) {
    case 'GET_/':
        if(!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] != 1) {
            require "../views/login.php";
        }
        
        break;
    case "POST_/login":
        require "process_login.php";
        break;
    default:
        // TODO make a 404 page
        dump_anything("404 blabla");
        break;
}
