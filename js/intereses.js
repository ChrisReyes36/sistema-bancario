$(document).ready(function () {
    getTipoCuenta();
    //Obtener Cuentas
    function getTipoCuenta() {
        $.ajax({
            type: "POST",
            url: "../../controllers/admin/admin.controller.php",
            data: {
                accion: "ver_tipo_cuentas",
            },
            success: function (response) {
                $("#tabla_cuentas").html(response);
                $("table").DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
            }
        });
    }
    //Obener Datos Tipo de Cuenta
    $("body").on("click", ".btnEditar", function (e) {
        e.preventDefault();
        edit_id_tipo = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "../../controllers/admin/admin.controller.php",
            data: { edit_id_tipo: edit_id_tipo },
            success: function (response) {
                console.log(response);
                data = JSON.parse(response);
                $("#id_tipo_cuenta").val(data.id);
                $("#tipo_cuenta").val(data.nombre_cuenta);
                $("#interes_cuenta").val(data.intereses);
                $("#movimientos").val(data.movimientos_libres);
            }
        });
    });
    //Editar Interés
    $("#btn_editar").click(function (e) {
        e.preventDefault();
        const interes_cuenta = $("#interes_cuenta").val();
        if (interes_cuenta === '') {
            Swal.fire({
                title: '¡Debe ingresar el interés!',
                icon: 'error'
            });
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "../../controllers/admin/admin.controller.php",
                data: $("#form-editar-interes").serialize() + "&accion=update_interes",
                success: function (response) {
                    if (response == '200') {
                        Swal.fire({
                            title: '¡Interés Modificado Correctamente!',
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
                    $("#editar-interes").modal("hide");
                    $("#form-editar-interes")[0].reset();
                    getTipoCuenta();
                }
            });
        }
    });
    $("#btn_cancelar_editar").click(function (e) {
        Swal.fire({
            title: '¡Modificación Cancelada!',
            icon: 'warning',
            showConfirmButton: false,
            timer: 1500
        });
        $("#editar-interes").modal("hide");
        $("#form-editar-interes")[0].reset();
    });
    //Ver Tipo de Cuenta
    $("body").on("click", ".btnInfo", function (e) {
        e.preventDefault();
        info_id_tipo = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "../../controllers/admin/admin.controller.php",
            data: { info_id_tipo: info_id_tipo },
            success: function (response) {
                data = JSON.parse(response);
                Swal.fire({
                    title: '<strong>Tipo de Cuenta ID: (' + data.id + ')</strong>',
                    icon: 'info',
                    html: '<b>Tipo de Cuenta: </b>' + data.nombre_cuenta +
                        '<br><b>Intereses: </b>$' + data.intereses +
                        '<br><b>Movimientos Libres: </b>' + data.movimientos_libres
                });
            }
        });
    });
});