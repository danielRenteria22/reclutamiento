<?php 
    include "../../verificacion.php";
    verificar();
?>

<?php
    session_start();
    include '../../config.php';
    $con=mysqli_connect($host,$user,$pass,$name);
    $id_estado = $_GET["idEstado"];
    $id_permiso = $_GET["idPermiso"];
    $id_usuario = $_SESSION["id_usuario"];
    date_default_timezone_set("America/Chihuahua");
	$fecha = date("Y/m/d");

    //Revisa si el usuario esta auutorizado para autorizar este paso
    if($_SESSION["nivel"] != $id_permiso){
        echo "<script>
                alert('No estas autorizado para autorizar este paso');
                window.history.back();
             </script>";
        exit;
    }
    

    //Hace los cambios al estado. Se agrega el usuario, la fecha y se cambia a autorizado
    include '../../config.php';
    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }


    $sql = "UPDATE estado_solicitud 
            SET id_usuario = $id_usuario, fecha = '$fecha', autorizacion = 1
            WHERE id_estado_solicitud = $id_estado";
    mysqli_query($conn,$sql);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
    echo "<script>
            window.history.back();
          </script>";
     
?>
