<?php
require_once("../models/login.model.php");
$login = new ModelLogin();
//Recepción de parámetros
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";
$password = (isset($_POST["password"])) ? $_POST["password"] : "";
$password = md5(md5($password));
//Procesos
switch ($accion) {
    case 'btnLogin':
        sleep(1);
        $datos = $login->getUsuario($correo, $password);
        if ($datos) {
            foreach ($datos as $row) {
                session_start();
                $_SESSION['id_usuario'] = $row["id"];
                $_SESSION['nombres'] = $row["nombres"];
                $_SESSION['apellidos'] = $row["apellidos"];
                $_SESSION['dui'] = $row["dui"];
                $_SESSION['correo'] = $row["correo"];
                $_SESSION['usuario'] = $row["usuario"];
                $_SESSION['rol'] = $row["id_rol"];
                echo json_encode(array("error" => false, "rol" => $row["id_rol"]));
            }
        } else {
            echo json_encode(array("error" => true));
        }
        break;

    case 'btnCerrar':
        session_start();
        session_unset();
        session_destroy();
        header("location:../index.php");
        break;

    default:

        break;
}
?>