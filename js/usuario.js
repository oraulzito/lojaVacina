$('body').ready(function () {
    $("#avisoEmailFormato").hide();
    $("#avisoEmailUso").hide();
    $("#erroTelefone").hide();
    $("#erroCep").hide();
});

//FIXME function to disable the send button form sign in
// let disabled = false;
// $('input').on('change', () => {
//     if ($('input:empty').length > 0) {
//         disabled = true;
//     }
//     $('#btnSend').prop('disabled', disabled);
// });

function criaUsuario(eve) {
    console.log($('#usuarioForm').serialize());
    eve.preventDefault();
    return false;
}

function checkEmailUser(e, contato = false) {
    if (!$(e).val().match('[A-Za-z0-9_.]+@[A-Za-z0-9]+.[A-Za-z]')) {
        $("#avisoEmailFormato").show();
    } else if (!contato) {
        $("#avisoEmailFormato").hide();

        $.get('./controllers/usuario.controller.php', {emailCheck: $(e).val()}, function (data) {
            data = JSON.parse(data);
            if (data.length > 0) {
                $("#avisoEmailUso").show();
            } else {
                $("#email").addClass('text-success');
                $("#avisoEmailUso").hide();
            }
        });
    }
}

function checkTelefone(e) {
    if (!$(e).val().match('\\(\\d{2}\\)\\d{5}-\\d{4}')) {
        $("#erroTelefone").show();
        $("#telefone").removeClass('text-success');
    } else {
        $("#erroTelefone").hide();
        $("#telefone").addClass('text-success');
    }
}

function checkCep(e) {
    if (!$(e).val().match('\\d{5}-\\d{3}')) {
        $("#erroCep").show();
        $("#telefone").removeClass('text-success');
    } else {
        $("#erroCep").hide();
        $("#cep").addClass('text-success');
    }
}

function checkSenha(e) {
    let erro = false;

    if (!$(e).val().match('(?=.*\\d)')) {
        $('#senhaDigito').removeClass('text-success')
        $('#senhaDigito').addClass('text-danger');
        erro = true;
    } else {
        $('#senhaDigito').removeClass('text-danger');
        $('#senhaDigito').addClass('text-success');
        erro = false;
    }

    if (!$(e).val().match('(?=.*[a-z])')) {
        $('#senhaMinuscula').removeClass('text-success');
        $('#senhaMinuscula').addClass('text-danger');
        erro = true;
    } else {
        $('#senhaMinuscula').removeClass('text-danger');
        $('#senhaMinuscula').addClass('text-success');
        erro = false;
    }

    if (!$(e).val().match('(?=.*[A-Z])')) {
        $('#senhaMaiuscula').removeClass('text-success');
        $('#senhaMaiuscula').addClass('text-danger');
        erro = true;
    } else {
        $('#senhaMaiuscula').removeClass('text-danger');
        $('#senhaMaiuscula').addClass('text-success');
        erro = false;
    }

    if (!$(e).val().match('(?=.*[$*&@#])')) {
        $('#senhaEspecial').removeClass('text-success');
        $('#senhaEspecial').addClass('text-danger');
        erro = true;
    } else {
        $('#senhaEspecial').removeClass('text-danger');
        $('#senhaEspecial').addClass('text-success');
        erro = false;
    }

    if (!$(e).val().match('(?=.*[$*&@#])')) {
        $('#senhaTamanho').removeClass('text-success');
        $('#senhaTamanho').addClass('text-danger');
        erro = true;
    } else {
        $('#senhaTamanho').removeClass('text-danger');
        $('#senhaTamanho').addClass('text-success');
        erro = false;
    }

    if (erro === false) {
        $('#senha').addClass('text-success');
    }
}