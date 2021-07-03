<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");
$erroEnvio = @$_REQUEST['erroEnvio'];
$layout = new Layout();
echo $layout->header();

if ($erroEnvio) {
    ?>
    <h5 class="text-danger">Houve um erro, tente novamente</h5>
    <?php
}
?>
    <div class="col-8 mx-auto my-4">
        <h2>Preencha os dados e nos informe o que passa</h2>
        <small>Tudo <s>não</s> será apurado</small>
        <form method="post" class="shadow rounded" action="controllers/usuario.controller.php?contato=true">
            <div class="w-75 mx-auto py-4">
                <label for="nome">Nome:</label>
                <input class="form-control" type="text" name="nome" required>
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email" required>
                <small id="avisoEmailFormato" class="text-danger">Email não está no formato example@me.com</small>
                <label for="telefone">Telefone:</label>
                <input class="form-control" type="text" name="telefone" id="telefone" required>
                <small id="erroTelefone" class="text-danger">Telefone não está no formato (XX)xxxxx-xxxx</small>
                <label for="descricao">Descrição:</label>
                <input class="form-control" type="text" name="mensagem" min="5" required>
                <br>
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
<?php
echo $layout->footer(['js/usuario.js']);
?>