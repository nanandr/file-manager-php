<?php
    session_start();
    include "connect.php";
    include "function.php";

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password1= md5($_POST['pass1']);
    $password2 = md5($_POST['pass2']);

    if($password1==$password2)
    {
        $query_check = mysqli_query($data_connect,"SELECT * FROM file_user WHERE username = '$username'");
        $user_check = mysqli_num_rows($query_check);
        if($user_check>0)
        {
            header("location:../index.php?page=signup-page&failed=user-exist");
            exit();
        }
        else
        {
            mysqli_query($data_connect,"INSERT INTO file_user (fullname, username, password) VALUES ('$fullname','$username', '$password1')");
            $_SESSION['user']=$username;
            $_SESSION['status']="signup";
            header("location:admin.php?page=home");
            exit();
        }
    }
    else
    {
        header("location:../index.php?page=signup-page&failed=password");
        exit();
    }
?>