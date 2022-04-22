<?php
require_once("../../connection/connection.php");
date_default_timezone_set('America/El_Salvador');

class ModelCliente extends DataBase
{
    //Método Contar Cuentas de Ahorro
    public function countCuentasAhorros($id_usuario)
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM cuenta WHERE id_tipo_cuenta = 1 AND id_usuario = :n1 AND estado = 1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_usuario, PDO::PARAM_INT);
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
    //Método Contar Cuentas Personales
    public function countCuentasPersonales($id_usuario)
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM cuenta WHERE id_tipo_cuenta = 2 AND id_usuario = :n1 AND estado = 1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_usuario, PDO::PARAM_INT);
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
    //Método Contar Cuentas Empresariales
    public function countCuentasEmpresariales($id_usuario)
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM cuenta WHERE id_tipo_cuenta = 3 AND id_usuario = :n1 AND estado = 1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_usuario, PDO::PARAM_INT);
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
    //Método Contar Cuentas Desactivadas
    public function countCuentasDesactivadas($id_usuario)
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM cuenta WHERE estado = 0 AND id_usuario = :n1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_usuario, PDO::PARAM_INT);
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
    //Método Contar Movimientos Por Usuario
    public function countMovimientos($id_usuario, $id_cuenta)
    {
        try {
            $data = array();
            $sql = ("SELECT COUNT(id) AS total FROM movimientos WHERE id_usuario = :n1 AND id_cuenta = :n2");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam("n2", $id_cuenta, PDO::PARAM_INT);
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
    public function getCuentas($id_usuario)
    {
        try {
            $data = array();
            $sql = ("SELECT c.numero_cuenta, c.saldo, CONCAT(u.nombres, ' ', u.apellidos) AS cliente, tc.nombre_cuenta, c.estado FROM cuenta c
            INNER JOIN usuario u ON c.id_usuario = u.id
            INNER JOIN tipo_cuenta tc ON c.id_tipo_cuenta = tc.id
            WHERE c.id_usuario = :n1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_usuario, PDO::PARAM_INT);
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
    //Método Obtener Cuentas Activas
    public function getCuentasActivas($id_usuario)
    {
        try {
            $data = array();
            $sql = ("SELECT c.id, c.numero_cuenta, c.saldo, CONCAT(u.nombres, ' ', u.apellidos) AS cliente, u.id AS id_usuario, tc.nombre_cuenta, tc.id AS id_tipo_cuenta, c.estado FROM cuenta c
            INNER JOIN usuario u ON c.id_usuario = u.id
            INNER JOIN tipo_cuenta tc ON c.id_tipo_cuenta = tc.id
            WHERE c.id_usuario = :n1 AND c.estado = 1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_usuario, PDO::PARAM_INT);
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
    //Método Seleccionar Saldo
    public function getSaldo($numero_cuenta)
    {
        try {
            $data = array();
            $sql = ("SELECT saldo FROM cuenta WHERE numero_cuenta = :n1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $numero_cuenta, PDO::PARAM_INT);
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
    //Método Seleccionar Interés
    public function getInteres($id_tipo_cuenta)
    {
        try {
            $data = array();
            $sql = ("SELECT intereses FROM tipo_cuenta WHERE id = :n1");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $id_tipo_cuenta, PDO::PARAM_INT);
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
    //Método Insertar Movimiento
    public function insertarMovimiento($fecha_hora, $monto, $id_tipo_movimiento, $id_cuenta, $id_usuario)
    {
        try {
            $sql = ("INSERT INTO movimientos(fecha_hora, monto, id_tipo_movimiento, id_cuenta, id_usuario)
                    VALUES(:n1, :n2, :n3, :n4, :n5)");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $fecha_hora);
            $stmt->bindParam(':n2', $monto);
            $stmt->bindParam(':n3', $id_tipo_movimiento, PDO::PARAM_INT);
            $stmt->bindParam(':n4', $id_cuenta, PDO::PARAM_INT);
            $stmt->bindParam(':n5', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            echo 'OK';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function actualizarSaldo($numero_cuenta, $id_tipo, $id_usuario, $id_cuenta)
    {
        try {
            $saldo = $this->getSaldo($numero_cuenta);
            $interes_cuenta = $this->getInteres($id_tipo);
            $n_movimientos = $this->countMovimientos($id_usuario, $id_cuenta);
            if ($n_movimientos[0] >= 3) {
                $saldo_final = $saldo[0] - $interes_cuenta[0];
            } else {
                $saldo_final = $saldo[0];
            }
            $sql = ("UPDATE cuenta SET saldo = :n1 WHERE numero_cuenta = :n2");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $saldo_final);
            $stmt->bindParam(':n2', $numero_cuenta, PDO::PARAM_INT);
            $stmt->execute();
            echo "200";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Realizar Deposito
    public function deposito($monto, $id_usuario, $id_cuenta, $id_tipo_movimiento, $numero_cuenta, $id_tipo)
    {
        try {
            $hoy = date("Y-m-d H:i:s");
            $saldo = $this->getSaldo($numero_cuenta);
            $interes_cuenta = $this->getInteres($id_tipo);
            $n_movimientos = $this->countMovimientos($id_usuario, $id_cuenta);
            if ($n_movimientos[0] >= 3) {
                $deposito = ($saldo[0] + $monto) - $interes_cuenta[0];
            } else {
                $deposito = $saldo[0] + $monto;
            }
            $sql = ("UPDATE cuenta SET saldo = :n1 WHERE numero_cuenta = :n2");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $deposito);
            $stmt->bindParam(':n2', $numero_cuenta, PDO::PARAM_INT);
            $stmt->execute();
            $this->insertarMovimiento($hoy, $monto, $id_tipo_movimiento, $id_cuenta, $id_usuario);
            echo '200';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Realizar Retiro
    public function retiro($monto, $id_usuario, $id_cuenta, $id_tipo_movimiento, $numero_cuenta, $id_tipo)
    {
        try {
            $hoy = date("Y-m-d H:i:s");
            $saldo = $this->getSaldo($numero_cuenta);
            $interes_cuenta = $this->getInteres($id_tipo);
            $n_movimientos = $this->countMovimientos($id_usuario, $id_cuenta);
            if ($n_movimientos[0] >= 3) {
                $retiro = ($saldo[0] - $monto) - $interes_cuenta[0];
            } else {
                $retiro = $saldo[0] - $monto;
            }
            $sql = ("UPDATE cuenta SET saldo = :n1 WHERE numero_cuenta = :n2");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $retiro);
            $stmt->bindParam(':n2', $numero_cuenta, PDO::PARAM_INT);
            $stmt->execute();
            $this->insertarMovimiento($hoy, $monto, $id_tipo_movimiento, $id_cuenta, $id_usuario);
            echo '200';
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //Método Obtener Movimientos
    public function getMovimientos($id_usuario, $id_cuenta, $fecha_inicio, $fecha_fin)
    {
        try {
            $data = array();
            $sql = ("SELECT m.id, m.fecha_hora, m.monto, tm.nombre_movimiento, c.numero_cuenta, CONCAT(u.nombres, ' ', u.apellidos) AS cliente FROM movimientos m
            INNER JOIN tipo_movimiento tm ON m.id_tipo_movimiento = tm.id
            INNER JOIN cuenta c ON m.id_cuenta = c.id
            INNER JOIN usuario u ON m.id_usuario = u.id
            WHERE (DATE(m.fecha_hora) BETWEEN :n1 AND :n2) AND m.id_cuenta = :n3 AND m.id_usuario = :n4");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("n1", $fecha_inicio);
            $stmt->bindParam("n2", $fecha_fin);
            $stmt->bindParam("n3", $id_cuenta, PDO::PARAM_INT);
            $stmt->bindParam("n4", $id_usuario, PDO::PARAM_INT);
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
    //Método desactivar cuenta
    public function desactivarCuenta($id_cuenta)
    {
        try {
            $estado = 0;
            $saldo_desactivado = 0;
            $sql = ("UPDATE cuenta SET estado = :n1, saldo = :n2 WHERE id = :n3");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':n1', $estado);
            $stmt->bindParam(':n2', $saldo_desactivado, PDO::PARAM_INT);
            $stmt->bindParam(':n3', $id_cuenta, PDO::PARAM_INT);
            $stmt->execute();
            echo "200";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>