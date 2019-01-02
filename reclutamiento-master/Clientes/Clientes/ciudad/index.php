<?php 
    include "../../verificacion.php";
    verificar();
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ciudad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>Ciudad</h1>
    <label ><a href="new_cd.php">Agregar Ciudad</a></label>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT officename,officeid,nombre,rfc,direccion,correo FROM offices";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No.</th>\n";
            echo "      <th>Ciudad </th>\n";
            echo "      <th>Nombre </th>\n";
            echo "      <th>RFC </th>\n";
            echo "      <th>Direccion </th>\n";
            echo "      <th>Correo</th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "      <th>".$row[0]."</th>\n";
                echo "      <th>".$row[2]."</th>\n";
                echo "      <th>".$row[3]."</th>\n";
                echo "      <th>".$row[4]."</th>\n";
                echo "      <th>".$row[5]."</th>\n";
                echo "      <th><a href = \"del_cd.php?id=".$row[1]."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n"
    ?>
    
</body>
</html>