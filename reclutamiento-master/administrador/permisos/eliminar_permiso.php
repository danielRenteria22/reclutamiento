<?php 
    include "../../verificacion.php";
    verificar();
?>

<?php
    $id = $_GET["id"];
    
    include '../../config.php';
    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    $sql = "DELETE FROM permisos WHERE id = $id";
    mysqli_query($conn,$sql);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
    } else{
        header("Location: ver_permisos.php");
    }
    mysqli_close($conn); 
    
    
?>
