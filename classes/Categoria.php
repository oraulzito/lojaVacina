<?php


class Categoria
{
    private string $id;
    private string $nome;
    private string $descricao;

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
}