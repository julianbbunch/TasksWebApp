<!DOCTYPE html>

<?php
    include 'config.php';

    $tid = $_REQUEST['tid'];
    $autoFill = $conn -> prepare("SELECT * FROM Tasks WHERE TaskID = :tid");
    $autoFill -> bindParam(':tid', $tid, PDO::PARAM_INT);
    $autoFill -> execute();
?>

<html>
    <head>
        <title>Web Developer Skills Assessment</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="cont">
            <div class="box">
                <h1>Update Task:</h1>
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
    </body>
</html>