<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Starting session
session_start();

require_once '../sql.php';


//SCRIPT_URL plutot que REQUEST_URI : SCRIPT_URL ne contient pas les parametres GET qui peuvent etre très changeants
$request_route = $_SERVER["REQUEST_METHOD"] . "_" . $_SERVER["SCRIPT_URL"];

switch ($request_route) {

    case 'GET_/':
        if(!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] != 1) {
            require "../views/login.php";
        }
        else {
            require '../frantz_project.html';
        }
        break;

    case 'GET_/admin/admin.php':
        if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == 1 && $_SESSION["role"] == "admin") {
            require "../admin/admin.php";
        }
        break;

    case 'GET_/admin/dashboard.php':
        if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == 1 && $_SESSION["role"] == "admin") {
            require "../admin/dashboard.php";
        }
        break;

    case 'GET_/admin/index.php':
        //TODO check the role of the user
        if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == 1 && $_SESSION["role"] == "admin") {
            require "../admin/index.php";
        }
        break;


    case 'POST_/admin/ajouter_utilisateur.php':
        if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == 1 && $_SESSION["role"] == "admin") {
            require "../admin/ajouter_utilisateur.php";
        }
        break;

    case 'GET_/data/run_add_random_script.php':
        if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == 1 && $_SESSION["role"] == "admin") {
            require "../data/run_add_random_script.php";
        }
        break;

    case "GET_/get_categories.php":
        require "../get_categories.php";
        break;

    case "GET_/admin/deconnexion.php":
        require "../admin/deconnexion.php";
        break;

    case "POST_/login":
        require "process_login.php";
        break;

    case "GET_/generate_graph.php":
        require "../generate_graph.php";
        break;

    default:
        header("HTTP/1.1 404 Not Found");
        require "../404.html";
        break;
}
