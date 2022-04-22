$(document).ready(function () {
    var expresion_dui = new RegExp("^[0]{1}[0-9]{7}[-][0-9]{1}$");
    var expresion_telefono = new RegExp("^[7||2][0-9]{3}[-][0-9]{4}$");
    var expresion_nom_ape = new RegExp("^[A-ZÁÉÍÓÚÜÑ]{1}[a-záéíóúüñ]{1,30}$");
    getUsuarios();
    //Obtener Usuarios
    function getUsuarios() {
        const id_usuario_ocultar = $("#id_usuario_ocultar").val();
        $.ajax({
            type: "POST",
            url: "../../controllers/admin/admin.controller.php",
            data: {
                accion: "ver",
                id_usuario_ocultar: id_usuario_ocultar
            },
            success: function (response) {
                $("#tabla_usuarios").html(response);
                $("table").DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            }
        });
    }
    //Agregar Usuario
    $("#btn_guardar").click(function (e) {
        e.preventDefault();
        const nombres = $("#nombres").val();
        const apellidos = $("#apellidos").val();
        const dui = $("#dui").val();
        const telefono = $("#telefono").val();
        const correo = $("#correo").val();
        const fecha_nacimiento = $("#fecha_nacimiento").val();
        const password = $("#password").val();
        const id_rol = $("#id_rol").val();
        if (nombres === '' || apellidos === '' || dui === '' || telefono === '' || correo === '' || fecha_nacimiento === '' || password === '' || id_rol === '') {
            Swal.fire({
                title: '¡Debe llenar todos los campos!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_dui.test(dui)) {
            Swal.fire({
                title: '¡El formato de DUI es incorrecto!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_telefono.test(telefono)) {
            Swal.fire({
                title: '¡El formato de teléfono es incorrecto!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_nom_ape.test(nombres)) {
            Swal.fire({
                title: '¡Solo debe ingresar un nombre!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_nom_ape.test(apellidos)) {
            Swal.fire({
                title: '¡Solo debe ingresar un apellido!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "../../controllers/admin/admin.controller.php",
                data: $("#form-agregar-usuario").serialize() + "&accion=insert",
                success: function (response) {
                    if (response == '200') {
                        Swal.fire({
                            title: '¡Usuario Agregado Correctamente!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            title: response,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    $("#agregar-usuario").modal("hide");
                    $("#form-agregar-usuario")[0].reset();
                    getUsuarios();
                }
            });
        }
    });
    $("#btn_cancelar").click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¡Operación Cancelada!',
            icon: 'warning',
            showConfirmButton: false,
            timer: 1500
        });
        $("#agregar-usuario").modal("hide");
        $("#form-agregar-usuario")[0].reset();
    });
    //Obener Datos Usuarios
    $("body").on("click", ".btnEditar", function (e) {
        e.preventDefault();
        edit_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "../../controllers/admin/admin.controller.php",
            data: { edit_id: edit_id },
            success: function (response) {
                data = JSON.parse(response);
                $("#id_usuario").val(data.id);
                $("#nombres_editar").val(data.nombres);
                $("#apellidos_editar").val(data.apellidos);
                $("#telefono_editar").val(data.telefono);
                $("#correo_editar").val(data.correo);
                $("#dui_editar").val(data.dui);
                $("#fecha_nacimiento_editar").val(data.fecha_nacimiento);
                $("#id_rol_editar").val(data.id_rol);
            }
        });
    });
    $("#btn_editar").click(function (e) {
        e.preventDefault();
        const nombres_editar = $("#nombres_editar").val();
        const apellidos_editar = $("#apellidos_editar").val();
        const dui_editar = $("#dui_editar").val();
        const telefono_editar = $("#telefono_editar").val();
        const correo_editar = $("#correo_editar").val();
        const fecha_nacimiento_editar = $("#fecha_nacimiento_editar").val();
        const id_rol_editar = $("#id_rol_editar").val();
        if (nombres_editar === '' || apellidos_editar === '' || dui_editar === '' || telefono_editar === '' || correo_editar === '' || fecha_nacimiento_editar === '' || id_rol_editar === '') {
            Swal.fire({
                title: '¡Debe llenar todos los campos!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_dui.test(dui_editar)) {
            Swal.fire({
                title: '¡El formato de DUI es incorrecto!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_telefono.test(telefono_editar)) {
            Swal.fire({
                title: '¡El formato de teléfono es incorrecto!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_nom_ape.test(nombres_editar)) {
            Swal.fire({
                title: '¡Solo debe ingresar un nombre!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else if (!expresion_nom_ape.test(apellidos_editar)) {
            Swal.fire({
                title: '¡Solo debe ingresar un apellido!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "../../controllers/admin/admin.controller.php",
                data: $("#form-editar-usuario").serialize() + "&accion=update",
                success: function (response) {
                    if (response == '200') {
                        Swal.fire({
                            title: '¡Usuario Modificado Correctamente!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            title: response,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    $("#editar-usuario").modal("hide");
                    $("#form-editar-usuario")[0].reset();
                    getUsuarios();
                }
            });
        }
    });
    $("#btn_cancelar_editar").click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¡Modificación Cancelada!',
            icon: 'warning',
            showConfirmButton: false,
            timer: 1500
        });
        $("#editar-usuario").modal("hide");
        $("#form-editar-usuario")[0].reset();
    });
    //Eliminar Usuario
    $("body").on("click", ".btnEliminar", function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        del_id = $(this).attr('id');
        Swal.fire({
            title: '¿Está seguro de eliminar el cliente?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, bórralo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "../../controllers/admin/admin.controller.php",
                    data: { del_id: del_id },
                    success: function (response) {
                        if (response == '200') {
                            Swal.fire({
                                title: '¡Usuario Eliminado Correctamente!',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            tr.css('background-color', '#ff6666');
                        } else {
                            Swal.fire({
                                title: response,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        getUsuarios();
                    }
                });
            }
        });
    });
    //Ver Usuario
    $("body").on("click", ".btnInfo", function (e) {
        e.preventDefault();
        info_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "../../controllers/admin/admin.controller.php",
            data: { info_id: info_id },
            success: function (response) {
                data = JSON.parse(response);
                Swal.fire({
                    title: '<strong>Información Usuario ID: (' + data.id + ')</strong>',
                    icon: 'info',
                    html: '<b>Nombres: </b>' + data.nombres +
                        '<br><b>Apellidos: </b>' + data.apellidos +
                        '<br><b>DUI: </b>' + data.dui +
                        '<br><b>Teléfono: </b>' + data.telefono +
                        '<br><b>Correo: </b>' + data.correo +
                        '<br><b>Fecha Nacimiento: </b>' + data.fecha_nacimiento +
                        '<br><b>Usuario: </b>' + data.usuario +
                        '<br><b>Rol: </b>' + data.rol
                });
            }
        });
    });
});