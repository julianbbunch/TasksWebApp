<?php
    include 'config.php';

    if ($_REQUEST['task-id']) {
        $tid = $_REQUEST['task-id'];

        $stmt = $conn -> prepare("DELETE FROM Tasks WHERE TaskID = :tid");
        $stmt -> bindParam(':tid', $tid, PDO::PARAM_INT);
        $stmt -> execute();
    }

    header('location: /WestromSoftware/index.php');
?>