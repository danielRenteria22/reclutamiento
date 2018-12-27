<?php 
    include "../../verificacion.php";
    verificar();
?>

<?php
    include '../../config.php';
    $id = $_GET["id"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "UPDATE solicitudes SET descalificado = 1 WHERE id_usuario = $id";
    mysqli_query($con,$query);
    $url = "ver_req.php";
    header( "Location: $url" );
?>
