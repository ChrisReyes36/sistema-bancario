<?php
require_once("../connection/connection.php");

class ModelLogin extends DataBase
{
    public function getUsuario($correo, $password)
    {
        try {
            $data = array();
            $sql = ("SELECT * FROM usuario WHERE correo = :n1 AND password = :n2");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $correo, PDO::PARAM_STR);
            $stmt->bindParam("n2", $password, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>