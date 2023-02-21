<?php
    session_start();
    include "connect.php";
    include "function.php";

    $username = $_POST['user'];
    $password = md5($_POST['pass']);

    $query = mysqli_query($data_connect,"SELECT * FROM file_user WHERE username='$username' AND password='$password'");
    $check = mysqli_num_rows($query);

    if($check>0)
    {
        $_SESSION['user']=$username;
        $_SESSION['status']="login";

        header("location:admin.php?page=home");
        exit();
    }
    else
    {
        header("location:../index.php?page=login-page&failed=wrong-username-password");
        exit();
    }
?>