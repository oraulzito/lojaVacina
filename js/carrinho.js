let carrinhoItens = localStorage.getItem('carrinho');

$(document).ready(() => {
    $("#carrinhoVazio").hide();
    $("#carrinhoErro").hide();
    let ids = [];

    if (carrinhoItens !== null) {
        carrinhoItens = JSON.parse(carrinhoItens);

        for (let i = 0; i < carrinhoItens.length; i++) {
            ids.push(carrinhoItens[i].id);
        }

        montaCarrinho(ids);
    } else {
        carrinhoItens = [];
        $("#divCarrinho").hide();
        $("#carrinhoVazio").show();
    }
});

function montaCarrinho(ids) {
    $.get('./controllers/produto.controller.php', {carrinho: true, carrinhoIds: ids}, function (data) {
        try {
            $("#carrinhoErro").hide();
            $("#divCarrinho").show();
            data = JSON.parse(data);
            for (let i = 0; i < data.length; i++) {
                var pos = Object.keys(carrinhoItens).find(key => carrinhoItens[key].id === parseInt(data[i]['id']));
                $('#carrinho tbody').append('<tr id="row' + data[i].id + '">' +
                    '<td><img src="' + data[i]['imagem'] + '" alt="img carrinho" width="50" height="50"></td>' +
                    '<td>' + data[i]['nome'] + '</td>' +
                    '<td><input type="number" min="1" value="' + carrinhoItens[pos].qtd + '" oninput="calcValor(this, ' + data[i]['valor'] + ', ' + data[i]['id'] + ', \'' + data[i]['nome'] + '\', false)"></td>' +
                    '<td id="valor' + data[i].id + '">R$' + calcValor(carrinhoItens[pos].qtd, data[i]['valor'], '', "\'" + data[i]['nome'] + "\'", true) + '</td>' +
                    '<td><button class="btn btn-danger" onclick="remover(' + data[i].id + ')">Remover</button></td>' +
                    '</tr>');

            }
        } catch (e) {
            $("#divCarrinho").hide();
            $("#carrinhoErro").show();
        }
    });
}

function calcValor(eQtd, valor, id, nome, inline = false) {
    if (inline) {
        return (eQtd * valor).toFixed(2);
    } else {
        var pos = Object.keys(carrinhoItens).find(key => carrinhoItens[key].id === parseInt(id));
        carrinhoItens[pos].qtd = $(eQtd).val();
        localStorage.setItem('carrinho', JSON.stringify(carrinhoItens));

        if (nome === 'Covaxxin') {
            $('#valor' + id).html('R$' + ($(eQtd).val() * (valor + 1)).toFixed(2));
        } else {
            $('#valor' + id).html('R$' + ($(eQtd).val() * valor).toFixed(2));
        }
    }
}

function remover(idProd) {
    var pos = Object.keys(carrinhoItens).find(key => carrinhoItens[key].id === parseInt(idProd));
    carrinhoItens.splice(pos, 1);
    if (carrinhoItens.length > 0) {
        localStorage.setItem('carrinho', JSON.stringify(carrinhoItens));
        $('#row' + idProd).remove();
    } else {
        localStorage.clear();
        $('#carrinho').hide();
        $('#carrinhoVazio').show();
    }
}

function finalizar() {
    let carrinhoItens = localStorage.getItem('carrinho');
    carrinhoItens = JSON.parse(carrinhoItens);

    $.post('./controllers/produto.controller.php', {finalizar: true, carrinhoItens: carrinhoItens}, function (data) {
        data = JSON.parse(data);
        if (data === 1) {
            localStorage.clear();
            window.location.replace('finalizacaoCarrinho.php');
        } else {
            alert('Algo deu errado!');
        }
    });

}