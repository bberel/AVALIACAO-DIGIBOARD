<?php
namespace App\Controllers;

use App\DB\Conexao;
use App\Models\Colaboradores;
use App\Models\Empresas;
use App\Models\Cargo;
use App\Models\Funcao;
use App\Models\Setor;

class DepartmentsController
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        
    }

    function getDepartmentsList()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->query("select * from setores order by nome asc");

        $result = [];

        foreach ($stmt as $row) {
            $result[] = new Setor([
                'id' => $row['id'],
                'nome' => $row['nome']
            ]);
        }

        return $result;
    }
}
