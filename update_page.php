<!DOCTYPE html>

<?php
    include 'config.php';

    // Read the selected task from DB to use for autofilling form data
    $tid = $_GET['task-id'];
    $autofilldata = $conn -> prepare("SELECT * FROM Tasks WHERE TaskID = :tid");
    $autofilldata -> bindParam(':tid', $tid, PDO::PARAM_INT);
    $autofilldata -> execute();
    $autofilldata = $autofilldata -> fetch();
?>

<html>
    <head>
        <title>Tasks Web App</title>
        <link href="styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="content">
            <div class="box">
                <h1>Update Task:</h1>
                <form action="/WestromSoftware/update.php" method="post">
                    <input type="hidden" id="task-id" name="task-id" value=<?php echo "$tid";?>/>
                    <label for="task-project">Project:</label><br>
                    <select id="task-project" name="task-project">
                        <?php
                            // Print options to be displayed in dropdown menu
                            $result = query("SELECT * FROM Projects;");
                            while ($row = $result -> fetch()) {
                                $pid = $row['ProjectID'];
                                $pname = $row['ProjectName'];
                                print "<option value=$pid";
                                // Use what's already selected in the Task table
                                if ($autofilldata['ProjectID'] == $pid) {
                                    print " selected=\"selected\"";
                                }
                                print ">$pname</option>";
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
                                print "<option value=$cid";
                                // Use what's already selected in the Task table
                                if ($autofilldata['ContributorID'] == $cid) {
                                    print " selected=\"selected\"";
                                }
                                print ">$cname</option>";
                            }
                        ?>
                    </select><br><br>
                    <label for="task-name">Task Name:</label><br>
                    <input type="text" id="task-name" name="task-name" placeholder="Make blueprint" 
                            <?php $tname = $autofilldata['TaskName']; print "value=\"$tname\"";?>><br><br>
                    <label for="task-desc">Description:</label><br>
                    <textarea type="text" id="task-desc" name="task-desc" placeholder="Make a detailed drawing, paper must be blue. "><?php 
                        $description = $autofilldata['TaskDescription'];
                        print "$description";                         
                    ?></textarea><br><br>
                    <label for="task-status">Status</label><br>
                    <select id="task-status" name="task-status">
                        <option value="NEW" <?php 
                            // Options are auto-selected based on TaskStatus in Tasks table
                            if ($autofilldata['TaskStatus'] == "NEW") {
                                print " selected=\"selected\"";
                            }
                            ?>>NEW: Not Started</option>
                        <option value="INP" <?php 
                            if ($autofilldata['TaskStatus'] == "INP") {
                                print " selected=\"selected\"";
                            }
                            ?>>INP: In Progress</option>
                        <option value="COM" <?php 
                            if ($autofilldata['TaskStatus'] == "COM") {
                                print " selected=\"selected\"";
                            }
                            ?>>COM: Completed</option>
                    </select><br><br>
                    <input type="submit" value="Update Task">
                </form>
            </div>
        </div>
    </body>
</html>