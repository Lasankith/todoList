
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
    $taskID = $_POST["taskID"];
    $username = $_SESSION["username"];

    $sql = "DELETE FROM tasktb WHERE taskID = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $taskID, $username);

    if ($stmt->execute()) {
        echo "Task deleted successfully";
    } else {
        echo "Error deleting task: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
