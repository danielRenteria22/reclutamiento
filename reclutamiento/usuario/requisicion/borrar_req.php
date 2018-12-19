<?php
    include '../../config.php';
    $idReq = $_GET["id"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "DELETE FROM requisicion WHERE id = $idReq";
    mysqli_query($con,$query);

    $url = "ver_req.php";
    header( "Location: $url" );
?>