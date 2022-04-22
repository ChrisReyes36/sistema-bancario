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
                    <h1 class="m-0">Listado de Cuentas</h1>
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
                            <h3 class="card-title">Cuentas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.modal -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" id="btn_agregar" class="btn btn-success" data-toggle="modal" data-target="#agregar-cuenta">
                                Agregar Cuenta <i class="fas fa-id-card"></i>
                            </button>
                            <br>
                            <br>
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
    <form action="" method="POST" id="form-agregar-cuenta">
        <div class="modal fade" id="agregar-cuenta">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title">Asignar Cuenta a Usuario</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-3">
                            <label for="">Numero de Cuenta:</label>
                            <input class="form-control" type="text" name="numero" id="numero" readonly required />
                        </div>
                        <div class="form-group col-3">
                            <label for="">Saldo:</label>
                            <input class="form-control" type="number" min="5" step="0.01" name="saldo" id="saldo" placeholder="Digite el saldo inicial" required />
                        </div>
                        <div class="form-group col-3">
                            <label for="">Usuario:</label>
                            <select class="form-control" name="id_usuario" id="id_usuario" required>
                                <option value="" selected>Seleccione Usuario</option>
                                <?php
                                $select = $con->prepare("SELECT id, CONCAT(nombres, ' ', apellidos) as nombre_usuario FROM usuario WHERE id_rol = 2");
                                $select->execute();
                                $data = $select->fetchAll();

                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre_usuario"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="">Tipo de Cuenta:</label>
                            <select class="form-control" name="id_tipo_cuenta" id="id_tipo_cuenta" required>
                                <option value="" selected>Seleccione Tipo</option>
                                <?php
                                $select = $con->prepare("SELECT * FROM tipo_cuenta");
                                $select->execute();
                                $data = $select->fetchAll();

                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre_cuenta"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="estado" id="estado" value="1">
                    </div>
                    <div class="modal-footer justify-content-rigth">
                        <button type="button" id="btn_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_guardar" class="btn btn-primary">Guardar</button>
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
<script src="../../js/asignar.js"></script>
<?php
require_once("../../template/footer.php");
?>