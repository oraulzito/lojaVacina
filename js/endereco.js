$('body').ready(function () {
    getEstados(1, true);
});

function getEstados(idPais, primeiroCarregamento) {
    $.get('./controllers/endereco.controller.php', {idPais: idPais}, function (data) {
        data = JSON.parse(data);
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                $("#uf").append('<option value=' + data[i].id + '>' + data[i].nome + '</option>');
            }

            if (primeiroCarregamento) {
                getCidades(parseInt(data[0].id));
            }
        }
    });
}

function getCidades(e) {
    let idEstado;

    if (Number.isInteger(e)) {
        idEstado = e;
    } else {
        idEstado = $(e).val();
    }

    $("#cidade").html('');

    $.get('./controllers/endereco.controller.php', {idEstado: idEstado}, function (data) {
        data = JSON.parse(data);
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                $("#cidade").append('<option value=' + data[i].id + '>' + data[i].nome + '</option>');
            }
        }
    });
}