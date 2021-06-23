<?php
    include 'config.php';

    // Adds a project to DB from "project-name"
    if ($_POST['project-name']) {
        $pname = $_POST['project-name'];
        $stmt = $conn -> prepare("INSERT INTO Projects (ProjectName) VALUES (:pname)");
        $stmt -> bindParam(':pname', $pname, PDO::PARAM_STR);
        $stmt -> execute();
        header('location: /index.php');
    }

    // Add a contributor to DB from "contributor-name"
    if ($_POST['contributor-name']) {
        $cname = $_POST['contributor-name'];
        $stmt = $conn -> prepare("INSERT INTO Contributors (ContributorName) VALUES (:cname)");
        $stmt -> bindParam(':cname', $cname, PDO::PARAM_STR);
        $stmt -> execute();
        header('location: /index.php');
    }

    // Add a task to project if all required fields have been filled in
    if ($_POST['task-project'] && $_POST['task-name'] && $_POST['task-desc']) {
        $pid = $_POST['task-project'];
        $cid = NULL;
        // Contributor is optional, checks if specified
        if (0 != $_POST['task-contributor']) {
            $cid = $_POST['task-contributor'];
        } 
        $tname = $_POST['task-name'];
        $tdesc = $_POST['task-desc'];
        $tstatus = "NEW"; // Since TaskStatus can't be NULL in Tasks table

        $stmt = $conn -> prepare("INSERT INTO Tasks (ProjectID, ContributorID, TaskName, TaskDescription, TaskStatus) VALUES (:pid, :cid, :tname, :tdesc, \"$tstatus\")");
        $stmt -> bindParam(':pid', $pid, PDO::PARAM_INT);
        $stmt -> bindParam(':cid', $cid, PDO::PARAM_INT);
        $stmt -> bindParam(':tname', $tname, PDO::PARAM_STR);
        $stmt -> bindParam(':tdesc', $tdesc, PDO::PARAM_STR);
        $stmt -> execute();

        header('location: /index.php');
    }
    print "Please remember to fill in required fields.";
    print "<br><a href=\"/index.php?\">Back</a>";
?>