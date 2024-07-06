<?php 
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
    <form action="login.php" method="post">
        <div class="container">
            <h2>Sign In</h2> 
            <p>
            <?php 
                if (isset($_POST["btnsubmit"])) {
                    $uName = $_POST["username"];
                    $password = $_POST["password"];
                
                    $con = mysqli_connect("localhost", "root", "", "tododb");
                    if (!$con) {
                        die("Sorry, we are facing a technical issue");
                    }
                    $sql = "SELECT * FROM `usertb` WHERE `userName`='" . mysqli_real_escape_string($con, $uName) . "' AND `password`='" . mysqli_real_escape_string($con, $password) . "';";
                    $results = mysqli_query($con, $sql);
                    
                    if (mysqli_num_rows($results) > 0) {
                        $_SESSION["username"] = $uName;
                        echo '<script>window.location.href="myList.php";</script>';
                    } else {
                        echo '<span style="color:red;">Please enter a correct username and password</span>';
                    }
                }
            ?>
            </p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div class="links">
                <a href="#" class="forgot-password">Forgot password?</a>
                <a href="#" class="help">Need help?</a> 
            </div>
            <button type="submit" name="btnsubmit">Sign In</button>
            <hr> 
            <p class="signup-text">Don't have an account? <a href="register.php">Sign up here</a></p>
        </div>
    </form>
</body>
</html>

