<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/DB.php');
require_once('Categoria.php');

class Produto
{
    private string $id;
    private string $nome;
    private string $descricao;
    private string $imagem;
    private string $valor;
    private Categoria $categoria;

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

    public function enviaRecibo()
    {

    }

    public function pesquisa(string $termo)
    {
        $termo = '\'%' . $termo . '%\'';

        $db = new DB();
        return $db->find('produto', 'nome LIKE ' . $termo . ' OR descricao LIKE ' . $termo . '')->fetchAll(PDO::FETCH_OBJ);
    }

    public function finalizarPedido(array $itens, string $nome, string $emailComprador)
    {
        $mensagem = '<h1>Resumo do seu pedido</h1>';
        $mensagem .= '<table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor</th>                
            </tr>
        </thead>
        <tbody>';

        foreach ($itens as $i) {
            $result = $this->buscaProduto($i['id']);

            $mensagem .= '<tr>';
            $mensagem .= '<td><img src="' . $result->imagem . '" width="50px"></td>';
            $mensagem .= '<td>' . $result->nome . '</td>';
            $mensagem .= '<td>' . $i['qtd'] . '</td>';
            if ($result->nome === 'Covaxxin') {
                $mensagem .= '<td>' . $i['qtd'] * ($result->valor + 1) . '</td>';
            } else {
                $mensagem .= '<td>' . $i['qtd'] * $result->valor . '</td>';
            }
            $mensagem .= '</tr>';
        }

        $mensagem .= '</tbody>
                    </table>';

        $emailClass = new Email();
        return $emailClass->enviaEmail('Recibo', $mensagem, $nome, $emailComprador);
    }

    public function buscaProdutosCategoria(int $id = -1)
    {
        $db = new DB();
        return $db->find('produto', 'categoria_id = ' . $id)->fetchAll(PDO::FETCH_OBJ);
    }

    public function buscaProduto(int $id = -1)
    {
        $db = new DB();
        return $db->findFirst('produto', 'id = ' . $id)->fetchObject('produto');
    }

    public function buscaCategoria(int $id = -1)
    {
        $db = new DB();
        return $db->findFirst('categoria', 'id = ' . $id)->fetch(PDO::FETCH_ASSOC);
    }

    public function carrinhoProdutos(array $ids)
    {
        $i = 0;
        $inIDs = '';
        foreach ($ids as $id) {
            if ($i != 0) {
                $inIDs .= ',';
            }
            $inIDs .= $id;
            $i++;
        }

        $db = new DB();
        return $db->find('produto', 'id IN (' . $inIDs . ')')->fetchAll(PDO::FETCH_OBJ);
    }

    public function lista()
    {
        $db = new DB();
        return $db->find('produto', 'destaque = 1')->fetchAll(PDO::FETCH_ASSOC);
    }
}