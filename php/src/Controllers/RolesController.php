<?php
namespace App\Controllers;

use App\DB\Conexao;
use App\Models\Colaboradores;
use App\Models\Empresas;
use App\Models\Cargo;
use App\Models\Funcao;
use App\Models\Setor;

class RolesController
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        
    }

    function getRolesList()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->query("select * from cargos order by descricao asc");

        $result = [];

        foreach ($stmt as $row) {
            $result[] = new Empresas([
                'id' => $row['id'],
                'descricao' => $row['descricao']
            ]);
        }

        return $result;
    }

    function getOccupationsList()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->query("select * from funcoes order by descricao asc");

        $result = [];

        foreach ($stmt as $row) {
            $result[] = new Funcao([
                'id' => $row['id'],
                'descricao' => $row['descricao']
            ]);
        }

        return $result;
    }
}
