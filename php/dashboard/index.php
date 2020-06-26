<?php

    require __DIR__ . '/../vendor/autoload.php';

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
        <?php require __DIR__ . "/../common/toolbar.php"; ?>

        <div class="container">
            <?php require __DIR__ . "/../common/sidenav.php"; ?>
            
            <div class="content">
                <div class="card mb-2">
                    <div class="card-title">Número de Colaboradores</div>

                    <div class="card-body">
                        <div class="info number">
                            <i class="fa fa-fw fa-users"></i>
                            <?= $controller->getNumberOfCollaborators(); ?>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-2">
                    <div class="card-title">Colaboradores por Cargo</div>

                    <div class="card-body">
                        <?php foreach ($controller->getCollaboratorsByRoles() as $cargo): ?>
                            
                            <div class="mb-2">
                                <div class="d-flex justify-between">
                                    <div class="d-inline">
                                        <?= $cargo['descricao'] ?>
                                    </div>

                                    <div class="d-inline">
                                        <span class="mr-2"><?= $cargo['quantidade_colaboradores'] ?></span>
                                        <span class="info"><?= ($cargo['quantidade_colaboradores'] / $controller->getNumberOfCollaborators()) * 100 ?>%</span>
                                    </div>
                                </div>

                                <div class="progress-bar">
                                    <div class="bar" style="width: <?= ($cargo['quantidade_colaboradores'] / $controller->getNumberOfCollaborators()) * 100 ?>%"></div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>