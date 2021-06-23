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
        <title>Tasks Web App</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="content">
            <div class="row">
                <div class="col-4">
                    <div class="box">
                        <h1>Tasks Web App</h1>
                    </div>

                    <!--  Adding Projects  -->
                    <div class="box">
                        <h3>Add a Project</h3>
                        <form action="/insert.php" method="post">
                            <label for="project-name">Project Name:</label><br>
                            <input type="text" id="project-name" name="project-name" placeholder="Enigma Decrypter" autocomplete="off">
                            <input type="submit" value="Add Project">
                        </form>
                        <p>Projects will appear under the "Project" dropdown menu when you go to create a new task. Projects can have as many tasks as you'd like.</p>
                    </div>  

                    <!--  Adding Contributors  -->
                    <div class="box">
                        <h3>Add a Contributor</h3>
                        <form action="/insert.php" method="post">
                            <label for="contributor-name">Contributor Name:</label><br>
                            <input type="text" id="contributor-name" name="contributor-name" placeholder="Alan Turing" autocomplete="off">
                            <input type="submit" value="Add Contributor">
                        </form>
                        <p>Contributors can be assigned tasks in the "Contributor" dropdown menu upon creating a new task or by clicking "Update" in the tasks table.</p>
                    </div>

                    <!--  Adding Tasks  -->
                    <div class="box">
                        <h3>Add a New Task</h3>
                        <form action="/insert.php" method="post">
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
                                <option value=0>Not Assigned</option> <!-- Empty option -->
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
                            <input type="text" id="task-name" name="task-name" placeholder="Make blueprint" autocomplete="off"><br><br>
                            <label for="task-desc">Description:</label><br>
                            <textarea type="text" id="task-desc" name="task-desc" placeholder="Make a nice drawing, paper must be blue. "></textarea><br><br>
                            <input type="submit" value="Add Task">
                        </form>
                    </div>
                </div>

                <!--   Displaying Tasks and Task Operations  -->
                <div class="col-8">
                    <div class="box" id="tasks">
                        <h3>Tasks</h3>
                        <?php
                            // Add link to show/hide completed tasks
                            if ($_GET['hide'] == 'true') {
                                print "<a href=\"/index.php?\">Show Completed Tasks</a>";
                            }
                            else {
                                print "<a href=\"/index.php?hide=true\">Hide Completed Tasks</a>";
                            }
                        ?>
                        <br><br>
                        <table>
                            <tr>
                                <th><a href="/index.php?sort=id">Task ID</a></th>
                                <th><a href="/index.php?sort=project">Project</a></th>
                                <th><a href="/index.php?sort=contributor">Contributor</a></th>
                                <th id="table-col-name">Name</th>
                                <th id="table-col-description">Description</th>
                                <th><a href="/index.php?sort=status">Status</a></th>
                                <th id="table-col-date"><a href="/index.php?sort=date">Added</a></th>
                                <th>Actions</th>
                            </tr>
                            <?php
                                $stmt = "SELECT * FROM Tasks INNER JOIN Projects ON Tasks.ProjectID = Projects.ProjectID
                                    LEFT JOIN Contributors ON Tasks.ContributorID = Contributors.ContributorID";

                                // Apply sorting
                                if ($_GET['sort'] == 'id') {
                                    $stmt .= " ORDER BY TaskID";
                                } 
                                elseif ($_GET['sort'] == 'project') {
                                    $stmt .= " ORDER BY ProjectName";
                                } 
                                elseif ($_GET['sort'] == 'contributor') {
                                    $stmt .= " ORDER BY ContributorName";
                                } 
                                elseif ($_GET['sort'] == 'status') {
                                    $stmt .= " ORDER BY TaskStatus";
                                } 
                                elseif ($_GET['sort'] == 'date') {
                                    $stmt .= " ORDER BY DateAdded";
                                }

                                // Show/hide completed tasks
                                if ('true' == $_GET['hide']) {
                                    $stmt .= " WHERE TaskStatus != \"COM\"";
                                }

                                $result = query($stmt);

                                // Print the table of tasks
                                while ($row = $result -> fetch()) {
                                    $tid = $row['TaskID'];
                                    $pname = $row['ProjectName'];
                                    $cname = $row['ContributorName'];
                                    $tname = $row['TaskName'];
                                    $tdesc = $row['TaskDescription'];
                                    $tstatus = $row['TaskStatus'];
                                    $tdate = $row['DateAdded'];

                                    print <<<EOF
                                    <tr><td>$tid</td>
                                    <td>$pname</td>
                                    <td>$cname</td>
                                    <td>$tname</td>
                                    <td>$tdesc</td>
                                    <td>$tstatus</td>
                                    <td>$tdate</td>
                                    <td><a href="/update_page.php?task-id=$tid">Update</a>
                                    <a href="/delete.php?task-id=$tid">Delete</a></td></tr>
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