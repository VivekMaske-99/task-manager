<?php
session_start();

$host = "localhost";
$user = "root";   // default XAMPP username
$pass = "";       // default XAMPP password (empty)
$db   = "task_manager";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>
