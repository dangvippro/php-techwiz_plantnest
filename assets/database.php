<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "plantnest";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connect fail!" . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
