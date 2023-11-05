<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Starting session
session_start();

// ! kill the session
// session_destroy();

require_once "../dump_anything.php";

$request_route = $_SERVER["REQUEST_METHOD"] . "_" . $_SERVER["REQUEST_URI"];

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

    case "GET_/deconnexion.php":
        require "../admin/deconnexion.php";
        break;

    case "POST_/login":
        require "process_login.php";
        break;


    default:
        // TODO make a 404 page
        dump_anything("404 blabla");
        break;
}
