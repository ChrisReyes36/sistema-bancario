<?php
class DataBase
{
    private $dsn = "mysql:host=localhost;dbname=sistema_bancario";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->pass);
            return $this->conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function desconectar()
    {
        $this->conn = null;
        return $this->conn;
    }
}
?>