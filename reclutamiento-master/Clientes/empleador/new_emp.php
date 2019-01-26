<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Empleador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <center><h1>Agregar Empleador</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Empleador <input type="text" name="emp"></label><br>
    <label>Nombre    <input type="text" name="nombre"></label><br>
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
    <button onclick="location.href='index.php'">Atras</button>
</body>
</html>

<?php
    include '../../config.php';
    if(isset($_POST['crear'])){
        $conn=mysqli_connect($host,$user,$pass,$name);

        $emp    = $_POST["emp"];
        $nombre    = $_POST["nombre"];

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO empleador 
                        VALUES  (
                                    '',
                                    '".$emp."',
                                    '".$nombre."'
                                );");
        $conn->close();
    }
?>
