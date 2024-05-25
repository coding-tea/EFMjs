<?php

require "./Controller/etudiant.php";

$req = $_GET["action"];

switch($req){
    case "getAll": Etudiant::getAll(); break;
    case "get": echo Etudiant::get($_GET["id"]); break;
    case "delete": Etudiant::delete($_GET["id"]); break;
    case "add": Etudiant::get($_GET["id"]); break;
}