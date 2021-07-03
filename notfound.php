<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Layout.php");
$layout = new Layout();

echo $layout->header();
?>
    <h1>
        Não encontramos nada! ):
    </h1>
<?php
echo $layout->footer();
?>