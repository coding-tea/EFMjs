<?php 

$dsn = "mysql:host=localhost;dbname=TPAJAX";
$user = "root";
$password = "";

try{
    $db = new PDO($dsn, $user, $password);
}catch(PDOException $error){
    die();
}

$stmt = $db->prepare("select * from etudiants");
$flag = $stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

print_r($data);