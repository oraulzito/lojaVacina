<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Produto.php");

$layout = new Layout();
$prodClass = new Produto();

echo $layout->header();

if (isset($_REQUEST['termo']) or isset($_REQUEST['categoria'])) {
    $results = [];

    if (@$_REQUEST['termo'] != '') {
        $results = $prodClass->pesquisa($_REQUEST['termo']);
    } else if (@$_REQUEST['categoria'] > 0) {
        $results = $prodClass->buscaProdutosCategoria($_REQUEST['categoria']);
    }

    if ($results != []) {
        ?>
        <ul class="list-group">
            <?php foreach ($results as $r) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <img src="<?php echo $r->imagem ?>" height="50px" width="50px">

                    <div class="ms-2 me-auto">
                        <div class="fw-bold">
                            <?php echo $r->nome ?>
                        </div>
                        <?php echo $r->descricao ?>
                        <br>
                        R$<?php echo $r->valor ?>
                    </div>
                    <span class="badge bg-primary rounded-pill"><a class="link-light"
                                                                   href="produto.php?idProd=<?php echo $r->id ?>">Ver mais</a></span>
                </li>
            <?php } ?>
        </ul>
        <?php
    } else {
        ?>
        <h1>Sua pesquisa não trouxe resultados, tente novamente</h1>
        <?php
    }
} else {
    ?>
    <h1>Sua pesquisa não contém termos, tente novamente</h1>
    <?php
}
echo $layout->footer();
?>