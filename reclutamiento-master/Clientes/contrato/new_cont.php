<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Contrato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <center><h1>Crear Contrato</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Tipo de Contrato         <input type="text" name="nombres"></label><br>
    <?php
                include '../../config.php';
                $con=mysqli_connect($host,$user,$pass,$name);
                if (mysqli_connect_errno())
                {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    //exit;
                }
//empleador
                $query = "SELECT empid,nombre FROM empleador ORDER BY nombre";
                $result = mysqli_query($con,$query);
                echo "Empleador: <select id = \"empleado\" name=\"empleado\">\n";
                while($row = mysqli_fetch_array($result)){
                        echo "<option value=".$row["empid"].">".$row["nombre"]."</option>\n";
                }
                echo "</select><br>\n";               
                
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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "reclutamiento";
        $conn=mysqli_connect($host,$user,$pass,$name);

        $nombres      = $_POST["nombres"];
        $empleado    = $_POST["empleado"];

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO contratos 
                        VALUES  (
                                    '',
                                    '".$nombres."',
                                    '".$empleado."'
                                );");
        $conn->close();
    }
?>
