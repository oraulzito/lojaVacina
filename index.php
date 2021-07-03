<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Produto.php");

$layout = new Layout();
$prodClass = new Produto();

$prods = $prodClass->lista();

echo $layout->header();
if (!is_bool($prods)) {
    ?>
    <h2>Produtos em destaque</h2>
    <?php
    foreach ($prods as $p) {
        ?>
        <div class="card mx-auto my-4" style="width: 18rem;">
            <img src="<?php echo $p['imagem'] ?>" class="card-img-top" alt="produto">
            <div class="card-body">
                <h5 class="card-title"><?php echo $p['nome'] ?></h5>
                <p class="card-text"><?php echo $p['descricao'] ?></p>
                <a href="produto.php?idProd=<?php echo $p['id'] ?>" class="btn btn-primary">Ver mais</a>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <h1>Hmmm, estamos sem produtos!</h1>
    <h3>Tente novamente, uma hora respondem.</h3>
    <small>Vai responde não pura?!.</small>
    <?php
}
echo $layout->footer();
?>