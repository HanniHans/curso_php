<?php
function get_conn(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dulceria";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    return $conn;

}
