<div class="header">
    <ul class="header-left">
        <li><img src="<?php if(isset($_SESSION['status'])){echo "../";}?>assets/img/icon_folder.png"></li>
        <li><div class="header-title"><h1>Foliage</h1>Manage Your Files With Ease</div></li>
    </ul>
    <ul class="header-right">
        <li>
                <?php
                    if(isset($_SESSION['status'])){
                        $current_user = $_SESSION['user']; 
                                                                            
                        $query = "SELECT * FROM file_user WHERE username='".$current_user."'";
                        $get_full_name = mysqli_query($data_connect,"$query");
                    
                        $full_name = mysqli_fetch_array($get_full_name);
                ?>
                        <a href="admin.php?page=<?php echo $_GET['page']; if(isset($_GET['id'])){ echo "&id=".$_GET['id'];} echo "&rename&user=".$full_name['id'];?>" class ="column-hideable"><h4><?php echo $full_name['fullname']; ?></h4></a>
                <?php
                    }
                ?>  
        </li>
        <?php if(isset($_SESSION['status'])){?>
            <li>
            <a href="admin.php?page=<?php echo $_GET['page']; if(isset($_GET['id'])){ echo "&id=".$_GET['id'];} echo "&rename&user=".$full_name['id'];?>" class ="icon-hideable"><img src='../assets/img/icon_user.png'></a>
                <a href='logout.php' onclick="return confirm('Are you sure you want to logout?')"><img src='../assets/img/logout.png'></a>
            </li>
    <?php
        }
    ?>
    </ul>
</div>
