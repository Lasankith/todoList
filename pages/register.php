<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            var terms = document.getElementById("terms").checked;

            if (password !== confirm_password) {
                alert("Passwords do not match.");
                return false;
            }

            if (!terms) {
                alert("Please accept the Terms and Conditions.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <form action="register.php" method="post" name="form" onsubmit="return validateForm()">
        <div class="container">
            <h2>Sign Up</h2> 
            <!-- Full Name -->
            <label for="fullname">Full name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
            <!-- User Name -->
            <label for="username">User name</label>
            <input type="text" id="username" name="username" placeholder="User name" required>
            <!-- User Email -->
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address (e.g., user@domain.com)" required>
            <!-- Password -->
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <!-- Confirm Password -->
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
            <!-- Accept terms and conditions -->
            <div class="terms">
                <input type="checkbox" id="terms" name="terms">
                <label for="terms">I accept the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></label>
            </div>
            <button type="submit" name="btnSubmit" id="btnSubmit">Sign Up</button>
            <hr> 
            <p class="signup-text">Already have an account? <a href="login.php">Sign in here</a></p>
        </div>
    </form>
</body>
<?php
if(isset($_POST["btnSubmit"])) {
    $fullName = $_POST["fullname"];
    $uName = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $terms_accepted = isset($_POST["terms"]);

    if ($password !== $confirm_password) {
        echo '<script>alert("Passwords do not match.");</script>';
    } elseif (!$terms_accepted) {
        echo '<script>alert("Please accept the Terms and Conditions.");</script>';
    } else {
        $con = mysqli_connect("localhost", "root", "", "tododb");
        if(!$con) {
            die("Sorry, we are facing a technical issue.");
        }
        $sql = "INSERT INTO usertb (fullName, userName, email, password) VALUES ('".$fullName."', '".$uName."', '".$email."', '".$password."');";

        mysqli_query($con, $sql);
        mysqli_close($con);
        header('Location: login.php');
    }
}
?>
</html>


