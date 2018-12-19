<?php
    include '../../config.php';
    $id = $_GET["id"];
    $idp = $_GET["idp"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "DELETE FROM killer_q WHERE id = $id";
    mysqli_query($con,$query);

    $url = "inf_prof.php?id_perfil=$idp";
    header( "Location: $url" );
?>