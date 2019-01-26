<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Perfiles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>Perfiles</h1>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
        $idr = $_GET['id'];
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No.</th>\n";
            echo "      <th>Nombre </th>\n";
            echo "      <th>Apellido </th>\n";
            echo "      <th>Telefono </th>\n";
            echo "      <th>Correo </th>\n";
            echo "      <th>Informacion</th>\n";
            echo "      <th>Contratar</th>\n";
            echo "</tr>\n";
            $c=1;
            $query2 = "SELECT id_usuario FROM solicitudes where id_requisicion = $idr AND descalificado = 0";
            $result2 = mysqli_query($con,$query2);
            while($row = mysqli_fetch_array($result2)){
                $busca = $row[0];
                $query = "SELECT empfullname,apellidos,email,telefono,employid FROM employees where tipo = '0' AND employid = $busca";
                $result = mysqli_query($con,$query);
                while($row2 = mysqli_fetch_array($result)){
                    echo "  <tr>\n";
                    echo "      <th>$c</th>\n";
                    echo "      <th>".$row2[0]."</th>\n";
                    echo "      <th>".$row2[1]."</th>\n";
                    echo "      <th>".$row2[3]."</th>\n";
                    echo "      <th>".$row2[2]."</th>\n";
                    echo "      <th><a href = \"inf_asp.php?id=".$row2[4]."&id_solicitud=$idr\">Ver</a></th>\n";
                    echo "      <th><a href = \"update_asp.php?id=".$row2[4]."&id_solicitud=$idr\">Contratar</a></th>\n";
                    echo "  </tr>";
                    $c++;
                }
            }
            echo "</table>\n"
    ?>
    
</body>
<button onclick="location.href='ver_req.php'">Atras</button>
</html>
