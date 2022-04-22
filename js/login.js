jQuery(document).on('submit', '#form-login', function (e) {
    e.preventDefault();
    const correo = $("#correo").val();
    const password = $("#password").val();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    if (correo === '' || password === '') {
        Toast.fire({
            icon: 'error',
            title: '¡Debe llenar todos los campos!'
        });
    } else {
        $.ajax({
            type: "POST",
            url: "./controllers/login.controller.php",
            data: $(this).serialize() + "&accion=btnLogin",
            dataType: "json",
            beforeSend: function () {
                $('#btnLogin').val('Verificando...');
            },
            success: function (response) {
                console.log(response);
                if (!response.error) {
                    Toast.fire({
                        icon: 'success',
                        title: '¡Datos Ingresados Correctamente!'
                    });
                    $('#btnLogin').val('Iniciar sesión');
                    if (response.rol == 1) {
                        setTimeout(function () {
                            window.location.href = './views/admin/index.view.php';
                        }, 1000);
                    } else if (response.rol == 2) {
                        setTimeout(function () {
                            window.location.href = './views/client/index.view.php';
                        }, 1000);
                    }
                } else if (response.error) {
                    Toast.fire({
                        icon: 'error',
                        title: '¡Los Datos Ingresados No Son Correctos!',
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $('#btnLogin').val('Iniciar sesión');
                    return false;
                }
            }
        });
    }
});