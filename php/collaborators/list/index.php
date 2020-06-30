<?php

    require __DIR__ . '/../../vendor/autoload.php';

    use App\Controllers\CollaboratorsController;

    $controller = new CollaboratorsController();
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
                <table class="table w-100">
                    <thead>
                        <tr>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Contato</th>
                            <th>Empresa</th>
                            <th>Setor</th>
                            <th>Cargo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($controller->getCollaboratorsList() as $colaborador): ?>
                            <tr>
                                <td>
                                    <?= $colaborador->cpf ?>
                                </td>
                                <td>
                                    <?= $colaborador->nome_completo ?>
                                </td>
                                <td>
                                    <div>
                                        <?= $colaborador->telefone ?>
                                    </div>
                                    <div>
                                        <?= $colaborador->email ?>
                                    </div>
                                </td>
                                <td>
                                    <?= $colaborador->empresa->razao_social ?>
                                </td>
                                <td>
                                    <?= $colaborador->setor->nome ?>
                                </td>
                                <td>
                                    <?= $colaborador->cargo->descricao ?>
                                </td>
                                <td>
                                    <a href="/collaborators/edit?id=<?= $colaborador->id ?>" class="btn">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/collaborators/handles/delete-collaborator.php?id=<?= $colaborador->id ?>" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>