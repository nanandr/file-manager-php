<?php
    $owner = $_SESSION['user'];
?>
<div id="content">
    <table class="file-manager">
        <thead>
            <tr>
                <th width="50%">Name</th>
                <th class ="column-hideable" width="20%">Date</th>
                <th class ="column-hideable" width="20%">Type</th>
                <th class ="column-resize" width="10%">Size</th>
                <th class ="column-resize"></th>
                <th class ="column-resize"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_GET['id'])){
            ?>
                <tr>
                    <td colspan="4" width="100%">
                        <?php                      
                            $get_parent = "SELECT * FROM file_manager_folder WHERE id=".$_GET['id'];

                            $check_parent = mysqli_query($data_connect,"$get_parent");
                            $parent=mysqli_fetch_array(mysqli_query($data_connect,"$get_parent"));
                            
                            $url="admin.php?page=file-manager";
                            $limit = mysqli_num_rows(mysqli_query($data_connect,"SELECT * FROM file_manager_folder WHERE id=".$_GET['id']." AND parent IS NOT NULL"));
                            if($limit>0){
                                $url.="&id=".$parent['parent'];
                            }
                        ?>
                        <a href= "<?php echo $url ?>">
                            <img src="../assets/img/icon_back.png">
                            ...
                        </a>
                    </td>
                </tr>
            <?php
                }
            ?>
                <?php
                    $get_folder = "SELECT * FROM file_manager_folder WHERE folderowner='$owner'";

                    if(isset($_GET['id'])){
                        $get_folder .= " AND parent=";
                        $get_folder .= $_GET['id']; 
                    }
                    else{
                        $get_folder .= " AND parent IS NULL";
                    }
                    $limit = mysqli_num_rows(mysqli_query($data_connect,$get_folder));
                    $show_folder = mysqli_query($data_connect,"$get_folder LIMIT $limit");
                    while($folder=mysqli_fetch_array($show_folder)){
                ?>
                <tr>
                    <td>
                        <a href= <?php echo "admin.php?page=file-manager&id=".$folder['id']; ?>>
                            <img src="../assets/img/icon_folder.png">
                            &nbsp;
                            <?php echo $folder["name"]; ?>
                        </a>
                    </td>
                    <td class ="column-hideable">
                        <?php echo date('M j Y g:i A', strtotime($folder["createdOn"])); ?>
                    </td>
                    <td class ="column-resize">Folder</td>
                    <td class ="column-hideable"></td>
                    <td>
                        <a href="admin.php?page=file-manager&rename<?php if(isset($_GET['id'])){echo "&parent=".$_GET['id']."&id=".$_GET['id'];}?>&folder=<?php echo $folder['id'] ?>"><img src="../assets/img/icon_rename.png"></a>
                    </td>
                    <td>
                        <a href="delete.php?type=folder<?php if(isset($_GET['id'])){echo "&parent=".$_GET['id'];}?>&id=<?php echo $folder['id']; ?>" onclick="return confirm('Are you sure you want to delete this folder?')"><img src="../assets/img/icon_delete.png"></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            
                <?php
                    $owner = $_SESSION['user'];
                    $get_file = "SELECT * FROM file_manager WHERE fileowner='$owner'";

                    if(isset($_GET['id'])){
                        $get_file .= " AND folder=";
                        $get_file .= $_GET['id']; 
                    }
                    else{
                        $get_file .= " AND folder IS NULL";
                    }
                    $limit = mysqli_num_rows(mysqli_query($data_connect,$get_file));
                    $show_file = mysqli_query($data_connect,"$get_file LIMIT $limit");
                    while($file=mysqli_fetch_array($show_file)){
                ?>
                <tr>
                    <td>
                        <a href=<?php echo "'uploads/".$file['file_name']."'"; ?> target="_blank">
                            <?php echo get_type($file["file_type"],$file["real_name"],"icon");?> &nbsp;
                            <?php echo $file["real_name"]; ?>
                        </a>
                    </td>
                    <td class ="column-hideable">
                        <?php echo date('M j Y g:i A', strtotime($file["createdOn"])); ?>
                    </td>
                    <td class ="column-hideable">
                        <?php echo get_type($file["file_type"],$file["real_name"],"type"); ?>
                    </td>
                    <td class ="column-resize">
                        <?php echo formatBytes($file["file_size"]); ?>
                    </td>
                    <td>
                        <a href="admin.php?page=file-manager&rename<?php if(isset($_GET['id'])){echo "&id=".$_GET['id'];}?>&file=<?php echo $file['id'];?>"><img src="../assets/img/icon_rename.png"></a>
                    </td>
                    <td>
                        <a href="delete.php?type=file<?php if(isset($_GET['id'])){echo "&parent=".$_GET['id'];}?>&id=<?php echo $file['id'] . "&name=" . $file['file_name']; ?>" onclick="return confirm('Are you sure you want to delete this file?')"><img src="../assets/img/icon_delete.png"></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
        </tbody>
    </table>
    
    <div class="upload">
        <div class="upload-form">
            <form method="post" enctype="multipart/form-data" autocomplete="off" action="upload.php">
                <?php                   
                    if(isset($_GET['id'])){
                ?>
                        <input type="text" name="id" value="<?php echo $_GET['id'];?>">
                <?php
                    }
                ?>
                <input type="text" name="owner" value="<?php echo $owner;?>"> 
                <table>
                    <tr>
                        <td>File</td>
                        <td>:</td>
                        <td><label for="upload-file" class="upload-file">Upload File..</label><input id="upload-file" type="file" name="file"/></td>
                    </tr>
                    <tr><td colspan="3"></td></tr>
                    <tr>
                        <td>Folder</td>
                        <td>:</td>
                        <td><input type="text" name="folder"></td>
                    </tr>
                </table>
        </div>
        <div class="upload-button">
                <button type="submit" name="submit">+</button>
            </form>
        </div>
    </div>
</div>