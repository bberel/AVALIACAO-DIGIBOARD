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

    function getCollaboratorById($id)
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("select colaboradores.*, colaboradores.data_nascimento::text, to_json(empresa) empresa, to_json(setor) setor, to_json(cargo) cargo, to_json(funcao) funcao from colaboradores,
        lateral(select * from empresas where colaboradores.empresa_id = empresas.id) as empresa,
        lateral(select * from setores where colaboradores.setor_id = setores.id) as setor,
        lateral(select cargos.* from cargos where colaboradores.cargo_id = cargos.id) as cargo,
        lateral(select id, descricao from funcoes where colaboradores.funcao_id = funcoes.id) as funcao
        where colaboradores.id = :id");

        $stmt->bindValue(':id', $id);
        $stmt->execute();

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

        return $result[0];
    }

    function insertCollaborator($data)
    {
        $conexao = Conexao::getInstance();
        $sql = 'insert into colaboradores(cpf, nome_completo, sexo, nome_mae, nacionalidade, data_nascimento, cargo_id, funcao_id, remuneracao, rg, orgao_emissor, email, telefone, ctps, pis_pasep, empresa_id, setor_id) VALUES (:cpf, :nome_completo, :sexo, :nome_mae, :nacionalidade, :data_nascimento, :cargo_id, :funcao_id, :remuneracao, :rg, :orgao_emissor, :email, :telefone, :ctps, :pis_pasep, :empresa_id, :setor_id) RETURNING id';

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':cpf', $data['cpf'] ?? null);
        $stmt->bindValue(':nome_completo', $data['nome_completo'] ?? null);
        $stmt->bindValue(':sexo', $data['sexo'] ?? null);
        $stmt->bindValue(':nome_mae', $data['nome_mae'] ?? null);
        $stmt->bindValue(':nacionalidade', $data['nacionalidade'] ?? null);
        $stmt->bindValue(':data_nascimento', $data['data_nascimento'] ?? null);
        $stmt->bindValue(':cargo_id', $data['cargo'] ?? null);
        $stmt->bindValue(':funcao_id', $data['funcao'] ?? null);
        $stmt->bindValue(':remuneracao', $data['remuneracao'] ?? null);
        $stmt->bindValue(':rg', $data['rg'] ?? null);
        $stmt->bindValue(':orgao_emissor', $data['orgao_emissor'] ?? null);
        $stmt->bindValue(':email', $data['email'] ?? null);
        $stmt->bindValue(':telefone', $data['telefone'] ?? null);
        $stmt->bindValue(':ctps', $data['ctps'] ?? null);
        $stmt->bindValue(':pis_pasep', $data['pis_pasep'] ?? null);
        $stmt->bindValue(':empresa_id', $data['empresa'] ?? null);
        $stmt->bindValue(':setor_id', $data['setor'] ?? null);

        $stmt->execute();

        return true;
    }

    function updateCollaborator($data)
    {
        $conexao = Conexao::getInstance();
        $sql = 'update colaboradores set cpf = :cpf, nome_completo = :nome_completo, sexo = :sexo, nome_mae = :nome_mae, nacionalidade = :nacionalidade, data_nascimento = :data_nascimento, cargo_id = :cargo_id, funcao_id = :funcao_id, remuneracao = :remuneracao, rg = :rg, orgao_emissor = :orgao_emissor, email = :email, telefone = :telefone, ctps = :ctps, pis_pasep = :pis_pasep, empresa_id = :empresa_id, setor_id = :setor_id where id = :id';

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        $stmt->bindValue(':cpf', $data['cpf']);
        $stmt->bindValue(':nome_completo', $data['nome_completo']);
        $stmt->bindValue(':sexo', $data['sexo']);
        $stmt->bindValue(':nome_mae', $data['nome_mae']);
        $stmt->bindValue(':nacionalidade', $data['nacionalidade']);
        $stmt->bindValue(':data_nascimento', $data['data_nascimento']);
        $stmt->bindValue(':cargo_id', $data['cargo']);
        $stmt->bindValue(':funcao_id', $data['funcao']);
        $stmt->bindValue(':remuneracao', $data['remuneracao']);
        $stmt->bindValue(':rg', $data['rg']);
        $stmt->bindValue(':orgao_emissor', $data['orgao_emissor']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':telefone', $data['telefone']);
        $stmt->bindValue(':ctps', $data['ctps']);
        $stmt->bindValue(':pis_pasep', $data['pis_pasep']);
        $stmt->bindValue(':empresa_id', $data['empresa']);
        $stmt->bindValue(':setor_id', $data['setor']);

        $stmt->execute();

        return true;
    }

    function deleteCollaborator($id)
    {
        $conexao = Conexao::getInstance();
        $sql = 'delete from colaboradores where id = :id';

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);

        $stmt->execute();

        return true;
    }
}
