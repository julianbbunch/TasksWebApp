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

    function query($query) {
        global $conn;
        $result = $conn -> prepare($query);
        $result -> execute();
        return $result;
    }
?>

<html>
    <head>
        <title>Web Developer Skills Assessment</title>
    </head>

    <body>
        <h1>Tasks Web App</h1>

        <h3>Add a Project:</h3>

        


    </body>





</html>