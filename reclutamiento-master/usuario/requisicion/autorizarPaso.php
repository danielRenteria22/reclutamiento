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


    $sql = "UPDATE estado_req 
            SET idUsuario = $id_usuario, fecha = '$fecha', autorizacion = 1
            WHERE id = $id_estado";
    mysqli_query($conn,$sql);
    if(mysqli_error($conn)){
        echo mysqli_error($conn);
    }
    $pasomax;
    $pasoactual;
    $requisicion;
    $query = "SELECT id FROM pasos_requisicion WHERE id = (SELECT MAX(id) from pasos_requisicion)";
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($result)){
        $pasomax=$row[0];
    }
    $query2 = "SELECT idPaso,idRequisicion FROM estado_req WHERE id = $id_estado";
    $result2 = mysqli_query($conn,$query2);
    while($row = mysqli_fetch_array($result2)){
        $pasoactual=$row[0];
        $requisicion=$row[1];
    }
    if($pasomax == $pasoactual)
    {
        $sqll = "UPDATE requisicion SET autorizacion = 1 WHERE id = $requisicion";
        mysqli_query($conn,$sqll);
        if(mysqli_error($conn)){
            echo mysqli_error($conn);
        }
    }


    mysqli_close($conn);
    header("Location: ver_req.php");
     
?>
