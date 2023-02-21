<?php
    include "connect.php";
    if(isset($_POST['id']) && isset($_POST['type']) && $_POST['new_name']){
        $page = $_POST['page'];
        $id = $_POST['id'];
        $type = $_POST['type'];
        $new_name = $_POST['new_name'];
        $query = "UPDATE ";
        $success = false;

        $header = "location:admin.php?page=";
        $header .= $page;
        if(isset($_POST['parent'])){
            $header .= "&id=".$_POST['parent'];
        }
        
        if($type=="file"){
            $old_name = $_POST['old_name'];
            $old_file_type = substr($old_name, -4);
            $new_file_type = substr($new_name, -4);
            $dot_check = substr_count($new_name,".");
            $length_check = explode(".", $new_name,"2");
            if($old_file_type == $new_file_type && $dot_check == 1 && strlen($length_check[0]) > 0){
                $query .= "file_manager SET ";
                $query .= "real_name = ";
                $query .= "'$new_name'";
                $success = true;                
            }
            else{
                $header .= "&rename=failed";
                if(isset($_POST['parent'])){
                    $header .= "&id=".$_POST['parent'];
                }
                $header .= "&file=".$_POST['id'];
                header($header);
            }
        }
        else if($type=="folder"){
            $query .= "file_manager_folder SET ";
            $query .= "name = ";
            $query .= "'$new_name'";
            $success = true;             
        }
        else if($type=="user"){

            $query .= "file_user SET ";
            $query .= "fullname = ";
            $query .= "'$new_name'";

            if($_POST['old_pass'] == null && $_POST['new_pass'] == null){
                $success = true;    
            }

            if($_POST['old_pass'] != null && $_POST['new_pass'] != null){
                $old_pass = md5($_POST['old_pass']);
                $news_pass = md5($_POST['new_pass']);
                $check_pass = mysqli_query($data_connect,"SELECT * FROM file_user WHERE id= $id AND password = '$old_pass'");
                if(mysqli_num_rows($check_pass) > 0){
                    $query .= ", password = ";
                    $query .= "'$news_pass'";
                    $success = true;
                    $header = "location:logout.php";   
                }
                else{
                    $header .= "&rename=failed-pass";
                    if(isset($_POST['parent'])){
                        $header .= "&id=".$_POST['parent'];
                    }
                    $header .= "&user=".$_POST['id'];
                    header($header);
                }
            }
            else if($_POST['old_pass'] != $_POST['new_pass']){
                $header .= "&rename=failed-pass";
                if(isset($_POST['parent'])){
                    $header .= "&id=".$_POST['parent'];
                }
                $header .= "&user=".$_POST['id'];
                header($header);
            }   
        }
        $query .= " WHERE id = $id";
        
        if($success==true){
            mysqli_query($data_connect,$query);
        }

        header($header);
    }
?>