<?php
require_once("../../template/header.php");
require_once("../../controllers/client/cliente.controller.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Cuentas</h1>
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
                <?php foreach ($cuentasActivas as $row) {
                    if ($row["estado"] == 1) {
                        $estado = '<span class="badge badge-success">Activa</span>';
                    }
                ?>
                    <div class="col-4">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title"><?= $row["nombre_cuenta"]; ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0 m-3">
                                <p><strong>Número de cuenta: </strong><?= $row["numero_cuenta"]; ?></p>
                                <p><strong>Cliente: </strong><?= $row["cliente"]; ?></p>
                                <p><strong>Estado: </strong><?= $estado ?></p>
                                <form class="m-1" action="./deposito.view.php" method="post">
                                    <input type="hidden" name="id_cuenta" value="<?= $row["id"]; ?>">
                                    <input type="hidden" name="numero_cuenta" value="<?= $row["numero_cuenta"]; ?>">
                                    <input type="hidden" name="id_usuario" value="<?= $row["id_usuario"]; ?>">
                                    <input type="hidden" name="id_tipo_cuenta" value="<?= $row["id_tipo_cuenta"]; ?>">
                                    <input type="hidden" name="saldo" value="<?= $row["saldo"]; ?>">
                                    <button type="submit" class="btn btn-block btn-primary">Depositar Dinero <i class="fas fa-dollar-sign"></i></button>
                                </form>
                                <form class="m-1" action="./retiro.view.php" method="post">
                                    <input type="hidden" name="id_cuenta" value="<?= $row["id"]; ?>">
                                    <input type="hidden" name="numero_cuenta" value="<?= $row["numero_cuenta"]; ?>">
                                    <input type="hidden" name="id_usuario" value="<?= $row["id_usuario"]; ?>">
                                    <input type="hidden" name="id_tipo_cuenta" value="<?= $row["id_tipo_cuenta"]; ?>">
                                    <input type="hidden" name="saldo" value="<?= $row["saldo"]; ?>">
                                    <button type="submit" class="btn btn-block btn-danger">Retirar Dinero <i class="fas fa-dollar-sign"></i></button>
                                </form>
                                <form class="m-1" action="./consultar.view.php" method="post">
                                    <input type="hidden" name="id_cuenta" value="<?= $row["id"]; ?>">
                                    <input type="hidden" name="numero_cuenta" value="<?= $row["numero_cuenta"]; ?>">
                                    <input type="hidden" name="id_usuario" value="<?= $row["id_usuario"]; ?>">
                                    <input type="hidden" name="id_tipo_cuenta" value="<?= $row["id_tipo_cuenta"]; ?>">
                                    <input type="hidden" name="saldo" value="<?= $row["saldo"]; ?>">
                                    <button type="submit" class="btn btn-block btn-warning">Consultar Saldo <i class="fas fa-dollar-sign"></i></button>
                                </form>
                                <div class="m-1">
                                    <a href="#" id="<?= $row["id"]; ?>" title="Desactivar Cuenta" class="btn btn-block btn-secondary btn_desactivar">
                                        Desactivar Cuenta <i class="fas fa-power-off"></i>
                                    </a>
                                </div>
                                <div class="m-1">
                                    <a class="btn btn-block btn-default" href="./index.view.php">Regresar <i class="fas fa-arrow-circle-left"></i></a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <?php } ?>
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
<script type="text/javascript">
    //Desactivar Cuenta
    $("body").on("click", ".btn_desactivar", function(e) {
        e.preventDefault();
        desct_id = $(this).attr('id');
        Swal.fire({
            title: '¿Está seguro de desactivar su cuenta?',
            text: "¡No podrá revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, desactivar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "../../controllers/client/cliente.controller.php",
                    data: {
                        desct_id: desct_id
                    },
                    success: function(response) {
                        if (response == '200') {
                            Swal.fire({
                                title: '¡Cuenta Desactivadamente Correctamente!',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                window.location.href = "./index.view.php";
                            }, 2000);
                        } else {
                            Swal.fire({
                                title: response,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                    }
                });
            }
        });
    });
</script>
<!-- /.content -->
<?php
require_once("../../template/footer.php");
?>