<?php
    include 'config.php';
    
    // Only update the Task if the required fields are entered
    if ($_POST['task-project'] && $_POST['task-name'] && $_POST['task-desc']) {
        $pid = $_POST['task-project'];
        $cid = NULL;
        // Contributor is optional, checks if specified
        if (0 != $_POST['task-contributor']) {
            $cid = $_POST['task-contributor'];
        } 
        $tname = $_POST['task-name'];
        $tdesc = $_POST['task-desc'];
        $tstatus = $_POST['task-status'];
        $tid = $_POST['task-id'];

        $stmt = $conn -> prepare("UPDATE Tasks SET ProjectID = :pid, ContributorID = :cid,
             TaskName = :tname, TaskDescription = :tdesc, TaskStatus = :tstatus WHERE TaskID = :tid");
        $stmt -> bindParam(':pid', $pid, PDO::PARAM_INT);
        $stmt -> bindParam(':cid', $cid, PDO::PARAM_INT);
        $stmt -> bindParam(':tname', $tname, PDO::PARAM_STR);
        $stmt -> bindParam(':tdesc', $tdesc, PDO::PARAM_STR);
        $stmt -> bindParam(':tstatus', $tstatus, PDO::PARAM_STR);
        $stmt -> bindParam(':tid', $tid, PDO::PARAM_INT);
        $stmt -> execute();

        header('location: /WestromSoftware/index.php');
    }
?>