<?php
require_once('Endereco.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/Email.php');
session_start();

class Usuario
{
    private string $id;
    private string $nome;
    private string $email;
    private string $foto;
    private string $senha;
    private string $telefone;
    private Endereco $endereco;

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }

    function checaEmail(string $email)
    {
        $db = new DB();
        $email = '\'%' . $email . '%\'';
        return $db->find('usuario', 'email LIKE ' . $email);
    }

    function contato(string $nome, string $emailRemetente, string $telefone, string $mensagem, string $assunto)
    {
        $email = new Email();
        $mensagem .= '<br>' . $telefone . ' - ' . $emailRemetente;
        if ($email->enviaEmail($assunto, $mensagem, $nome, $emailRemetente)) {
            header('Location: ../agradecemosContato.php');
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?erroEnvio=true');
        }

    }

    function autentica()
    {
        if (@$_REQUEST['email'] !== '' and @$_REQUEST['senha'] !== '') {
            $db = new DB();

            // FIXME fetch object endereco?
            $result = $db->findFirst('usuario', 'email = \'' . $_REQUEST['email'] . '\'')->fetchObject('endereco');

            if (password_verify($_REQUEST['senha'], $result->senha)) {
                $_SESSION['autenticado'] = true;
                $_SESSION['user']['nome'] = $result->nome;
                $_SESSION['user']['email'] = $result->email;
                $_SESSION['user']['foto'] = $result->foto;
                $_SESSION['user']['telefone'] = $result->telefone;
                header('Location: ../index.php');
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    function cria()
    {
        if (@$_REQUEST['nome'] !== '' and @$_REQUEST['email'] !== '' and @$_REQUEST['senha'] !== '' and @$_REQUEST['telefone'] !== '' and @$_REQUEST['cep'] !== '' and @$_REQUEST['rua'] !== '' and @$_REQUEST['bairro'] !== '' and @$_REQUEST['cidade'] !== '' and @$_REQUEST['uf'] !== '' and @$_REQUEST['pais'] !== '' and @$_REQUEST['numero'] != '') {
            $nome = $_REQUEST['nome'];
            $email = $_REQUEST['email'];

            $fotoInvalida = false;

            if (isset($_FILES['foto'])) {
                if ($_FILES['foto']['type'] == 'image/gif'
                    || $_FILES['foto']['type'] == 'image/jpeg'
                    || $_FILES['foto']['type'] == 'image/jpg'
                    || $_FILES['foto']['type'] == 'image/png') {
                    $data = file_get_contents($_FILES['foto']['tmp_name']);
                    $foto = 'data:image/' . $_FILES['foto']['type'] . ';base64,' . base64_encode($data);
                } else {
                    $fotoInvalida = true;
                }
            } else {
                $fotoInvalida = true;
            }

            if ($fotoInvalida) {
                $foto = "data:image/png;base64,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";
            }

            $senha = password_hash($_REQUEST['senha'], PASSWORD_DEFAULT);
            $telefone = $_REQUEST['telefone'];
            $cep = $_REQUEST['cep'];
            $rua = $_REQUEST['rua'];
            $bairro = $_REQUEST['bairro'];
            $cidade = $_REQUEST['cidade'];
            $uf = $_REQUEST['uf'];
            $pais = $_REQUEST['pais'];
            $numero = $_REQUEST['numero'];
            $complemento = $_REQUEST['complemento'];

            $db = new DB();
            $result = $db->insert('usuario', 'nome, email, senha, telefone, cep, rua, bairro, cidade, uf, pais, numero, complemento, foto', [$nome, $email, $senha, $telefone, $cep, $rua, $bairro, $cidade, $uf, $pais, $numero, $complemento, $foto])->rowCount();

            if ($result > 0) {
                header('Location: ../login.php');
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}

