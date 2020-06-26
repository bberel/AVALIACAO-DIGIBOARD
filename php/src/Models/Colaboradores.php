<?php

namespace App\Models;

class Colaboradores 
{
    private $atributos;

    /**
     * Class constructor.
     */
    public function __construct(
        // String $id = null,
        // int $cpf = null,
        // String $nome_completo = null,
        // String $sexo = null,
        // String $nome_mae = null,
        // String $nacionalidade = null,
        // String $data_nascimento = null,
        // int $cargo_id = null,
        // int $funcao_id = null,
        // Cargo $cargo = null,
        // Funcao $funcao = null,
        // String $remuneracao = null,
        // String $rg = null,
        // String $orgao_emissor = null,
        // String $email = null,
        // String $telefone = null,
        // String $ctps = null,
        // String $pis_pasep = null,
        // String $empresa_id = null,
        // String $setor_i = null
        array $atributos = null
    )
    {
        $this->atributos = $atributos;
    }

    
    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }
}
