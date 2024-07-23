function Validar(evt) {
    var code = (evt.which) ? evt.which : evt.keyCode;
    if (code == 8 || code == 46 || (code >= 37 && code <= 40)) {
        return true;
    }

    if ((code >= 65 && code <= 90) || (code >= 97 && code <= 122)) {
        return true;
    }
    evt.preventDefault();
    return false;
}