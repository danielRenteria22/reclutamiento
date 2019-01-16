<?php 
    include "../../verificacion.php";
    verificar_admin();
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
    $sql = "UPDATE employees
            SET tipo = '1'
            WHERE $id = employid";
    mysqli_query($conn,$sql);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
    } else{
        header("Location: ver_mercado.php");
    }
    mysqli_close($conn); 
    
    
?>
