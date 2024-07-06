<!-- myList.php -->
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

$username = $_SESSION["username"];
$sql = "SELECT * FROM tasktb WHERE username = '$username' ORDER BY status ASC, due_dates ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>TaskMaster: Simplify Your Day with Organized Tasks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/navStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .status-pending {
      color: red;
    }
    .status-completed {
      color: green;
    }
    .status-pending::before {
      content: "🔴 ";
    }
	.status-completed::before {
      content: "✅ ";
    }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar" style="background-color: white;"></span>
        <span class="icon-bar" style="background-color: white;"></span>
        <span class="icon-bar" style="background-color: white;"></span>
      </button>
      <a class="navbar-brand" href="#">Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">My To-Do List</a></li>
        <li><a href="#" data-toggle="modal" data-target="#searchModal">Search</a></li>
        <li><a href="todayTasksPopup.php">Today</a></li>
        <li><a href="upcomingTasks.php">Upcoming</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <br>
  <h3 align="center">TaskMaster : Simplify Your Day with Organized Tasks</h3>
  <p align="center">TaskMaster is a streamlined to-do list application designed to help you manage your daily tasks effortlessly. Organize your day, prioritize tasks, and stay productive with ease.</p>
  <br>
    <hr style="border-top: 2px solid black;width: 50%;margin: auto;"><br>
  <div class="row">
    <div class="col-md-12">
      <h4>My Tasks</h4><br>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
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
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="button" class="btn btn-add-task" data-toggle="modal" data-target="#addTaskModal">
        <span class="glyphicon glyphicon-plus"></span> Add Task
      </button>
    </div>
  </div>
</div>

<!-- Search Modal -->
<div id="searchModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> <!-- Adjusted width for large modal -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search Tasks</h4>
      </div>
      <div class="modal-body">
        <!-- Load searchTasksPopup.php via include -->
        <?php include 'searchTasksPopup.php'; ?>
      </div>
    </div>
  </div>
</div>

<!-- Include Modals -->
<?php include 'addTaskForm.php'; ?>
<?php include 'viewTaskForm.php'; ?>
<?php include 'editTaskForm.php'; ?>


</body>
</html>

