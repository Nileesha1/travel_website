<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "travel website";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else {
    echo "Connected successfully";
}

?>