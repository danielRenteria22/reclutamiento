<?php
    include '../../config.php';
    $id = $_GET["id"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "UPDATE employees SET tipo = '3' WHERE employid = $id";
    mysqli_query($con,$query);
?>
