<?php
    include '../../config.php';
    $idPonderacion = $_GET["id"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "DELETE FROM ponderaciones WHERE id = $idPonderacion";
    mysqli_query($con,$query);

    $url = "ver_ponderaciones.php";
    header( "Location: $url" );
?>