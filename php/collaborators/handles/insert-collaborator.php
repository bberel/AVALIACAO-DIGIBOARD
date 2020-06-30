<?php

    require __DIR__ . '/../../vendor/autoload.php';

    use App\Controllers\CollaboratorsController;

    $controller = new CollaboratorsController();
    print_r($_REQUEST);

    if ($controller->insertCollaborator($_REQUEST)) {
        header('Location: /collaborators/list/');
    }
?>
