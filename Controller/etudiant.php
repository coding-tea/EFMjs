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

    public static function update($civilite, $nom, $prenom, $email, $id)
    {
        $stmt = self::db()->prepare("UPDATE `etudiants` SET `civilite` = ?, `nom` = ?, `prenom` = ?, `email` = ? WHERE `etudiants`.`id` = ?");
        $flag = $stmt->execute([$civilite, $nom, $prenom, $email, $id]);
    }

    public static function delete($id)
    {
        $stmt = self::db()->prepare("delete from etudiants where id = ?");
        $flag = $stmt->execute([$id]);
        return $flag;
    }
}
