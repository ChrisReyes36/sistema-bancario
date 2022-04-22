<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header("location:../../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Bancario</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!--DataTables-->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./index.php" class="nav-link">Inicio</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <form action="../../controllers/login.controller.php" method="post">
                    <button type="submit" value="btnCerrar" name="accion" class="btn btn-outline-dark">Cerrar Sesión</a>
                </form>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a style="cursor:default" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Sistema Bancario</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a style="cursor:default" class="d-block"><?= $_SESSION["nombres"] . " " . $_SESSION["apellidos"] ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <?php if ($_SESSION['rol'] == 1) { ?>
                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Administrador
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./index.view.php" class="nav-link" id="tab-index">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inicio</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./usuarios.view.php" class="nav-link" id="tab-usuarios">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./cuentas.view.php" class="nav-link" id="tab-cuentas">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tipos de Cuenta</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./asignar.view.php" class="nav-link" id="tab-asignar">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Asignar Cuentas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['rol'] == 2) { ?>
                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>
                                        Cliente
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./index.view.php" class="nav-link" id="tab-index">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inicio</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./cuentas.view.php" class="nav-link" id="tab-cuentas">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cuentas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./movimientos.view.php" class="nav-link" id="tab-movimientos">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Movimientos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>