//Reporte de movimientos
const inputDato = document.querySelectorAll('.inputDato');
const tabla_movimientos = document.querySelector('.tabla_movimientos');
const btn_limpiar = document.querySelector('#btn_limpiar');

//Buscar por medio de fechas
inputDato.forEach(input => {
    input.addEventListener('change', () => {
        fecha_inicio = $('#fecha_inicio').val();
        fecha_fin = $('#fecha_fin').val();
        id_cuenta = $('select#id_cuenta').val();
        id_usuario = $('#id_usuario').val()
        accion = "movimientos";
        if (fecha_inicio != '' && fecha_fin != '' && id_cuenta != '') {
            $.ajax({
                method: 'POST',
                url: "../../controllers/client/cliente.controller.php",
                data: {
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                    id_cuenta: id_cuenta,
                    id_usuario: id_usuario,
                    accion: accion
                },
                success: (data) => {
                    tabla_movimientos.innerHTML = data;
                    $("table").DataTable({
                        "lengthMenu": [[5, 10, 15, 20, 25, -1], [5, 10, 15, 20, 25, "Todos"]],
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                        }
                    });
                }
            });
        } else {
            tabla_movimientos.innerHTML = '';
        }
    });
});
//Limpiar
btn_limpiar.addEventListener('click', () => {
    tabla_movimientos.innerHTML = '';
    inputDato.forEach(input => {
        input.value = '';
    });
});

