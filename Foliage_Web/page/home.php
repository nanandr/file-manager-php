<div class="home">
    <hr>
    <h1>
        <?php 
        $status=$_SESSION['status'];
        if($status=="signup")
        {
            echo "Welcome, " . $full_name['fullname'] . "!";
        }
        else if($status=="login")
        {
            echo "Welcome Back, " . $full_name['fullname'] . "!";
        }
        ?>
    </h1>
    <img id="images" src="../assets/img/1.png">
    <script src="../assets/js/script.js"></script>
</div>
<div class="footer">
    <h6>Copyright by Nandana Rafi Ardika</h6>
</div>