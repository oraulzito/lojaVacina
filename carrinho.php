<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Produto.php");

$layout = new Layout();
$prodClass = new Produto();

echo $layout->header([]);
?>
<div class="p-3" id="divCarrinho">
    <table id="carrinho" class="table shadow">
        <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor</th>
            <th>Excluir</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <?php if (isset($_SESSION['autenticado'])) { ?>
        <button class="btn btn-primary" onclick="finalizar()">Finalizar</button>
    <?php }else { ?>
        <button class="btn btn-warning"><a href="login.php" class="link-dark">Entre para finalizar a compra</a></button>
    <?php }?>
</div>

<div id="carrinhoVazio">
    <h1>Seu carrinho está vazio, selecione algum produto e tente novamente.</h1>
</div>

<div id="carrinhoErro">
    <h1>Tivemos um erro ao carregar seu carrinho, recarregue a página.</h1>
</div>
<?php
echo $layout->footer(['js/carrinho.js']);
?>
