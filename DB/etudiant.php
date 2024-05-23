<?php
class Etudiant
{

    public static function db()
    {
        try {
            return new PDO("mysql:host=localhost;dbname=TPAJAX", "root", "");
        } catch (PDOException $error) {
            die();
        }
    }

    public static function getAll()
    {
        $stmt = self::db()->prepare("select * from etudiants");
        $flag = $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
    }

    public static function get($id)
    {
        $stmt = self::db()->prepare("select * from etudiants where id = ?");
        $flag = $stmt->execute($id);
        return json_encode($stmt->fetch(PDO::FETCH_OBJ));
    }

    public static function add($id, $civilite, $nom, $prenom, $email, $photo)
    {
        $image = $photo;
        //Stores the filename as it was on the client computer.
        $imagename = $_FILES['photo']['name'];
        //Stores the filetype e.g image/jpeg
        $imagetype = $_FILES['photo']['type'];
        //Stores any error codes from the upload.
        $imageerror = $_FILES['photo']['error'];
        //Stores the tempname as it is given by the host when uploaded.
        $imagetemp = $_FILES['photo']['tmp_name'];

        //The path you wish to upload the image to
        $imagePath = "images/";

        if (is_uploaded_file($imagetemp)) {
        move_uploaded_file($imagetemp, $imagePath . $imagename);
        $stmt = self::db()->prepare("insert into etudiants values(?, ?, ?,  ?, ?, ?, ?)");
        $flag = $stmt->execute([$id, $civilite, $nom, $prenom, $email, "images/" . $imagePath . $imagename]);
        return json_encode($stmt->fetch(PDO::FETCH_OBJ));
    }

    public static function update($id)
    {
        $stmt = self::db()->prepare("select * from etudiants where id = ?");
        $flag = $stmt->execute($id);
        return json_encode($stmt->fetch(PDO::FETCH_OBJ));
    }

    public static function delete($id)
    {
        $stmt = self::db()->prepare("delete etudiants where id = ?");
        $flag = $stmt->execute($id);
        return $flag;
    }
}
