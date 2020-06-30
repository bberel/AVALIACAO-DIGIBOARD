<?php

    require __DIR__ . '/../../vendor/autoload.php';

    use App\Controllers\CollaboratorsController;

    $controller = new CollaboratorsController();

    if ($controller->deleteCollaborator($_REQUEST['id'])) {
        header('Location: /collaborators/list/');
    }
?>
