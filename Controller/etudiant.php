<?php

class Etudiant
{

    public static function db()
    {
        return Connection::getConnection();
    }

    public static function getAll()
    {
        print_r(json_encode(Connection::query("select * from etudiants", [], "fetchAll", PDO::FETCH_OBJ)));
    }

    public static function get($id)
    {
        print_r(json_encode(Connection::query("select * from etudiants where id = ?", [$id], "fetchAll", PDO::FETCH_OBJ)));
    }

    public static function add($civilite, $nom, $prenom, $email)
    {
        $image = "null";
        $stmt = self::db()->prepare("INSERT INTO `etudiants` (`civilite`, `nom`, `prenom`, `email`, `photo`) VALUES (?, ?, ?, ?, ?)");
        $flag = $stmt->execute([$civilite, $nom, $prenom, $email, $image]);
    }

    public static function update($id, $civilite, $nom, $prenom, $email, $photo)
    {
        $stmt = self::db()->prepare("update etudiants set civilite=?, nom = ?, prenom=?, email=? where id = ?");
        $flag = $stmt->execute([$civilite, $nom, $prenom, $email, $id]);
        return json_encode($stmt->fetch(PDO::FETCH_OBJ));
    }

    public static function delete($id)
    {
        $stmt = self::db()->prepare("delete from etudiants where id = ?");
        $flag = $stmt->execute([$id]);
        return $flag;
    }
}
