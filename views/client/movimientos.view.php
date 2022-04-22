<?php
require_once("../../template/header.php");
require_once("../../controllers/client/cliente.controller.php");
$sesion_id_usuario = '';
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Movimientos</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Consulta de Movimientos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 m-2 row">
                            <input type="hidden" value="<?= $id_usuario; ?>" name="id_usuario" id="id_usuario">
                            <div class="form-group col-4">
                                <label for="">Fecha Inicio:</label>
                                <input class="form-control inputDato" type="date" data-date-format="DD MMMM YYYY" name="fecha_inicio" id="fecha_inicio">
                            </div>

                            <div class="form-group col-4">
                                <label for="">Fecha Fin:</label>
                                <input class="form-control inputDato" type="date" data-date-format="DD MMMM YYYY" name="fecha_fin" id="fecha_fin">
                            </div>

                            <div class="form-group col-4">
                                <label for="">Cuenta:</label>
                                <select class="form-control inputDato" name="id_cuenta" id="id_cuenta" required>
                                    <option value="" selected>Seleccione la cuenta</option>
                                    <?php foreach ($cuentasActivas as $row) { ?>
                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["numero_cuenta"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <button type="button" id="btn_limpiar" class="btn btn-block btn-primary">Limpiar <i class="fas fa-times-circle"></i></button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
            <!-- Main row -->
            <!-- /.row -->
            <div class="row tabla_movimientos">

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
<script src="../../js/movimientos.js"></script>
<!-- /.content -->
<?php
require_once("../../template/footer.php");
?>