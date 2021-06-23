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
?>