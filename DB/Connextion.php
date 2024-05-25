<?php

class Connection
{
    static $db = null;

    private function __construct()
    {
        $this->getConnection();
    }

    public static function getConnection()
    {
        if (Connection::$db == null) {
            try {
                $env = parse_ini_file('.env');
                $dsn = $env["dbms"] . ":host=" . $env["host"] . ";dbname=" . $env["database"];
                Connection::$db = new PDO($dsn, $env["username"], $env["password"]);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return Connection::$db;
    }

    public static function query($sql = "", $args = [], $fetchtype = "fetch", $type = PDO::FETCH_OBJ)
    {
        $stmt = Connection::getConnection()->prepare($sql);
        $flag = $stmt->execute($args);
        $data = [];
        if ($flag) {
            switch ($fetchtype) {
                case "fetch":
                    $data = $stmt->fetch($type);
                    break;
                case "fetchAll":
                    $data = $stmt->fetchAll($type);
                    break;
            }
        }
        return $data;
    }
}
