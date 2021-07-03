<?php
require_once('DB.php');
session_start();

class Layout
{
    public function header(array $styles = []): string
    {
        $db = new DB();
        $categorias = $db->find('categoria', '')->fetchAll(PDO::FETCH_OBJ);

        $layout = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Tá com pressa - Vaccine Store </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">                
        ';
        foreach ($styles as $s) {
            $layout .= '<link rel="stylesheet" href="' . $s . '">';
        }

        $layout .= '</head>
    <body class="d-flex flex-column mh-100 vh-100">
    <header class="p-3 mb-3 border-bottom shadow">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start">
                <a href="index.php">
                    <img src="data:image/png;base64,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"
                         alt="SUS" height="50vh">
                </a>

                <ul class="nav col-12 col-md-auto me-md-auto mb-2 justify-content-center mb-md-0">
                   
                </ul>

                <form class="col-12 col-md-auto mb-3 mb-md-0 me-md-3">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search" onkeypress="pesquisa(this, event)">                    
                </form>
                
                <div class="dropdown">
                  <button class="btn btn-outline-dark dropdown-toggle me-md-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
        foreach ($categorias as $c) {
            $layout .= ' <li><a class="dropdown-item">' . $c->nome . '</a></li>';
        }
        $layout .= ' </ul>
                   </div>';

        if (isset($_SESSION['autenticado'])) {
            $layout .= '<button class="btn btn-outline-info me-md-3"><img src="' . $_SESSION['user']['foto'] . '" width="25px"> <a href="#" class="text-decoration-none link-info">' . $_SESSION['user']['nome'] . '</a></button>
                        <button class="btn btn-outline-success me-md-3"><a href="carrinho.php" class="text-decoration-none link-success">Carrinho</a></button>
                        <button class="btn btn-outline-warning"><a href="logout.php" class="text-decoration-none link-warning">Sair</a></button>';
        } else {
            $layout .= '
                    <button class="btn btn-outline-success me-md-3"><a href="cadastro.php" class="text-decoration-none link-success">Criar Conta</a></button>
                    <button class="btn btn-outline-warning"><a href="login.php" class="text-decoration-none link-warning">Entrar</a></button>';
        }
        $layout .= '  </div>
                    </div>
                </header>
                <div class="container flex-shrink-1 m-auto">
                    <div class="row">';

        return $layout;
    }

    public function footer(array $scripts = []): string
    {
        $layout = '    </div>
              </div>
              <footer class="footer mt-auto py-1 bg-light">
                <div class="text-center">
                    <a href="https://ifrs.edu.br/canoas" class="link-info">2021 - IFRS Campus Canoas</a>
                    <br>
                    <a href="https://github.com/oraulzito/web2" class="link-dark">Raul Lacerda</a>
                    <br>
                    <a href="contato.php" class="link-dark">Fale conosco</a>
                </div>
            </footer>
            <script rel="script" src="js/bootstrap.js"></script>                        
            <script rel="script" src="js/bootstrap.bundle.js"></script>                    
            <script rel="script" src="js/index.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';

        foreach ($scripts as $s) {
            $layout .= '<script rel="script" src="' . $s . '"></script>';
        }
        $layout .= '</body>';
        return $layout;
    }
}

?>