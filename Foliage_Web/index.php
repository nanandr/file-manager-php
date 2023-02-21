<?php
    session_start();
    if(isset($_SESSION['status']))
    {
        header("location:page/admin.php?page=home");
    }
    include "page/function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <?php
        if(isset($_GET['failed']))
        {
            ?>
            <link rel="icon" type="image/x-icon" href="assets/img/icon_error.png" />
            <?php
        }
        else
        {
            ?>
            <link rel="icon" type="image/x-icon" href="assets/img/icon_folder.png" />
            <?php
        }
    ?>
    <title>Foliage</title>
</head>
<body>
    <div class="container">
        <?php include "page/header.php"; ?>
        <?php
            if(isset($_GET['page']))
            {
                if($_GET['page']=='login-page')
                {
                    ?>
                    <div class="login">
                        <div class="login-head">
                            <h1>Hello!</h1>
                            <br>
                        </div>
                        <form action="page/login.php" method="post">
                            <table align="center">
                                <tr>
                                    <td>Username</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="user"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                </tr>
                                <tr>
                                    <td><input type="password" name="pass"></td>
                                </tr>
                                <tr>
                                    <td><br><input type="submit" name="submit" value="Login"></td>
                                </tr>
                            </table>
                        </form>
                        <div class="signup">
                            <br>
                            Don't have an account? <a href="index.php?page=signup-page">Sign Up Here</a>
                        </div>
                    </div>
                    <?php
                }
                else if($_GET['page']=='signup-page')
                {
                    ?>
                    <div class="login">
                        <div class="login-head">
                            <h1>Welcome to Foliage</h1>
                            Manage Your Files With Ease
                            <br>
                        </div>
                        <form action="page/signup.php" method="post" autocomplete="off">
                            <table align="center">
                                <tr>
                                    <td>Full Name</td>
                                </tr>
                                <tr>
                                    <td class="input2" colspan="2"><input type="text" name="fullname"></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                </tr>
                                <tr>
                                    <td class="input2" colspan="2"><input type="text" name="username"></td>
                                </tr>
                                <tr>
                                    <td>Password<br><input type="password" name="pass1"></td>
                                    <td>Confirm Your Password<br><input type="password" name="pass2"></td>
                                </tr>
                                <tr>
                                    <td class="input2" colspan="2"><br><input type="submit" name="submit" value="Signup"></td>
                                </tr>
                            </table>
                        </form>
                        <div class="signup">
                            Back to <a href="index.php?page=login-page">Login Page</a>
                            <br><br>
                        </div>
                    </div>
                    <?php
                }
                else
                {
                ?>
                    <div class="err">
                        <h1>404</h1>
                        Sorry, the page you're looking for doesn't exist
                    </div>
                <?php
                }
                ?>
        <?php
            }
            else
            {
                header("location:index.php?page=login-page");
                exit();
            }
        ?>
        <div class="login-fail">
            <?php
            if(isset($_GET['failed']))
            {
                if($_GET['failed']=='not-logged-in')
                {
                    echo "You need to be logged in first";
                }
                else if($_GET['failed']=='wrong-username-password')
                {
                    echo "Incorrect username or password";
                }
                else if($_GET['failed']=='user-exist')
                {
                    echo "Username already exists";
                }
                else if($_GET['failed']=='password')
                {
                    echo "Password doesn't match";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>