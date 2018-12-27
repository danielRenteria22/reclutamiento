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
    $sql = "DELETE FROM usuario WHERE id_usuario = $id";
    mysqli_query($conn,$sql);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
    } else{
        header("Location: ver_usuarios.php");
    }
    mysqli_close($conn); 
    
    
?>
