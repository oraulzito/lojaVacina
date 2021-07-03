<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/DB.php');

class Endereco
{
    private string $cep;
    private string $rua;
    private int $numero;
    private string $complemento;
    private string $bairro;
    private string $cidade;
    private string $uf;
    private string $pais;

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

    public function getEstados(int $idPais = 1)
    {
        $db = new DB();
        return $db->find('estado', 'pais = ' . $idPais)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCidades(int $idEstado)
    {
        $db = new DB();
        return $db->find('cidade', 'estado = ' . $idEstado)->fetchAll(PDO::FETCH_ASSOC);
    }
}