<?php
include("./connect/connection.php");
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "select * from user where user_email='$username' and user_password='$password'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        header("Location:home.php");
    } else {
        echo `<script>
        window.location.href="login.php";
        alert("Login failed") 
        </script>`;
    }
}

?>