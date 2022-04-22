<?php
require_once("../../models/client/cliente.model.php");
$cliente = new ModelCliente();
$sesion_id_usuario = '';
if (isset($_SESSION['id_usuario'])) {
    $sesion_id_usuario = $_SESSION['id_usuario'];
}
$dataAhorros = $cliente->countCuentasAhorros($sesion_id_usuario);
$dataPersonales = $cliente->countCuentasPersonales($sesion_id_usuario);
$dataEmpresariales = $cliente->countCuentasEmpresariales($sesion_id_usuario);
$dataDesactivadas = $cliente->countCuentasDesactivadas($sesion_id_usuario);
$cuentas = $cliente->getCuentas($sesion_id_usuario);
$cuentasActivas = $cliente->getCuentasActivas($sesion_id_usuario);
//Recepción de datos
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$hoy = date("Y-m-d H:i:s");
//Desactivar Cuenta
if ((isset($_POST["desct_id"]))) {
    $desct_id = $_POST["desct_id"];
    $cliente->desactivarCuenta($desct_id);
}
//Realizamos Dicha Acción
switch ($accion) {
    case 'btnDepositar':
        sleep(2);
        $id_cuenta = (isset($_POST["id_cuenta"])) ? $_POST["id_cuenta"] : "";
        $numero_cuenta = (isset($_POST["numero_cuenta"])) ? $_POST["numero_cuenta"] : "";
        $id_usuario = (isset($_POST["id_usuario"])) ? $_POST["id_usuario"] : "";
        $id_tipo_movimiento = (isset($_POST["id_tipo_movimiento"])) ? $_POST["id_tipo_movimiento"] : "";
        $monto = (isset($_POST["monto"])) ? $_POST["monto"] : 0;
        $id_tipo_cuenta = (isset($_POST["id_tipo_cuenta"])) ? $_POST["id_tipo_cuenta"] : "";
        $cliente->deposito($monto, $id_usuario, $id_cuenta, $id_tipo_movimiento, $numero_cuenta, $id_tipo_cuenta);
        break;

    case 'btnRetirar':
        sleep(2);
        $id_cuenta = (isset($_POST["id_cuenta"])) ? $_POST["id_cuenta"] : "";
        $numero_cuenta = (isset($_POST["numero_cuenta"])) ? $_POST["numero_cuenta"] : "";
        $id_usuario = (isset($_POST["id_usuario"])) ? $_POST["id_usuario"] : "";
        $id_tipo_movimiento = (isset($_POST["id_tipo_movimiento"])) ? $_POST["id_tipo_movimiento"] : "";
        $monto = (isset($_POST["monto"])) ? $_POST["monto"] : 0;
        $id_tipo_cuenta = (isset($_POST["id_tipo_cuenta"])) ? $_POST["id_tipo_cuenta"] : "";
        $cliente->retiro($monto, $id_usuario, $id_cuenta, $id_tipo_movimiento, $numero_cuenta, $id_tipo_cuenta);
        break;

    case 'btnConsultar':
        $consulta = true;
        $id_cuenta = (isset($_POST["id_cuenta"])) ? $_POST["id_cuenta"] : "";
        $numero_cuenta = (isset($_POST["numero_cuenta"])) ? $_POST["numero_cuenta"] : "";
        $id_usuario = (isset($_POST["id_usuario"])) ? $_POST["id_usuario"] : "";
        $id_tipo_movimiento = (isset($_POST["id_tipo_movimiento"])) ? $_POST["id_tipo_movimiento"] : "";
        $monto = (isset($_POST["monto"])) ? $_POST["monto"] : 0;
        $id_tipo_cuenta = (isset($_POST["id_tipo_cuenta"])) ? $_POST["id_tipo_cuenta"] : "";
        $cliente->insertarMovimiento($hoy, $monto, $id_tipo_movimiento, $id_cuenta, $id_usuario);
        $cliente->actualizarSaldo($numero_cuenta, $id_tipo_cuenta, $id_usuario, $id_cuenta);
        break;

    case 'movimientos':
        $output = '';
        $id_usuario = (isset($_POST["id_usuario"])) ? $_POST["id_usuario"] : "";
        $id_cuenta = (isset($_POST["id_cuenta"])) ? $_POST["id_cuenta"] : "";
        $fecha_inicio = (isset($_POST["fecha_inicio"])) ? $_POST["fecha_inicio"] : "";
        $fecha_fin = (isset($_POST["fecha_fin"])) ? $_POST["fecha_fin"] : "";
        $movimientos = $cliente->getMovimientos($id_usuario, $id_cuenta, $fecha_inicio, $fecha_fin);
        if ($movimientos) {
            $output .= '
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Movimientos del Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Fecha y Hora</th>
                                        <th>Número de Cuenta</th>
                                        <th>Monto</th>
                                        <th>Cliente</th>
                                        <th>Tipo de Movimiento</th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach ($movimientos as $row) {
                $output .= '
                                    <tr>
                                        <td>' . $row["fecha_hora"] . '</td>
                                        <td>' . $row["numero_cuenta"] . '</td>
                                        <td>$' . $row["monto"] . '</td>
                                        <td>' . $row["cliente"] . '</td>
                                        <td>' . $row["nombre_movimiento"] . '</td>
                                    </tr>';
            }
            $output .= '
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>';
        } else {
            $output .= '
            <div class="col-12">
                <div class="card alert alert-danger text-center m-1" role="alert">
                    <h4 class="alert-heading">No hay movimientos para mostrar <i class="fas fa-exclamation-triangle"></i></h4>
                </div>
            </div>
            ';
        }
        echo $output;
        break;
    default:
        break;
}
?>