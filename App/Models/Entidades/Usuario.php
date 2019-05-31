<?php
namespace App\Models\Entidades;

class Usuario{
    private $id;
    private $email;
    private $senha;
    private $emailNotificacao;
    private $senhaCB;
    private $cpf;
    private $nome;
    private $sobrenome;

    public function __construct(\stdClass $usuario){
        var_dump($usuario);
        $this->id = $usuario->id;
        $this->email = $usuario->email;
    }
}