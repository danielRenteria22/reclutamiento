<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Funcion Particular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <center><h1>Crear Funcion Particular</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Funcion:         <input type="text" name="nombre"></label><br>
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
            <input type = "submit" name = "crear" value = "Crear">
    </form>
</body>
</html>

<?php
    include '../../config.php';
    $idp = $_GET["idp"];
    if(isset($_POST['crear'])){
        $conn=mysqli_connect($host,$user,$pass,$name);

        $nombre      = $_POST["nombre"];

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO funciones_especiales 
                        VALUES  (
                                    '',
                                    '".$idp."',
                                    '".$nombre."'
                                );");
        $conn->close();
    }
?>