<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Starting session
session_start();

require_once '../sql.php';

// ! kill the session
// session_destroy();

require_once "../dump_anything.php";

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

    case 'GET_/admin/admin.html':
        //TODO check the role of the user
        if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == 1 && $_SESSION["role"] == "admin") {
            require "../admin/admin.html";
        }
        break;

    case 'GET_/admin/admin.php':
        if(isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] == 1) {
            require "../admin/admin.php";
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


    case "GET_/output_panier_moyen_graph.png":
        require "../output_panier_moyen_graph.png";
        break;

    case "GET_/output_category_graph.png":
        require "../output_category_graph.png";
        break;


    default:
        require "../404.html";
        break;
}
