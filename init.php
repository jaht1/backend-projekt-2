<?php
session_start();

// Remove whitespaces, remove extra slashes, and convert to safe html characters
// USE FOR ALL USER INPUT
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Sets up connection to database - use $conn = create_conn(); to open connection and $conn->close();
function create_conn()
{
    // byt error reporting läge
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
    //Databaskonfiguration
    $servername = "localhost";
    $username = "ahtijenn";
    $password = "xHw7uSjdfD";
    $dbname = "ahtijenn";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}
