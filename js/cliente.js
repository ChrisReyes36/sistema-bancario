//Depósito de saldo
jQuery(document).on('submit', '#form-deposito', function (e) {
    e.preventDefault();
    const monto = $("#monto").val();
    if (monto === '') {
        Swal.fire({
            icon: 'error',
            title: '¡Debe ingresar la cantidad a depositar!',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    } else {
        $.ajax({
            type: "POST",
            url: "../../controllers/client/cliente.controller.php",
            data: $(this).serialize() + "&accion=btnDepositar",
            beforeSend: function () {
                $('#btnDeposito').val('Depositando...');
            },
            success: function (response) {
                if (response == 'OK200') {
                    Swal.fire({
                        icon: "success",
                        title: "¡Depósito realizado correctamente!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#btnDeposito').val('Depositar Saldo');
                    setTimeout(function () {
                        window.location.href = "./cuentas.view.php";
                    }, 2000);
                } else {
                    console.log(response);
                    Swal.fire({
                        icon: 'error',
                        title: response
                    });
                    $('#btnDeposito').val('Depositar Saldo');
                    return false;
                }
            }
        });
    }
});
//Retiro de saldo
jQuery(document).on('submit', '#form-retiro', function (e) {
    e.preventDefault();
    const monto = $("#monto").val();
    if (monto === '') {
        Swal.fire({
            icon: 'error',
            title: '¡Debe ingresar la cantidad a retirar!',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    } else {
        $.ajax({
            type: "POST",
            url: "../../controllers/client/cliente.controller.php",
            data: $(this).serialize() + "&accion=btnRetirar",
            beforeSend: function () {
                $('#btnRetiro').val('Retirando...');
            },
            success: function (response) {
                if (response == 'OK200') {
                    Swal.fire({
                        icon: "success",
                        title: "¡Retiro realizado correctamente!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#btnRetiro').val('Retirar Saldo');
                    setTimeout(function () {
                        window.location.href = "./cuentas.view.php";
                    }, 2000);
                } else {
                    console.log(response);
                    Swal.fire({
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timer: 4500
                    });
                    $('#btnRetiro').val('Retirar Saldo');
                    return false;
                }
            }
        });
    }
});
//Consulta de saldo
jQuery(document).on('submit', '#form-consultar', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../../controllers/client/cliente.controller.php",
        data: $(this).serialize() + "&accion=btnConsultar",
        success: function (response) {
            if (response == 'OK200') {
                Swal.fire({
                    icon: "success",
                    title: "¡Consulta realizada correctamente!",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () {
                    window.location.href = "./cuentas.view.php";
                }, 2000);
            } else {
                console.log(response);
                Swal.fire({
                    icon: 'error',
                    title: response,
                    showConfirmButton: false,
                    timer: 4500
                });
                return false;
            }
        }
    });
});