<!DOCTYPE html>

<!-- 
Author:  Julian Bunch
Project: TasksWebApp
Date:    06/22/2021
-->

<?php
    include 'config.php';
?>

<html>
    <head>
        <title>Web Developer Skills Assessment</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="content">
            <div class="row">
                <div class="col-4">
                    <div class="box">
                        <h1>Tasks Web App</h1>
                    </div>

                    <div class="box">
                        <h3>Add a Project</h3>
                        <form action="/WestromSoftware/config.php">
                            <label for="project-name">Project Name:</label><br>
                            <input type="text" id="project-name" name="project-name" placeholder="Enigma Decrypter">
                            <input type="submit" value="Add Project">
                        </form>
                    </div>  

                    <div class="box">
                        <h3>Add a Contributor</h3>
                        <form action="/WestromSoftware/config.php">
                            <label for="contributor-name">Contributor Name:</label><br>
                            <input type="text" id="contributor-name" name="contributor-name" placeholder="Alan Turing">
                            <input type="submit" value="Add Contributor">
                        </form>
                    </div>

                    <div class="box">
                        <h3>Add a New Task</h3>
                        <form action="/WestromSoftware/config.php">
                            <label for="task-project">Project:</label><br>
                            <select id="task-project" name="task-project">
                                <?php
                                    // Print options to be displayed in dropdown menu
                                    $result = query("SELECT * FROM Projects;");
                                    while ($row = $result -> fetch()) {
                                        $pid = $row['ProjectID'];
                                        $pname = $row['ProjectName'];
                                        print "<option value=\"$pid\">$pname</option>";
                                    }
                                ?>
                            </select><br><br>
                            <label for="task-contributor">Contributor (optional):</label><br>
                            <select id="task-contributor" name="task-contributor">
                            <option value=0></option> <!-- Empty option -->
                                <?php
                                    // Print options to be displayed in dropdown menu
                                    $result = query("SELECT * FROM Contributors;");
                                    while ($row = $result -> fetch()) {
                                        $cid = $row['ContributorID'];
                                        $cname = $row['ContributorName'];
                                        print "<option value=$cid>$cname</option>";
                                    }
                                ?>
                            </select><br><br>
                            <label for="task-name">Task Name:</label><br>
                            <input type="text" id="task-name" name="task-name" placeholder="Make blueprint"><br><br>
                            <label for="task-desc">Description:</label><br>
                            <textarea type="text" id="task-desc" name="task-desc" placeholder="Make a detailed drawing, paper must be blue. "></textarea><br><br>
                            <input type="submit" value="Add Task">
                        </form>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box" id="tasks">
                        <h3>Tasks</h3>
                        <table>
                            <tr>
                                <th>Task ID</th>
                                <th>Project ID</th>
                                <th>Contributor ID</th>
                                <th id="table-col-name">Name</th>
                                <th id="table-col-description">Description</th>
                                <th>Status</th>
                                <th id="table-col-date">Added</th>
                                <th>Action</th>
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
                                    <td>$tdate</td>
                                    <td><a href="/WestromSoftware/update.php?tid=$tid">Update</a></td></tr>
                                    EOF;
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </body>





</html>