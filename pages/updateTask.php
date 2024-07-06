<?php
session_start();

if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tododb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskID = $_POST["editTaskID"];
    $title = $_POST["editTaskTitle"];
    $description = $_POST["editTaskDescription"];
    $dueDate = $_POST["editTaskDueDate"];
    $status = $_POST["editTaskStatus"];

    $sql = "UPDATE tasktb SET title='$title', description='$description', due_dates='$dueDate', status='$status' WHERE taskID='$taskID'";

    if ($conn->query($sql) === TRUE) {
        echo "Task updated successfully";
    } else {
        echo "Error updating task: " . $conn->error;
    }
}

$conn->close();
?>

