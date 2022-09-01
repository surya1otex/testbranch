function allowNumbersOnly(e) {

    var code = (e.which) ? e.which : e.keyCode;

    if (code > 31 && (code < 48 || code > 57) && code != 46) {
        e.preventDefault();
    }

}
