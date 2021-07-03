<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/Usuario.php');

$userClass = new Usuario();

if (isset($_REQUEST['login'])) {
    $userClass->autentica();
} else if (isset($_REQUEST['emailCheck'])) {
    echo json_encode($userClass->checaEmail($_REQUEST['emailCheck']));
} else if (isset($_REQUEST['contato'])) {
    $userClass->contato($_REQUEST['nome'], $_REQUEST['email'], $_REQUEST['telefone'], $_REQUEST['mensagem'], 'Contato');
} else {
    $userClass->cria();
}