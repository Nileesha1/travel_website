<?php
include("connection.php");

$message = "";
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $message = "Login successful!";
        header("Location: index.html");
        exit();
    } else {
        $message = "Login failed. Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="form">
        <h1>Login</h1>
        <form name="form" action="loginlogic.php" method="POST">
            <label>Username: </label>
            <input type="text" id="user" name="user"></br></br>
            <label>Password: </label>
            <input type="password" id="pass" name="pass"></br></br>
            <input type="submit" id="btn" value="Login" name="submit"/>
        </form>
        <br>
        <div id="links">
            <a href="signup.php" class="link">Sign Up</a><br>
            <a href="admin.php" class="link">Admin Signup</a>
        </div>
        <p id="message"></p>
    </div>
    <script>
        function isvalid() {
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if (user.length == "" && pass.length == "") {
                alert("Username and password field is empty!!!");
                return false;
            } else if (user.length == "") {
                alert("Username field is empty!!!");
                return false;
            } else if (pass.length == "") {
                alert("Password field is empty!!!");
                return false;
            }
        }

        <?php if (!empty($message)) { ?>
            // Display success message using JavaScript
            var messageElement = document.getElementById("message");
            messageElement.textContent = "<?php echo $message; ?>";
        <?php } ?>
    </script>
</body>
</html>

