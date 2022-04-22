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
                    <h1 class="m-0">Inicio</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $dataAhorros[0]; ?></h3>

                            <p>Cuentas de Ahorro</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $dataPersonales[0]; ?></h3>

                            <p>Cuentas Personales</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $dataEmpresariales[0]; ?></h3>

                            <p>Cuentas Empresariales</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $dataDesactivadas[0]; ?></h3>

                            <p>Cuentas Desactivadas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Cuentas del Cliente</h3>
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
                                            <th>Número de Cuenta</th>
                                            <th>Saldo</th>
                                            <th>Cliente</th>
                                            <th>Tipo de Cuenta</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cuentas as $row) {
                                            if ($row["estado"] == 1) {
                                                $estado = '<span class="badge badge-success">Activa</span>';
                                            } elseif ($row["estado"] == 0) {
                                                $estado = '<span class="badge badge-danger">Desactivada</span>';
                                            }
                                        ?>
                                            <tr>
                                                <td><?= $row["numero_cuenta"]; ?></td>
                                                <td>$<?= $row["saldo"]; ?></td>
                                                <td><?= $row["cliente"]; ?></td>
                                                <td><?= $row["nombre_cuenta"]; ?></td>
                                                <td><?= $estado; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $("table").DataTable({
            "lengthMenu": [[5, 10, 15, 20, 25, -1], [5, 10, 15, 20, 25, "Todos"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });
</script>
<!-- /.content -->
<?php
require_once("../../template/footer.php");
?>