<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Obra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <center><h1>Crear Obra</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Obra      <input type="text" name="obra"></label><br>
    <label>Encargado <input type="text" name="encargado"></label><br>
    <label>Direccion <input type="text" name="direcion"></label><br>
    <label>RFC       <input type="text" name="rfc"></label><br>
    <label>Telefono  <input type="text" name="tel"></label><br>
    <label>Correo    <input type="text" name="correo"></label><br>
    <?php
                include '../../config.php';
                $con=mysqli_connect($host,$user,$pass,$name);
                if (mysqli_connect_errno())
                {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    //exit;
                }
//cliente
                $query2 = "SELECT groupid,groupname FROM groups ORDER BY groupname";
                $result2 = mysqli_query($con,$query2);
                echo "Cliente: <select id = \"cliente\" name=\"cliente\">\n";
                while($row = mysqli_fetch_array($result2)){
                        echo "<option value=".$row["groupid"].">".$row["groupname"]."</option>\n";
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

        $obra      = $_POST["obra"];
        $encargado = $_POST["encargado"];
        $direcion  = $_POST["direcion"];
        $rfc       = $_POST["rfc"];
        $tel       = $_POST["tel"];
        $correo    = $_POST["correo"];
        $cliente   = $_POST["cliente"];

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO works 
                        VALUES  (
                                    '".$obra."',
                                    '',
                                    '".$cliente."',
                                    '".$tel."',
                                    '".$encargado."',
                                    '".$rfc."',
                                    '".$direcion."',
                                    '".$correo."'
                                );");
        $conn->close();
    }
?>
