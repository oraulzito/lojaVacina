<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Produto.php");

$layout = new Layout();
$prodClass = new Produto();

if (isset($_REQUEST['idProd']) and $_REQUEST['idProd'] >= 0) {
    $prod = $prodClass->buscaProduto($_REQUEST['idProd']);
    $categoria = $prodClass->buscaCategoria($prod->categoria_id);
    echo $layout->header([]);
    if (!is_bool($prod)) {
        ?>
        <div class="d-flex m-auto h-100">
            <div class="col-md-6 col-sm-12 text-center">
                <img src="<?php echo $prod->imagem; ?>" alt="imagem de vacina" width="250px">
            </div>
            <div class="col-md-6 col-sm-12">
                <h2>R$<?php echo $prod->valor; ?></h2>
                <h4><?php echo $prod->descricao; ?></h4>
                <h6>Categoria: <?php echo $categoria['nome']; ?></h6>
                <h6>Descrição categoria: <?php echo $categoria['descricao']; ?></h6>

                <label> Quantidade:
                    <input type="number" min="1" class="form-control form-control-sm" id="qtdProd" value="1">
                </label>
                <br>
                <br>
                <button class="btn btn-outline-primary" onclick="addCarrinho(<?php echo $prod->id?>)">Adicionar ao carrinho</button>
            </div>
        </div>
        <?php
    } else {
        ?>
        <h1>O produto que você procura não existe!</h1>
        <h3>Tente novamente, trocando o idProd da barra de endereços.</h3>
        <small>Pois, possivelmente, alguém não respondeu algum email.</small>
        <?php
    }
    echo $layout->footer(['js/produto.js']);
} else {
    header('Location: notfound.php');
}
?><?php
