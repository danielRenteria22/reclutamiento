<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <center><h1>Crear Perfil</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Cliente      <input type="text" name="cliente"></label><br>
    <label>Encargado <input type="text" name="encargado"></label><br>
    <label>Direccion <input type="text" name="direcion"></label><br>
    <label>RFC       <input type="text" name="rfc"></label><br>
    <label>Correo    <input type="text" name="correo"></label><br>
    <?php
                include '../../config.php';
                $con=mysqli_connect($host,$user,$pass,$name);
                if (mysqli_connect_errno())
                {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    //exit;
                }
//ciudad
                $query = "SELECT officename,officeid FROM offices ORDER BY officename";
                $result = mysqli_query($con,$query);
                echo "Ciudad: <select id = \"ciudad\" name=\"ciudad\">\n";
                while($row = mysqli_fetch_array($result)){
                        echo "<option value=".$row["officeid"].">".$row["officename"]."</option>\n";
                }
                echo "</select><br>\n";
                
                
                mysqli_close($con); 
            ?>
            <input type = "submit" name = "crear" value = "Crear perfil">
    </form>
</body>
</html>

<?php
    include '../../config.php';
    if(isset($_POST['crear'])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "reclutamiento";
        $conn=mysqli_connect($host,$user,$pass,$name);

        $cliente   = $_POST["cliente"];
        $encargado = $_POST["encargado"];
        $direcion  = $_POST["direcion"];
        $rfc       = $_POST["rfc"];
        $correo    = $_POST["correo"];
        $ciudad    = $_POST["ciudad"];

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO groups 
                        VALUES  (
                                    '".$cliente."',
                                    '',
                                    '".$ciudad."',
                                    '".$encargado."',
                                    '".$rfc."',
                                    '".$direcion."',
                                    '".$correo."'
                                );");
        $conn->close();
    }
?>
