<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ciudad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <center><h1>Agregar Ciudad</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Ciudad    <input type="text" name="ciudad"></label><br>
    <label>Encargado <input type="text" name="nombre"></label><br>
    <label>RFC       <input type="text" name="rfc"></label><br>
    <label>Direccion <input type="text" name="direccion"></label><br>
    <label>Correo    <input type="text" name="correo"></label><br>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            //exit;
        }
        
        mysqli_close($con); 
    ?>
    <input type = "submit" name = "crear" value = "Crear perfil">
    </form>
</body>
</html>

<?php
    include '../../config.php';
    if(isset($_POST['crear'])){
        $conn=mysqli_connect($host,$user,$pass,$name);

        $ciudad    = $_POST["ciudad"];
        $nombre    = $_POST["nombre"];
        $rfc       = $_POST["rfc"];
        $direccion = $_POST["direccion"];
        $correo    = $_POST["correo"];

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO offices 
                        VALUES  (
                                    '".$ciudad."',
                                    '',
                                    '".$nombre."',
                                    '".$rfc."',
                                    '".$direccion."',
                                    '".$correo."'
                                );");
        $conn->close();
    }
?>
