<?php

require "./Controller/etudiant.php";
require "./Controller/etudiantDto.php";
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
    case "store":
        Etudiant::add();
        break;
    case "update":
        Etudiant::update($_POST["id"]);
        break;
    case "search":
        Etudiant::search($_POST["keyword"]);
        break;
}
