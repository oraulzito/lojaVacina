<?php


class Email
{
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

    function enviaEmail($assunto, $mensagem, $nome, $email)
    {
        $destino = $email;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: {$nome} <$email>";

        if (mail($destino, $assunto, $mensagem, $headers)) {
            return 1;
        } else {
            return 0;
        }
    }
}