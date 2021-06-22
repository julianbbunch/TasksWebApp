<?php
    //phpinfo();
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "TasksWebApp";

    // Connect to database
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

    // Executes a query without prepared statement or input sanitization
    function query($query) {
        global $conn;
        $result = $conn -> prepare($query);
        $result -> execute();
        return $result;
    }

    // Adds a project to DB from "project-name"
    if ($_REQUEST['project-name']) {
        $pname = $_REQUEST['project-name'];
        $stmt = $conn -> prepare("INSERT INTO Projects (ProjectName) VALUES (:pname)");
        $stmt -> bindParam(':pname', $pname, PDO::PARAM_STR);
        $stmt -> execute();
        header('location: /WestromSoftware/index.php');
    }

    // Add a contributor to DB from "contributor-name"
    if ($_REQUEST['contributor-name']) {
        $cname = $_REQUEST['contributor-name'];
        $stmt = $conn -> prepare("INSERT INTO Contributors (ContributorName) VALUES (:cname)");
        $stmt -> bindParam(':cname', $cname, PDO::PARAM_STR);
        $stmt -> execute();
        header('location: /WestromSoftware/index.php');
    }

    // Add a task to project if all required fields have been filled in
    if ($_REQUEST['task-project'] && $_REQUEST['task-name'] && $_REQUEST['task-desc']) {
        
        $pid = $_REQUEST['task-project'];
        $cid = NULL;
        // Contributor is optional, checks if specified
        if (0 != $_REQUEST['task-contributor']) {
            $cid = $_REQUEST['task-contributor'];
        } 
        $tname = $_REQUEST['task-name'];
        $tdesc = $_REQUEST['task-desc'];
        $tstatus = "NEW"; // Since TaskStatus can't be NULL in Tasks table

        $stmt = $conn -> prepare("INSERT INTO Tasks (ProjectID, ContributorID, TaskName, TaskDescription, TaskStatus) VALUES (:pid, :cid, :tname, :tdesc, \"$tstatus\")");
        $stmt -> bindParam(':pid', $pid, PDO::PARAM_INT);
        $stmt -> bindParam(':cid', $cid, PDO::PARAM_INT);
        $stmt -> bindParam(':tname', $tname, PDO::PARAM_STR);
        $stmt -> bindParam(':tdesc', $tdesc, PDO::PARAM_STR);

        //$stmt = $conn -> prepare("INSERT INTO Tasks (ProjectID, ContributorID, TaskName, TaskDescription, TaskStatus) VALUES (1, NULL, \"TEST\", \"TEST DESCRIPT\", \"NEW\")");
        
        $stmt -> execute();

        header('location: /WestromSoftware/index.php');
    }
?>