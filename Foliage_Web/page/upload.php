<?php        
    include "connect.php";

    function get_random_name($num=6){
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for($i = 0; $i < $num; $i++){
            $string .= $characters[mt_rand(0,$max)];
        }
        return $string;
    }

    $header = "location:admin.php?page=file-manager";
    if(isset($_POST['id'])){
        $header .= "&id=".$_POST['id'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

        $owner = $_POST['owner'];
        $directory = "./uploads/";

        $file_query = "INSERT INTO file_manager (file_name, real_name, file_size, file_type, fileowner";
        $folder_query = "INSERT INTO file_manager_folder (name, folderOwner";

        if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
            $file_name = $_FILES["file"]["name"];
            $file_size = $_FILES["file"]["size"];
            $file_type = $_FILES["file"]["type"];
            $random_name = get_random_name() . "." . pathinfo($file_name, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["file"]["tmp_name"], $directory . $random_name);

            if(isset($_POST['id'])){
                $file_query .= ", folder";
            }
            $file_query .= ") VALUES ('$random_name', '$file_name', '$file_size', '$file_type','$owner'";
            if(isset($_POST['id'])){
                $folder_id = $_POST['id'];
                $file_query .= ", '$folder_id'";
            }
            $file_query .= ")";
            mysqli_query($data_connect,$file_query);
        }
        else{
            $folder_name = $_POST["folder"];
            if(isset($_POST['id'])){
                $folder_query .= ", parent";
            }
            $folder_query .= ") VALUES ('$folder_name', '$owner'";
            if(isset($_POST['id'])){
                $folder_id = $_POST['id'];
                $folder_query .= ", '$folder_id'";
            }
            $folder_query .= ")";
            mysqli_query($data_connect,$folder_query);
        }
    }
    header($header);
?>