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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskID = $_POST["taskID"];
    $username = $_SESSION["username"];

    // Fetch task details
    $sql = "SELECT * FROM tasktb WHERE taskID = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $taskID, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
        echo json_encode($task);
    } else {
        echo json_encode(array("error" => "Task not found."));
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
