<?php 
    include "../../verificacion.php";
    verificar();
?>

<?php
    include '../../config.php';
    $ids = $_GET["id"];
    $idp = $_GET["idp"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "DELETE FROM funciones_gles WHERE id = $ids";
    mysqli_query($con,$query);
    echo"$idp";
    $url = "inf_prof.php?id=$idp";
    header( "Location: $url" );
?>
