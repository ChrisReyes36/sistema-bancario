<?php
require_once("../../template/header.php");
function connection()
{
    $bd = array(
        'host' => 'localhost',
        'basedatos' => 'sistema_bancario',
        'usuario' => 'root',
        'pass' => ''
    );

    try {
        $connection = new PDO('mysql:host=' . $bd['host'] . ';dbname=' . $bd['basedatos'], $bd['usuario'], $bd['pass']);
        return $connection;
    } catch (PDOException $e) {
        echo "Ha ocurrido un error en la conexión: " . $e->getMessage();
        return false;
    }
}
$con = connection();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Tipos de Cuenta</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h1 class="card-title">Tipos de Cuenta</h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.modal -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive p-0" id="tabla_cuentas">

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
    <form action="" method="POST" id="form-editar-interes">
        <div class="modal fade" id="editar-interes">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title">Editar Interes</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="id_tipo_cuenta" id="id_tipo_cuenta" required>
                        <div class="form-group col-4">
                            <label for="">Tipo de Cuenta:</label>
                            <input class="form-control" type="text" name="tipo_cuenta" id="tipo_cuenta" readonly />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Interés:</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="interes_cuenta" id="interes_cuenta" placeholder="Digite el interés" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Movimientos libres:</label>
                            <input class="form-control" type="text" name="movimientos" id="movimientos" readonly />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-rigth">
                        <button type="button" id="btn_cancelar_editar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_editar" class="btn btn-primary">Modificar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../js/intereses.js"></script>
<?php
require_once("../../template/footer.php");
?>