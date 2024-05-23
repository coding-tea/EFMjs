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
        $imagename = $_FILES['photo']['name'];
        $imagetype = $_FILES['photo']['type'];
        $imageerror = $_FILES['photo']['error'];
        $imagetemp = $_FILES['photo']['tmp_name'];

        $imagePath = "images/";

        if (is_uploaded_file($imagetemp))
            move_uploaded_file($imagetemp, $imagePath . $imagename);
        $stmt = self::db()->prepare("insert into etudiants values(?, ?, ?,  ?, ?, ?, ?)");
        $flag = $stmt->execute([$id, $civilite, $nom, $prenom, $email, "images/" . $imagePath . $imagename]);
        return json_encode($stmt->fetch(PDO::FETCH_OBJ));
    }

    public static function update($id, $civilite, $nom, $prenom, $email, $photo)
    {
        $stmt = self::db()->prepare("update etudiants set civilite=?, nom = ?, prenom=?, email=? where id = ?");
        $flag = $stmt->execute([$civilite, $nom, $prenom, $email, $id]);
        return json_encode($stmt->fetch(PDO::FETCH_OBJ));
    }

    public static function delete($id)
    {
        $stmt = self::db()->prepare("delete etudiants where id = ?");
        $flag = $stmt->execute($id);
        return $flag;
    }
}
