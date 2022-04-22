<?php
require_once("../../template/header.php");
require_once("../../controllers/client/cliente.controller.php");
$id_cuenta = (isset($_POST["id_cuenta"])) ? $_POST["id_cuenta"] : "";
$numero_cuenta = (isset($_POST["numero_cuenta"])) ? $_POST["numero_cuenta"] : "";
$id_usuario = (isset($_POST["id_usuario"])) ? $_POST["id_usuario"] : "";
$saldo = (isset($_POST["saldo"])) ? $_POST["saldo"] : "";
$id_tipo_cuenta = (isset($_POST["id_tipo_cuenta"])) ? $_POST["id_tipo_cuenta"] : "";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Consulta</h1>
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
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h3 class="card-title">Consulta de Saldo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 m-2">
                            <form class="row" action="" method="post" id="form-consultar">
                                <input type="hidden" name="id_cuenta" value="<?= $id_cuenta; ?>">
                                <input type="hidden" name="id_usuario" value="<?= $id_usuario; ?>">
                                <input type="hidden" name="id_tipo_movimiento" value="3">
                                <input type="hidden" name="id_tipo_cuenta" value="<?= $id_tipo_cuenta; ?>">
                                <div class="form-group col-6">
                                    <label for="">Número de Cuenta:</label>
                                    <input class="form-control" type="number" name="numero_cuenta" value="<?= $numero_cuenta; ?>" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label for="">Saldo de la Cuenta: "$"</label>
                                    <input class="form-control" type="number" name="saldo" value="<?= $saldo; ?>" readonly>
                                </div>

                                <div class="form-group col-12">
                                    <input value="Regresar" id="btnConsultar" type="submit" class="btn btn-block btn-primary" />
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../js/cliente.js"></script>
<!-- /.content -->
<?php
require_once("../../template/footer.php");
?>