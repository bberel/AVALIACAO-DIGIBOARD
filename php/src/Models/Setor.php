<?php

namespace App\Models;

class Setor 
{
    private $atributos;

    /**
     * Class constructor.
     */
    public function __construct(array $atributos = null)
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
