<?php
session_start();

// Redirect to login page if user is not logged in
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

// Fetch today's tasks for the logged-in user
$username = $_SESSION["username"]; // Get username from session
$todayDate = date("Y-m-d"); // Get today's date in yyyy-mm-dd format

$sql = "SELECT * FROM tasktb WHERE username = '$username' AND due_dates = '$todayDate'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>TaskMaster: Today's Tasks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/navStyle.css">
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
        <li><a href="myList.php">My To-Do List</a></li>
        <li class="active"><a href="#">Today</a></li>
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
  <h3 align="center">TaskMaster : Today's Tasks</h3>
  <p align="center">Let's prioritize and tackle our tasks scheduled for today with urgency and focus, ensuring we stay on track and accomplish everything on our list.</p>
</div>
<hr style="border-top: 2px solid black;width: 50%;margin: auto;">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4>Today's Tasks</h4><br>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>Due Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Check if there are tasks to display
          if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["title"] . "</td>";
                  echo "<td>" . $row["due_dates"] . "</td>";
                  if ($row["status"] == 1) {
                      echo "<td class='status-completed'>Completed</td>";
                  } else {
                      echo "<td class='status-pending'>Pending</td>";
                  }
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='3'>No tasks due today.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
