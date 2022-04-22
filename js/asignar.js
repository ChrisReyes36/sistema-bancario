$(document).ready(function () {
    getCuentasActivas();
    //Obtener Cuentas Activas
    function getCuentasActivas() {
        $.ajax({
            type: "POST",
            url: "../../controllers/admin/admin.controller.php",
            data: {
                accion: "ver_cuentas",
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
    //Agregar Cuenta
    $("#btn_guardar").click(function (e) {
        e.preventDefault();
        const numero = $("#numero").val();
        const saldo = $("#saldo").val();
        const id_usuario = $("#id_usuario").val();
        const id_tipo_cuenta = $("#id_tipo_cuenta").val();
        if (numero === '' || saldo === '' || id_usuario === '' || id_tipo_cuenta === '') {
            Swal.fire({
                title: '¡Debe llenar todos los campos!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "../../controllers/admin/admin.controller.php",
                data: $("#form-agregar-cuenta").serialize() + "&accion=insert_cuenta",
                success: function (response) {
                    if (response == '200') {
                        Swal.fire({
                            title: '¡Cuenta Agregada Correctamente!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            title: response,
                            icon: 'error'
                        });
                        return false;
                    }
                    $("#agregar-cuenta").modal("hide");
                    $("#form-agregar-cuenta")[0].reset();
                    getCuentasActivas();
                }
            });
        }
    });
    $("#btn_cancelar").click(function () {
        $("#agregar-cuenta").modal("hide");
        $("#form-agregar-cuenta")[0].reset();
    });
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }
    $("#btn_agregar").click(function () {
        const numero = getRandomInt(100000, 999999)
        $("#numero").val(numero);
    });
});