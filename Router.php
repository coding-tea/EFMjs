<?php

require "./Controller/etudiant.php";
require "./DB/Connextion.php";

$req = $_GET["action"];

switch ($req) {
    case "getAll":
        Etudiant::getAll();
        break;
    case "get":
        Etudiant::get($_GET["id"]);
        break;
    case "delete":
        Etudiant::delete($_GET["id"]);
        break;
    case "add":
        Etudiant::get($_GET["id"]);
        break;
    case "update":
        print_r($_POST);
        // Etudiant::get($_GET["id"]);
        break;
}
