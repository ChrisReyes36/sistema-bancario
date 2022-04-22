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
                    <h1 class="m-0">Usuarios</h1>
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
                            <h3 class="card-title">Lista de Usuarios</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar-usuario">
                                Agregar Usuario <i class="fas fa-user-plus"></i>
                            </button>
                            <br>
                            <br>
                            <input type="hidden" name="id_usuario_ocultar" id="id_usuario_ocultar" value="<?= $_SESSION['id_usuario']; ?>">
                            <div class="table-responsive p-0" id="tabla_usuarios">

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
    <form action="" method="POST" id="form-agregar-usuario">
        <div class="modal fade" id="agregar-usuario">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title">Agregar Usuario</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-4">
                            <label for="">Nombres:</label>
                            <input class="form-control" type="text" name="nombres" id="nombres" placeholder="Digite su nombre" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Apellidos:</label>
                            <input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="Digite su apellido" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">DUI:</label>
                            <input class="form-control" type="text" name="dui" id="dui" maxlength="10" placeholder="Digite su DUI" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Teléfono:</label>
                            <input class="form-control" type="text" name="telefono" id="telefono" maxlength="9" placeholder="Digite su teléfono" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Correo:</label>
                            <input class="form-control" type="email" name="correo" id="correo" placeholder="Digite su correo" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Fecha de Nacimiento:</label>
                            <input class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Contraseña</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Digite su contraseña" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Rol:</label>
                            <select class="form-control" name="id_rol" id="id_rol" required>
                                <option value="" selected>Seleccione Rol</option>
                                <?php
                                $select = $con->prepare("SELECT * FROM tipo_rol");
                                $select->execute();
                                $data = $select->fetchAll();

                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre_rol"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
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
    <form action="" method="POST" id="form-editar-usuario">
        <div class="modal fade" id="editar-usuario">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title">Editar Usuario</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="id_usuario" id="id_usuario" required>
                        <div class="form-group col-4">
                            <label for="">Nombres:</label>
                            <input class="form-control" type="text" name="nombres" id="nombres_editar" placeholder="Digite su nombre" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Apellidos:</label>
                            <input class="form-control" type="text" name="apellidos" id="apellidos_editar" placeholder="Digite su apellido" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">DUI:</label>
                            <input class="form-control" type="text" name="dui" id="dui_editar" maxlength="10" placeholder="Digite su DUI" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Teléfono:</label>
                            <input class="form-control" type="text" name="telefono" id="telefono_editar" maxlength="9" placeholder="Digite su teléfono" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Correo:</label>
                            <input class="form-control" type="email" name="correo" id="correo_editar" placeholder="Digite su correo" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Fecha de Nacimiento:</label>
                            <input class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento_editar" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="">Rol:</label>
                            <select class="form-control" name="id_rol" id="id_rol_editar" required>
                                <option value="" selected>Seleccione Rol</option>
                                <?php
                                $select = $con->prepare("SELECT * FROM tipo_rol");
                                $select->execute();
                                $data = $select->fetchAll();

                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre_rol"]; ?></option>
                                <?php } ?>
                            </select>
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
<script src="../../js/usuarios.js"></script>
<?php
require_once("../../template/footer.php");
?>