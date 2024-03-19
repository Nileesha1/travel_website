<?php
include('connection.php');

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);

    // Password validation regex pattern
    $password_pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/';

    if (!preg_match($password_pattern, $password)) {
        echo '<script>
                alert("Password should contain at least one special character, one alphabet character, one numeric character, and be at least 8 characters long");
                window.location.href = "signup.php";
            </script>';
        exit();
    }

    $sql = "SELECT * FROM signup WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        die("Query failed: " . mysqli_error($conn));
    }
    $count_user = mysqli_num_rows($result);

    $sql = "SELECT * FROM signup WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        die("Query failed: " . mysqli_error($conn));
    }
    $count_email = mysqli_num_rows($result);

    if ($count_user == 0 && $count_email == 0) {

        if ($password == $cpassword) {

            // Insert into "signup" table
            $signup_sql = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";
            $signup_result = mysqli_query($conn, $signup_sql);
            if (!$signup_result) {
                die("Query failed: " . mysqli_error($conn));
            }

            // Insert into "login" table
            $login_sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
            $login_result = mysqli_query($conn, $login_sql);
            if (!$login_result) {
                die("Query failed: " . mysqli_error($conn));
            }

            header("Location: login.php");
            exit();
        } else {
            echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "signup.php";
                </script>';
        }
    } else {
        if ($count_user > 0) {
            echo '<script>
                    window.location.href = "signup.php";
                    alert("Username already exists!!");
                </script>';
        }
        if ($count_email > 0) {
            echo '<script>
                    window.location.href = "signup.php";
                    alert("Email already exists!!");
                </script>';
        }
    }
}
?>
