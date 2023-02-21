<?php
    include "connect.php";
    include "function.php";
    $header = "location:admin.php?page=file-manager";
    if(isset($_GET['parent'])){
        $header .= "&id=".$_GET['parent'];
    }

    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['type']))
    {
        $id = $_GET['id'];

        if($_GET['type'] == 'file')
        {
            $type = "file_manager";
            $path = "uploads/";
            $path .= $_GET['name'];
            unlink($path);
        }
        else if($_GET['type'] == 'folder')
        {
            $type = "file_manager_folder";
        }
        mysqli_query($data_connect,"DELETE FROM $type WHERE id=$id");

        if($_GET['type'] == 'folder')
        {
            $child_file = mysqli_query($data_connect,"SELECT * FROM file_manager WHERE folder=$id");
            $check_file = mysqli_num_rows($child_file);
            if($check_file>0)
            {
                mysqli_query($data_connect,"DELETE FROM file_manager WHERE folder=$id");
                while($file_name = mysqli_fetch_array($child_file)){
                    $path = "uploads/";
                    $path .= $file_name['file_name'];
                    unlink($path);
                }        
            }

            $child_folder = mysqli_query($data_connect,"SELECT * FROM $type WHERE folder=$id");
            $check_folder = mysqli_num_rows($child_folder);
            if($check_folder>0)
            {
                mysqli_query($data_connect,"DELETE FROM $type WHERE parent=$id");           
            }
        }
    }
    header($header);
    exit();
?>