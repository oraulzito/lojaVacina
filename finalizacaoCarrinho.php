<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Produto.php");

$layout = new Layout();
$prodClass = new Produto();

echo $layout->header([]);
?>
<h1>Você receberá um comprovante em seu e-mail</h1>
<h3>Vacina boa é vacina no braço, tome akitiver!</h3>
<h4>Este é só um trabalho acadêmico, não leve a sério</h4>
<?php
echo $layout->footer(['js/carrinho.js']);
?>
