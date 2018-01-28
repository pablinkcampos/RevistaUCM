function validateForm() {
    var s = 0;
    var nombre = document.forms["form_art"]["titulo_articulo"].value;
        nombre = nombre.toLowerCase();
        for (i = 0; i < nombre.length; i++){
            if (!(((nombre.charAt(i) >= "a") && (nombre.charAt(i) <= "z")) || (nombre.charAt(i) == "á")  || (nombre.charAt(i) == "é")  || (nombre.charAt(i) == "í")  || (nombre.charAt(i) == "ó") || (nombre.charAt(i) == " ") || (nombre.charAt(i) == "ú"))) {
                    s++;
                    swal("Titulo", "No se permiten números ni símbolos.", "warning");
                    break;
                }
            }
        if (nombre == null || nombre.length < 3 || /^\s+$/.test(nombre)){
            s++;
            swal("Nombre", "Nombre requerido, no se permiten números ni símbolos.", "warning");
            }

    if (s > 0) {
        return false;
    }
}
