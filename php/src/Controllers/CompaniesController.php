<?php
namespace App\Controllers;

use App\DB\Conexao;
use App\Models\Colaboradores;
use App\Models\Empresas;
use App\Models\Cargo;
use App\Models\Funcao;
use App\Models\Setor;

class CompaniesController
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        
    }

    function getCompaniesList()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->query("select * from empresas order by razao_social asc");

        $result = [];

        foreach ($stmt as $row) {
            $result[] = new Empresas([
                'id' => $row['id'],
                'razao_social' => $row['razao_social']
            ]);
        }

        return $result;
    }
}
