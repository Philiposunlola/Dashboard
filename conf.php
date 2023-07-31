<?php
// Replace these with your actual database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myshop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
