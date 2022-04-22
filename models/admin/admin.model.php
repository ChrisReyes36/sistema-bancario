<?php
require_once("../../connection/connection.php");

class ModelAdmin extends DataBase
{
    //Método Contar Tipos De Cuentas
    public function countCuentas()
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM tipo_cuenta");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Contar Clientes
    public function countClientes()
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM usuario WHERE id_rol = 2");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Contar Admins
    public function countAdmins()
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM usuario WHERE id_rol = 1");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Obtener Cuentas
    public function getCuentas()
    {
        try {
            $data = array();
            $sql = ("SELECT c.numero_cuenta, c.saldo, CONCAT(u.nombres, ' ', u.apellidos) AS cliente, tc.nombre_cuenta, c.estado FROM cuenta c
            INNER JOIN usuario u ON c.id_usuario = u.id
            INNER JOIN tipo_cuenta tc ON c.id_tipo_cuenta = tc.id");
            $stmt = $this->conn->prepare($sql);
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
    //Método Obtener Cuentas
    public function getCuentasActivas()
    {
        try {
            $data = array();
            $sql = ("SELECT c.numero_cuenta, c.saldo, CONCAT(u.nombres, ' ', u.apellidos) AS cliente, tc.nombre_cuenta, c.estado FROM cuenta c
            INNER JOIN usuario u ON c.id_usuario = u.id
            INNER JOIN tipo_cuenta tc ON c.id_tipo_cuenta = tc.id WHERE c.estado = 1");
            $stmt = $this->conn->prepare($sql);
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
    //Método Contar Usuario
    public function totalUsuarios()
    {
        try {
            $sql = ("SELECT * FROM usuario");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $this->desconectar();
            $t_rows = $stmt->rowCount();
            return $t_rows;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Obtener Usuarios
    public function getUsuarios()
    {
        try {
            $data = array();
            $sql = ("SELECT u.id, u.nombres, u.apellidos, u.dui, u.telefono, u.correo, u.fecha_nacimiento, u.usuario, u.id_rol, tr.nombre_rol AS rol FROM usuario u INNER JOIN tipo_rol tr ON u.id_rol = tr.id");
            $stmt = $this->conn->prepare($sql);
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
    //Método Obtener Cliente Por ID
    public function getUsuarioById($id)
    {
        try {
            $sql = ("SELECT u.id, u.nombres, u.apellidos, u.dui, u.telefono, u.correo, u.fecha_nacimiento, u.usuario, u.id_rol, tr.nombre_rol AS rol FROM usuario u INNER JOIN tipo_rol tr ON u.id_rol = tr.id WHERE u.id = :n1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->desconectar();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Agregar Usuario
    public function guardarUsuario($nombres, $apellidos, $dui, $telefono, $correo, $fecha_nacimiento, $usuario, $password, $id_rol)
    {
        try {
            $sql = ("INSERT INTO usuario(nombres, apellidos, dui, telefono, correo, fecha_nacimiento, usuario, password, id_rol)
                    VALUES(:n1, :n2, :n3, :n4, :n5, :n6, :n7, :n8, :n9)");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $nombres, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $apellidos, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $dui, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':n6', $fecha_nacimiento);
            $stmt->bindParam(':n7', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':n8', $password, PDO::PARAM_STR);
            $stmt->bindParam(':n9', $id_rol, PDO::PARAM_INT);
            $stmt->execute();
            echo '200';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Actualizar Usuario
    public function modificarUsuario($nombres, $apellidos, $dui, $telefono, $correo, $fecha_nacimiento, $usuario, $id_rol, $id)
    {
        try {
            $sql = ("UPDATE usuario SET nombres = :n1, apellidos = :n2, dui = :n3, telefono = :n4, correo = :n5, fecha_nacimiento = :n6, usuario = :n7, id_rol = :n8 WHERE id  = :n9");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $nombres, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $apellidos, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $dui, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':n6', $fecha_nacimiento);
            $stmt->bindParam(':n7', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':n8', $id_rol, PDO::PARAM_INT);
            $stmt->bindParam(':n9', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo '200';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Eliminar Usuario
    public function eliminarUsuario($id)
    {
        try {
            $sql = ("DELETE FROM usuario WHERE id = :n1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo '200';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Obtener Tipos de cuentas
    public function getTipoCuentas()
    {
        try {
            $data = array();
            $sql = ("SELECT * FROM tipo_cuenta");
            $stmt = $this->conn->prepare($sql);
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
    //Método Obtener Tipo de Cuenta Por ID
    public function getTipoCuentasById($id)
    {
        try {
            $sql = ("SELECT * FROM tipo_cuenta WHERE id = :n1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->desconectar();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Actualizar Interés
    public function modificarInteres($interes, $id)
    {
        try {
            $sql = ("UPDATE tipo_cuenta SET intereses = :n1 WHERE id = :n2");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $interes, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo '200';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Agregar Cuenta
    public function guardarCuenta($numero, $saldo, $usuario, $tipo_cuenta, $estado)
    {
        try {
            $sql = ("INSERT INTO cuenta(numero_cuenta, saldo, id_usuario, id_tipo_cuenta, estado) VALUES(:n1, :n2, :n3, :n4, :n5)");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $numero, PDO::PARAM_INT);
            $stmt->bindParam(':n2', $saldo);
            $stmt->bindParam(':n3', $usuario, PDO::PARAM_INT);
            $stmt->bindParam(':n4', $tipo_cuenta, PDO::PARAM_INT);
            $stmt->bindParam(':n5', $estado, PDO::PARAM_INT);
            $stmt->execute();
            echo '200';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>