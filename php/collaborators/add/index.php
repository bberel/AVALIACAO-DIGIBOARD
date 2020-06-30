<?php

    require __DIR__ . '/../../vendor/autoload.php';

    use App\Controllers\CollaboratorsController;
    use App\Controllers\CompaniesController;
    use App\Controllers\DepartmentsController;
    use App\Controllers\RolesController;

    $controller = new CollaboratorsController();
    $companiesController = new CompaniesController();
    $departmentsController = new DepartmentsController();
    $rolesController = new RolesController();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Controle de Collaboradores</title>
        <base href="/">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://kit.fontawesome.com/08150d2d65.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../assets/style.css"></link>
    </head>

    <body>
        <?php require __DIR__ . "/../../common/toolbar.php"; ?>

        <div class="container">
            <?php require __DIR__ . "/../../common/sidenav.php"; ?>
            
            <div class="content">
                <h3 class="text-center">Ficha Cadastral</h3>
                
                <hr>

                <form action="/collaborators/handles/insert-collaborator.php" method="post">
                    <div>
                        <label for="cpf">CPF *</label>
                        <input class="form-control" type="text" maxlength="11" name="cpf" id="cpf" placeholder="CPF">
                    </div>

                    <div>
                        <label for="nome_completo">Nome Completo *</label>
                        <input class="form-control" type="text" name="nome_completo" id="nome_completo" placeholder="Nome Completo">
                    </div>

                    <div>
                        <label for="sexo">Sexo *</label>
                        <select class="form-control" name="sexo" id="sexo" placeholder="Sexo">
                            <option value="M">Masculino</opction>
                            <option value="F">Feminino</opction>
                        </select>
                    </div>

                    <div>
                        <label for="nome_mae">Nome da Mãe *</label>
                        <input class="form-control" type="text" name="nome_mae" id="nome_mae" placeholder="Nome da Mãe">
                    </div>

                    <div>
                        <label for="nacionalidade">Nacionalidade *</label>
                        <input class="form-control" type="text" name="nacionalidade" id="nacionalidade" placeholder="Nacionalidade">
                    </div>

                    <div>
                        <label for="data_nascimento">Dada de Nascimento *</label>
                        <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" placeholder="Dada de Nascimento">
                    </div>

                    <div>
                        <label for="cargo">Cargo *</label>
                        <select class="form-control" name="cargo" id="cargo" placeholder="Cargo">
                            <option value="">Selecionar Cargo</opction>
                            <?php foreach ($rolesController->getRolesList() as $cargo): ?>
                                <option value="<?= $cargo->id ?>"><?= $cargo->descricao ?></opction>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="funcao">Função *</label>
                        <select class="form-control" name="funcao" id="funcao" placeholder="Função">
                            <option value="">Selecionar Função</opction>
                            <?php foreach ($rolesController->getOccupationsList() as $funcao): ?>
                                <option value="<?= $funcao->id ?>"><?= $funcao->descricao ?></opction>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="remuneracao">Remuneração *</label>
                        <input class="form-control" type="number" name="remuneracao" id="remuneracao" placeholder="Remuneração">
                    </div>

                    <div>
                        <label for="rg">RG *</label>
                        <input class="form-control" type="number" name="rg" id="rg" placeholder="RG">
                    </div>

                    <div>
                        <label for="orgao_emissor">Orgão Emissor *</label>
                        <input class="form-control" type="text" name="orgao_emissor" id="orgao_emissor" placeholder="Orgão Emissor">
                    </div>

                    <div>
                        <label for="email">E-mail *</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="E-mail">
                    </div>

                    <div>
                        <label for="telefone">Telefone *</label>
                        <input class="form-control" type="text" name="telefone" id="telefone" placeholder="Telefone">
                    </div>

                    <div>
                        <label for="ctps">CTPS</label>
                        <input class="form-control" type="number" name="ctps" id="ctps" placeholder="CTPS">
                    </div>

                    <div>
                        <label for="pis_pasep">PIS / PASEP</label>
                        <input class="form-control" type="number" name="pis_pasep" id="pis_pasep" placeholder="PIS / PASEP">
                    </div>

                    <div>
                        <label for="empresa">Empresa *</label>
                        <select class="form-control" name="empresa" id="empresa" placeholder="Empresa">
                            <option value="">Selecionar Empresa</opction>
                            <?php foreach ($companiesController->getCompaniesList() as $empresa): ?>
                                <option value="<?= $empresa->id ?>"><?= $empresa->razao_social ?></opction>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="setor">Setor *</label>
                        <select class="form-control" name="setor" id="setor" placeholder="Setor">
                            <option value="">Selecionar Setor</opction>
                            <?php foreach ($departmentsController->getDepartmentsList() as $setor): ?>
                                <option value="<?= $setor->id ?>"><?= $setor->nome ?></opction>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <input type="submit" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>