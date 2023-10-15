<?php
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
        } else {
            echo "HOME PAGE";
        }
        break;
    case "POST_/login":
        require "../process_login.php";
        break;
    default:
        // TODO make a 404 page
        dump_anything("404");
        break;
}
