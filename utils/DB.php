<?php


class DB
{
    private string $endereco;
    private string $login;
    private string $senha;
    private string $database;

    private PDO $con;
    private string $table;
    private string $where;
    private array $data;

    /**
     * MySQL constructor.
     * @param string $endereco
     * @param string $login
     * @param string $senha
     * @param string $database
     */
    public function __construct(string $endereco = 'localhost', string $login = 'root', string $senha = '', string $database = 'loja')
    {
        $this->endereco = $endereco;
        $this->login = $login;
        $this->senha = $senha;
        $this->database = $database;

        $this->con = $this->conexao();

        $this->data = [];
        $this->table = '';
        $this->where = '';
    }

    public function conexao(): PDO
    {
        return new PDO('mysql:host=' . $this->endereco . ';dbname=' . $this->database, $this->login, $this->senha);
    }

    public function insert(string $table, string $into, array $values)
    {
        $insertValues = "";
        $i = 0;

        // FIXME this will only works with varchar
        foreach ($values as $v) {
            if ($i == count($values) - 1)
                $insertValues .= '\'' . $v . '\'';
            else
                $insertValues .= '\'' . $v . '\', ';
            $i++;
        }

        try {
            $insert = $this->con->prepare("INSERT INTO " . $table . " (" . $into . ") VALUES (" . $insertValues . ")");
            if ($insert->execute() == 1) {
                return $insert;
            } else {
                throw new PDOException("Erro ao procurar");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findFirst(string $table, string $where)
    {
        $this->table = $table;
        $this->where = $where;

        try {
            if ($where != '') {
                $insert = $this->con->prepare('SELECT * FROM ' . $table . ' WHERE ' . $where . ' LIMIT 1');
            } else {
                $insert = $this->con->prepare('SELECT * FROM ' . $table . ' LIMIT 1');
            }

            if ($insert->execute() == 1) {
                return $insert;
            } else {
                throw new PDOException("Erro ao procurar");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function find(string $table, string $where)
    {
        $this->table = $table;
        $this->where = $where;

        try {
            if ($where != '') {
                $insert = $this->con->prepare('SELECT * FROM ' . $table . ' WHERE ' . $where);
            } else {
                $insert = $this->con->prepare('SELECT * FROM ' . $table);
            }

            if ($insert->execute() == 1) {
                return $insert;
            } else {
                throw new PDOException("Erro ao procurar");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function __get(string $nome)
    {
        if (array_key_exists($nome, $this->data)) {
            return $this->data[$nome];
        } else {
            return 0;
        }
    }

    function __set(string $name, $value): void
    {
        try {
            $insert = $this->con->prepare('UPDATE ' . $this->table . ' SET ' . $name . ' = \'' . $value . '\' WHERE codpessoa = ' . $this->codpessoa);
            if ($insert->execute() == 1) {
                $this->$name = $value;
            } else {
                throw new PDOException("Erro ao procurar");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}