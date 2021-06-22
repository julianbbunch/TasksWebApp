<!DOCTYPE html>

<!-- 
Author:  Julian Bunch
Project: TasksWebApp
Date:    06/22/2021
-->

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
    }

    // Add a contributor to DB from "contributor-name"
    if ($_REQUEST['contributor-name']) {
        $cname = $_REQUEST['contributor-name'];
        $stmt = $conn -> prepare("INSERT INTO Contributors (ContributorName) VALUES (:cname)");
        $stmt -> bindParam(':cname', $cname, PDO::PARAM_STR);
        $stmt -> execute();
    }

?>

<html>
    <head>
        <title>Web Developer Skills Assessment</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <h1>Tasks Web App</h1>

        <h3>Add a Project</h3>
        <form action="/WestromSoftware/index.php">
            <label for="project-name">Project Name:</label><br>
            <input type="text" id="project-name" name="project-name" placeholder="Enigma Decrypter">
            <input type="submit" value="Add Project">
        </form>
        
        <h3>Add a Contributor</h3>
        <form action="/WestromSoftware/index.php">
            <label for="contributor-name">Contributor Name:</label><br>
            <input type="text" id="contributor-name" name="contributor-name" placeholder="Alan Turing">
            <input type="submit" value="Add Contributor">
        </form>

        <h3>Add a New Task</h3>
        <form action="/WestromSoftware/index.php">
            <label for="task-name">Task Name:</label><br>
            <input type="text" id="task-name" name="task-name" placeholder="Make blueprint"><br><br>
            <label for="task-name">Description:</label><br>
            <textarea type="text" id="task-desc" name="task-desc" placeholder="Make a detailed drawing on the blue paper"></textarea><br><br>
            


        </form>

        <h3>Tasks</h3>
        <table>
            <tr>
                <th>Task ID</th>
                <th>Project ID</th>
                <th>Contributor ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Added</th>
            </tr>
            <?php
                $result = query('SELECT * FROM Tasks;');

                // Print the table of tasks
                while ($row = $result -> fetch()) {
                    $tid = $row['TaskID'];
                    $pid = $row['ProjectID'];
                    $cid = $row['ContributorID'];
                    $tname = $row['TaskName'];
                    $tdesc = $row['TaskDescription'];
                    $tstatus = $row['TaskStatus'];
                    $tdate = $row['DateAdded'];

                    print <<<EOF
                    <tr><td>$tid</td>
                    <td>$pid</td>
                    <td>$cid</td>
                    <td>$tname</td>
                    <td>$tdesc</td>
                    <td>$tstatus</td>
                    <td>$tdate</td></tr>
                    EOF;
                }
            ?>
        </table>


    </body>





</html>