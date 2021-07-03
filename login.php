<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");

$layout = new Layout();

echo $layout->header(); ?>
    <form name="login" action="controllers/usuario.controller.php?login=true" method="post" class="shadow">
        <div class="w-75 m-auto p-4">
            <h3 class="my-4">Login</h3>
            <!-- Email -->
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" oninput="checkEmailUser(this)">

            <!-- Senha -->
            <label for="senha">Sneha</label>
            <input type="password" class="form-control" name="senha" id="senha" oninput="checkSenha(this)">

            <button class="btn btn-primary mx-auto mt-5" type="submit">Entrar</button>
        </div>
    </form>
<?php echo $layout->footer(['js/usuario.js']); ?>