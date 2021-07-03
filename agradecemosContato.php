<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");

$layout = new Layout();
echo $layout->header();
?>
    <h1>Agradecemos seu contato!</h1>
    <h4>Faremos o possível para ignorar você (:</h4>
<?php
echo $layout->footer(['js/usuario.js']);
?>