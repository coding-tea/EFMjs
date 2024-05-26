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
    case "store":
        Etudiant::add($_POST["civilite"], $_POST['nom'], $_POST['prenom'], $_POST["email"]);
        break;
    case "update":
        Etudiant::update($_POST["civilite"], $_POST['nom'], $_POST['prenom'], $_POST["email"], $_POST["id"]);
        break;
}
