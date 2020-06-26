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
                Não Finalizado
            </div>
        </div>
    </body>
</html>