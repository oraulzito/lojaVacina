<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");

$layout = new Layout();
echo $layout->header();
?>
<div class="col-8 mx-auto my-4">
    <form id="userForm" class="shadow rounded" enctype="multipart/form-data"
          action="controllers/usuario.controller.php" method="post">
        <div class="w-75 mx-auto py-4">

            <!-- Nome -->
            <label for="nome">Nome</label>
            <input required name="nome" class="form-control my-2" type="text" id="nome">

            <!-- Email -->
            <label for="email">Email</label>
            <input required name="email" class="form-control my-2" type="email" id="email" placeholder="name@example.com"
                   onblur="checkEmailUser(this)">
            <small id="avisoEmailUso" class="text-danger">Este email já está em uso<br></small>
            <small id="avisoEmailFormato" class="text-danger">O email deve estar no formato
                example@example.com<br></small>

            <!-- Senha -->
            <label for="senha">Senha</label>
            <input required name="senha" class="form-control my-2" type="password" id="senha"
                   oninput="checkSenha(this)">
            <small class="font-weight-light" id="senhaDigito">Deve ter ao menos um digito</small><br>
            <small class="font-weight-light" id="senhaMinuscula">Deve ter ao menos uma letra minuscula</small><br>
            <small class="font-weight-light" id="senhaMaiuscula">Deve ter ao menos uma letra maiuscula</small><br>
            <small class="font-weight-light" id="senhaEspecial">Deve ter ao menos um caractere especial</small><br>
            <small class="font-weight-light" id="senhaTamanho">Deve ter ao menos 8 caracteres</small><br><br>

            <!-- Telefone -->
            <label for="telefone">Telefone</label>
            <input required name="telefone" class="form-control my-2" type="text" maxlength="14" id="telefone"
                   placeholder="(xx)xxxxx-xxxx"
                   oninput="checkTelefone(this)">
            <small class="text-danger" id="erroTelefone">Deve estar no formato (xx)xxxxx-xxxx</small><br>

            <!-- Foto -->
            <label for="foto"></label>Foto
            <input name="foto" class="form-control my-2" type="file" id="foto">

            <hr>

            <!-- CEP -->
            <label for="cep">CEP</label>
            <input required name="cep" class="form-control my-2" type="text" maxlength="9" id="cep"
                   oninput="checkCep(this)">
            <small class="text-danger" id="erroCep">Deve estar no formato xxxxx-xxx</small><br>

            <!-- Rua -->
            <label for="rua">Rua</label>
            <input required name="rua" class="form-control my-2" type="text" id="rua">

            <!--Número-->
            <label for="numero">Número</label>
            <input required name="numero" class="form-control my-2" type="number" id="numero" maxlength="4" min="0" max="9999">

            <!-- Complemento-->
            <label for="complemento">Complemento</label>
            <input name="complemento" class="form-control my-2" type="text" id="complemento">

            <!-- Bairro -->
            <label for="bairro">Bairro</label>
            <input required name="bairro" class="form-control my-2" type="text" id="bairro">

            <!-- País -->
            <label for="pais">País</label>
            <select class="form-select my-2 disabled" id="pais" name="pais">
                <option value="1" selected>Brasil</option>
            </select>

            <!-- UF -->
            <label for="uf">UF</label>
            <select class="form-select my-2" id="uf" onchange="getCidades(this)" name="uf"></select>

            <!-- Cidade -->
            <label for="cidade">Cidade</label>
            <select class="form-select my-2" id="cidade" name="cidade"></select>

            <br>
            <button type="submit" class="btn btn-primary mb-4" id="btnSend">Enviar</button>
        </div>
    </form>
</div>
<?php
echo $layout->footer(['js/usuario.js', 'js/endereco.js']);
?>


