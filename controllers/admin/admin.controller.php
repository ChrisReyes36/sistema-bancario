<?php
require_once("../../models/admin/admin.model.php");
$admin = new ModelAdmin();
$datosTipos = $admin->countCuentas();
$datosClientes = $admin->countClientes();
$datosAdmins = $admin->countAdmins();
$cuentas = $admin->getCuentas();
//Parámetros
$nombres = (isset($_POST["nombres"])) ? $_POST["nombres"] : "";
$apellidos = (isset($_POST["apellidos"])) ? $_POST["apellidos"] : "";
$usuario = strtolower($nombres) . "." . strtolower($apellidos);
$telefono = (isset($_POST["telefono"])) ? $_POST["telefono"] : "";
$correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";
$fecha_nacimiento = (isset($_POST["fecha_nacimiento"])) ? $_POST["fecha_nacimiento"] : "";
$dui = (isset($_POST["dui"])) ? $_POST["dui"] : "";
$password = (isset($_POST["password"])) ? $_POST["password"] : "";
$password = md5(md5($password));
$id_rol = (isset($_POST["id_rol"])) ? $_POST["id_rol"] : "";
$id_usuario = (isset($_POST["id_usuario"])) ? $_POST["id_usuario"] : "";
$id_usuario_ocultar = (isset($_POST["id_usuario_ocultar"])) ? $_POST["id_usuario_ocultar"] : "";
$interes_cuenta = (isset($_POST["interes_cuenta"])) ? $_POST["interes_cuenta"] : "";
$id_tipo_cuenta = (isset($_POST["id_tipo_cuenta"])) ? $_POST["id_tipo_cuenta"] : "";
$numero = (isset($_POST["numero"])) ? $_POST["numero"] : "";
$estado = (isset($_POST["estado"])) ? $_POST["estado"] : "";
$saldo = (isset($_POST["saldo"])) ? $_POST["saldo"] : "";
//Obtener Usuarios
if ((isset($_POST["accion"])) && ($_POST["accion"]) == "ver") {
    $output = '';
    $usuarios = $admin->getUsuarios();
    if ($admin->totalUsuarios() > 0) {
        $output .= '
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DUI</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Fecha Nacimiento</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($usuarios as $row) {
            $val = '';
            if ($row["id"] == $id_usuario_ocultar) {
                $val = 'hidden';
            } else {
                $val = '';
            }
            $output .= '
                    <tr ' . $val . '>
                        <td>' . $row["nombres"] . '</td>
                        <td>' . $row["apellidos"] . '</td>
                        <td>' . $row["dui"] . '</td>
                        <td>' . $row["telefono"] . '</td>
                        <td>' . $row["correo"] . '</td>
                        <td>' . $row["fecha_nacimiento"] . '</td>
                        <td>' . $row["usuario"] . '</td>
                        <td>' . $row["rol"] . '</td>
                        <td>
                            <a href="#" id="' . $row["id"] . '" title="Ver Información" class="text-warning btnInfo"><li class="fas fa-info-circle fa-lg"></li></a>&nbsp;
                            <a href="#" id="' . $row["id"] . '" title="Modificar" class="text-primary btnEditar" data-toggle="modal" data-target="#editar-usuario"><li class="fas fa-edit fa-lg"></li></a>&nbsp;
                            <a href="#" id="' . $row["id"] . '" title="Eliminar" class="text-danger btnEliminar"><li class="fas fa-trash-alt fa-lg"></li></a>
                        </td>
                    </tr>';
        }
        $output .= '
            </tbody>
        </table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary">No hay ningún usuario registrado</h3>';
    }
}
//Agregar Usuario
if ((isset($_POST["accion"])) && ($_POST["accion"]) == "insert") {
    $admin->guardarUsuario($nombres, $apellidos, $dui, $telefono, $correo, $fecha_nacimiento, $usuario, $password, $id_rol);
}
//Obtener Un Usuario Para Editar
if ((isset($_POST["edit_id"]))) {
    $edit_id = $_POST["edit_id"];
    $row = $admin->getUsuarioById($edit_id);
    echo json_encode($row);
}
//Editar Usuario
if ((isset($_POST["accion"])) && ($_POST["accion"]) == "update") {
    $admin->modificarUsuario($nombres, $apellidos, $dui, $telefono, $correo, $fecha_nacimiento, $usuario, $id_rol, $id_usuario);
}
//Eliminar Usuario
if ((isset($_POST["del_id"]))) {
    $del_id = $_POST["del_id"];
    $admin->eliminarUsuario($del_id);
}
//Obtener Un Usuario Para Mostrar
if ((isset($_POST["info_id"]))) {
    $info_id = $_POST["info_id"];
    $row = $admin->getUsuarioById($info_id);
    echo json_encode($row);
}
//Obtener Tipos de Cuentas
if ((isset($_POST["accion"])) && ($_POST["accion"]) == "ver_tipo_cuentas") {
    $output = '';
    $tipos_cuentas = $admin->getTipoCuentas();
    $output .= '
        <table class="table table-hover text-nowrap text-center">
            <thead>
                <tr>
                    <th>Tipo de Cuenta</th>
                    <th>Intereses</th>
                    <th>Movimiento Libres</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($tipos_cuentas as $row) {
        $interes_formato = '';
        $interes_formato = number_format($row["intereses"], 2, '.', '');
        $output .= '
                    <tr>
                        <td>' . $row["nombre_cuenta"] . '</td>
                        <td>$' . $interes_formato . '</td>
                        <td>' . $row["movimientos_libres"] . '</td>
                        <td>
                            <a href="#" id="' . $row["id"] . '" title="Ver Información" class="btn btn-outline-danger btnInfo"><li class="fas fa-info-circle fa-lg"></li></a>&nbsp;
                            <a href="#" id="' . $row["id"] . '" title="Modificar" class="btn btn-outline-primary btnEditar" data-toggle="modal" data-target="#editar-interes"><li class="fas fa-edit fa-lg"></li></a>&nbsp;
                        </td>
                    </tr>';
    }
    $output .= '
            </tbody>
        </table>';
    echo $output;
}
//Obtener Tipo de Cuenta Para Editar
if ((isset($_POST["edit_id_tipo"]))) {
    $edit_id_tipo = $_POST["edit_id_tipo"];
    $row = $admin->getTipoCuentasById($edit_id_tipo);
    echo json_encode($row);
}
//Editar Interés
if ((isset($_POST["accion"])) && ($_POST["accion"]) == "update_interes") {
    $admin->modificarInteres($interes_cuenta, $id_tipo_cuenta);
}
//Obtener Tipo de Cuenta Para Mostrar
if ((isset($_POST["info_id_tipo"]))) {
    $info_id_tipo = $_POST["info_id_tipo"];
    $row = $admin->getTipoCuentasById($info_id_tipo);
    echo json_encode($row);
}
//Obtener Cuentas Activas
if ((isset($_POST["accion"])) && ($_POST["accion"]) == "ver_cuentas") {
    $output = '';
    $cuentas_activas = $admin->getCuentasActivas();
    $output .= '
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Número de Cuenta</th>
                    <th>Saldo</th>
                    <th>Cliente</th>
                    <th>Tipo de Cuenta</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($cuentas_activas as $row) {
        if ($row["estado"] == 1) {
            $estado = '<span class="badge badge-success">Activa</span>';
        }
        $output .= '
                <tr>
                    <td>' . $row["numero_cuenta"] . '</td>
                    <td>$' . $row["saldo"] . '</td>
                    <td>' . $row["cliente"] . '</td>
                    <td>' . $row["nombre_cuenta"] . '</td>
                    <td>' . $estado . '</td>
                </tr>';
    }
    $output .= '
            </tbody>
        </table>';
    echo $output;
}
//Agregar Usuario
if ((isset($_POST["accion"])) && ($_POST["accion"]) == "insert_cuenta") {
    $admin->guardarCuenta($numero, $saldo, $id_usuario, $id_tipo_cuenta, $estado);
}
?>