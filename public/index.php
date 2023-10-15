<?php

require_once "../dump_anything.php";

$request_route = $_SERVER["REQUEST_METHOD"] . "_" . $_SERVER["REQUEST_URI"];

switch ($request_route) {
    case 'GET_/':
        require "../views/login.php";
        break;
    case "POST_/login":
        require "../process_login.php";
        break;
    default:
        // TODO make a 404 page
        dump_anything("404");
        break;
}
