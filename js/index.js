function pesquisa(input, event) {
    if (event.keyCode == 13) {
        event.preventDefault();
        return window.location.replace('pesquisa.php?termo=' + $(input).val());
    }
}