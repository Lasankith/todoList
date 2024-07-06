<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}

// Database configuration
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "tododb"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$title = $_POST['taskTitle'];
$description = $_POST['taskDescription'];
$due_date = $_POST['taskDueDate'];
$status = $_POST['taskStatusValue'];
$username = $_SESSION['username'];

// Insert task into database
$sql = "INSERT INTO tasktb (title, description, due_dates, status, username) VALUES ('$title', '$description', '$due_date', '$status', '$username')";

if ($conn->query($sql) === TRUE) {
    echo "Task added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
