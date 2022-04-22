//Url Actual
let url = window.location.href;
//Elementos de li
const tabs = ["index", "cuentas", "movimientos", "usuarios", "asignar"];
tabs.forEach(e => {
    //Agregamos el tipo de arcchivo (.php) que contiene la URL
    if (url.indexOf(e + ".view.php") !== -1) {
        //Agregar tab- para hacer que coincida la Id
        setActive("tab-" + e);
    }
});
if (url.indexOf("deposito.view.php") !== -1 || url.indexOf("retiro.view.php") !== -1 || url.indexOf("consultar.view.php") !== -1) {
    setActive("tab-cuentas");
}
//Función que asigna la clase active
function setActive(id) {
    document.getElementById(id).setAttribute("class", "nav-link active");
}