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
    
     $query = "DELETE FROM offices WHERE officeid = $id";
    mysqli_query($con,$query);
    $url = "index.php";
    header( "Location: $url" );
?>
