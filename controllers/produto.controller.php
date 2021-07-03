<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/Produto.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/Email.php');

session_start();
$prodClass = new Produto();

if (isset($_REQUEST['finalizar']) and isset($_REQUEST['carrinhoItens'])) {
    echo json_encode($prodClass->finalizarPedido($_REQUEST['carrinhoItens'], $_SESSION['user']['nome'], $_SESSION['user']['email']));
} elseif (isset($_REQUEST['carrinho']) and isset($_REQUEST['carrinhoIds'])) {
    echo json_encode($prodClass->carrinhoProdutos($_REQUEST['carrinhoIds']));
}
