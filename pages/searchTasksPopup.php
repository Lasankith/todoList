<?php

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

$username = $_SESSION["username"];

// Handle search query
if (isset($_POST['searchQuery'])) {
    $searchQuery = $_POST['searchQuery'];

    // Build SQL query based on search query
    $sql = "SELECT * FROM tasktb WHERE username = '$username' AND (title LIKE '%$searchQuery%' OR due_dates LIKE '%$searchQuery%') ORDER BY status ASC, due_dates ASC";
} else {
    // Default query if no search query
    $sql = "SELECT * FROM tasktb WHERE username = '$username' ORDER BY status ASC, due_dates ASC";
}

$result = $conn->query($sql);
?>

<input type="text" id="searchInput" class="form-control" placeholder="Search tasks by title or due date...">
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="searchResults">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["due_dates"] . "</td>";
                echo "<td class='" . ($row["status"] == 1 ? "status-completed" : "status-pending") . "'>" . ($row["status"] == 1 ? "Completed" : "Pending") . "</td>";
                echo "<td>";
                echo '<a href="#" class="btn btn-default btn-xs view-task" data-id="' . $row["taskID"] . '"><span class="glyphicon glyphicon-eye-open"></span> View</a>';
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No tasks found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        $('#searchResults tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
        });
    });
});
</script>
<?php
$conn->close();
?>

