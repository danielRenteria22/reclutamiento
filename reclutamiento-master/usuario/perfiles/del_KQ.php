<?php 
    include "../../verificacion.php";
    verificar();
?>

<?php
    include '../../config.php';
    $id = $_GET["id"];
    $idp = $_GET["idp"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "DELETE FROM killer_question WHERE id = $id";
    mysqli_query($con,$query);
    $query2 = "DELETE FROM respuestas WHERE id_killer_question = $id";
    mysqli_query($con,$query2);

    $url = "inf_prof.php?id=$idp";
    header( "Location: $url" );
?>
