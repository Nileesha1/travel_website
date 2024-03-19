<?php
include("connectionadmin.php");
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM admin WHERE adminusername = '$username' AND adminpassword = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        header("Location: index2.html");
        exit();
    }
    else{
        echo  '<script>
                        window.location.href = "admin.php";
                        alert("Login failed. Invalid username or password!!")
             </script>';
    }
}
?>