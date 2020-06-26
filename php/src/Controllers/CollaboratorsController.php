<?php
namespace App\Controllers;

use App\DB\Conexao;
use App\Models\Colaboradores;
use App\Models\Empresas;
use App\Models\Cargo;
use App\Models\Funcao;
use App\Models\Setor;

class CollaboratorsController
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        
    }

    function getNumberOfCollaborators()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->query('select count(*) numero_colaboradores from colaboradores');

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row['numero_colaboradores'];
    }

    function getCollaboratorsByRoles()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->query("select * from cargos, lateral(select count(*) quantidade_colaboradores from colaboradores where cargos.id = colaboradores.cargo_id) count order by quantidade_colaboradores desc");

        $result = [];

        foreach ($stmt as $row) {
            $result[] = [
                'id' => $row['id'],
                'descricao' => $row['descricao'],
                'quantidade_colaboradores' => $row['quantidade_colaboradores']
            ];
        }

        return $result;
    }

    function getCollaboratorsList()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->query("select colaboradores.*, to_json(empresa) empresa, to_json(setor) setor, to_json(cargo) cargo, to_json(funcao) funcao from colaboradores,
        lateral(select * from empresas where colaboradores.empresa_id = empresas.id) as empresa,
        lateral(select * from setores where colaboradores.setor_id = setores.id) as setor,
        lateral(select cargos.* from cargos where colaboradores.cargo_id = cargos.id) as cargo,
        lateral(select id, descricao from funcoes where colaboradores.funcao_id = funcoes.id) as funcao
        order by nome_completo");

        $result = [];

        foreach ($stmt as $row) {
            $result[] = new Colaboradores([
                'id' => $row['id'],
                'cpf' => $row['cpf'],
                'nome_completo' => $row['nome_completo'],
                'sexo' => $row['sexo'],
                'nome_mae' => $row['nome_mae'],
                'nacionalidade' => $row['nacionalidade'],
                'data_nascimento' => $row['data_nascimento'],
                'cargo_id' => $row['cargo_id'],
                'cargo' => new Cargo(json_decode($row['cargo'], true)),
                'funcao_id' => $row['funcao_id'],
                'funcao' => new Funcao(json_decode($row['funcao'], true)),
                'remuneracao' => $row['remuneracao'],
                'rg' => $row['rg'],
                'orgao_emissor' => $row['orgao_emissor'],
                'email' => $row['email'],
                'telefone' => $row['telefone'],
                'ctps' => $row['ctps'],
                'pis_pasep' => $row['pis_pasep'],
                'empresa_id' => $row['empresa_id'],
                'empresa' => new Empresas(json_decode($row['empresa'], true)),
                'setor_id' => $row['setor_id'],
                'setor' => new Setor(json_decode($row['setor'], true)),
            ]);
        }

        return $result;
    }
}
