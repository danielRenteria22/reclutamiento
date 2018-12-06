<?php
    $id_entrevista = $_GET["id"];
    $con=mysqli_connect("localhost","root","","reclutamiento");
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "DELETE FROM entrevista WHERE id_entrevista = $id_entrevista";
    mysqli_query($con,$query);

    $url = "ver_entrevistas.php";
    header( "Location: $url" );
?>