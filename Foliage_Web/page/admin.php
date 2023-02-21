<?php
    session_start();
    if($_SESSION['status']!="login")
    {
        if($_SESSION['status']!="signup")
        {
            header("location:../index.php?page=login-page&failed=not-logged-in");
        }
    }
    include "connect.php";
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" type="image/x-icon" href="../assets/img/icon_folder.png" />
        <title>Foliage</title>
    </head>
    <body>
        <div class="container">
            <?php
                include "header.php";
                if(isset($_GET['page'])){
            ?>
                    <div class="nav">
                        <ul class="nav-list">
                            <li class="files"><a href="admin.php?page=home"><h4>Home</h4></a></li>
                            <li class="files"><a href="admin.php?page=file-manager"><h4>Your Files</h4></a></li>
                        </ul>
                        <br>
                    </div>
            <?php
                }
                if(isset($_GET['page'])){
                    if($_GET['page']=='home')
                    {
                        include "home.php";
                    }
                    else if($_GET['page']=='file-manager')
                    {
                        include "file-manager.php";
                    }
                    else if($_GET['page']=='logout')
                    {
                        header("location:logout.php");
                        exit();
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
                }
                else{
                    header("location:admin.php?page=home");
                }
                if(isset($_GET['id'])){
                    if(empty($_GET['id'])){
                        header("location:admin.php?page=file-manager");
                        exit();
                    }
                }
            ?>

        </div>
    </body>
<?php
    if(isset($_GET['rename'])){
        $rename_query = "SELECT * FROM ";
        if(isset($_GET['file'])){
            $rename_query .= "file_manager WHERE id=".$_GET['file'];
            $column = "real_name";
            $type = "file";
        }
        else if(isset($_GET['folder'])){
            $rename_query .= "file_manager_folder WHERE id=".$_GET['folder'];
            $column = "name";
            $type = "folder";
        }
        else if(isset($_GET['user'])){
            $rename_query .= "file_user WHERE id='".$_GET['user']."'";
            $column = "fullname";
            $type = "user";
        }
        $rename_show = mysqli_query($data_connect,"$rename_query");
        $rename = mysqli_fetch_array($rename_show);
?>
        <div class="rename-form">
            <a href="admin.php?page=file-manager<?php if(isset($_GET['id'])){echo "&id=".$_GET['id'];}?>" align="right">x</a>
            <form method="post" autocomplete="off" action="rename.php">
            <table>
                <tr>
                    <td colspan="1"><input type="text" placeholder="Name" name="new_name"
                    value="<?php echo $rename[$column]; ?>" required></td>
                </tr>
                <?php if(isset($_GET['id'])){?>
                <tr></tr><td><input type="text" name="parent" value="<?php echo $_GET['id']; ?>"></td></tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td><input type="text" name="id"
                        value="<?php echo $rename['id']; ?>" required></td>

                        <td><input type="text" name="page"
                        value="<?php echo $_GET['page']; ?>"></td>
                        
                        <?php if($type=="file"){?><td><input type="text" name="old_name"
                        value="<?php echo $rename['real_name']; ?>"></td><?php } ?>
                        
                        <td><input type="text" name="type"
                        value="<?php echo $type; ?>"></td>
                    </tr>
                    <?php if(isset($_GET['rename']) == false){?>
                        <tr>
                            <td>
                                Enter New <?php if(isset($_GET['file'])){echo "File";}else if(isset($_GET['folder'])){echo "Folder";}?> Name
                            </td> 
                        </tr>
                    <?php
                    }
                    ?>
                <?php if(isset($_GET['user'])){?>
                    <tr>
                        <td colspan="1"><input type="password" placeholder="Enter Your Old Password" name="old_pass"></td>
                    </tr>
                    <tr>
                        <td colspan="1"><input type="password" placeholder="Enter Your New Password" name="new_pass"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="id"
                        value="<?php echo $rename['id']; ?>" required></td>
                    </tr>
                <?php
                    }
                ?>
                </tr>
                    <td><label class="rename-button" for="rename-button">Rename</label><button type="submit" id="rename-button" colspan="2"></button></td>
            </table>
            <?php if($_GET['rename']=="failed"){ echo "<div class='message'>Invalid name, try again</div>"; } else if($_GET['rename']=="failed-pass"){ echo "<div class='message'>Password doesn't match, try again</div>"; }?>
        </div>
<?php
    }
?>
</html>