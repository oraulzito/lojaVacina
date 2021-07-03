function addCarrinho(e) {
    let carrinho = localStorage.getItem('carrinho');
    if (carrinho === null) {
        carrinho = [];
    } else {
        carrinho = JSON.parse(carrinho);
    }

    // verifica se o item já foi adicionado
    var pos = Object.keys(carrinho).find(key => carrinho[key].id === e);
    if (pos) {
        carrinho[pos].qtd = $("#qtdProd").val();
    } else {
        // se o item ainda não foi adicionado, cria um novo obj e adiciona no localStorage
        let prod = {
            id: e,
            qtd: $("#qtdProd").val(),
        };

        carrinho.push(prod);
    }

    localStorage.setItem('carrinho', JSON.stringify(carrinho));

    window.location.replace('carrinho.php');
}