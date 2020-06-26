<?php

namespace App\DB;

class Conexao
{
    private static $conexao;
 
    private function __construct()
    {}
 
    public static function getInstance()
    {
        if (is_null(self::$conexao)) {
            self::$conexao = new \PDO('pgsql:host=localhost;port=5432;dbname=controle_colaboradores;user=postgres;password=@dventUr3');
            self::$conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$conexao;
    }
 
    public static function closeInstance()
    {
        self::$conexao = null;
    }
}