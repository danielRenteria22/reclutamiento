<?php 
    include "../../verificacion.php";
    verificar();
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>Cliente</h1>
    <label ><a href="new_cl.php">Agregar Cliente</a></label>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT groupid,groupname,officeid,nombre,rfc,direccion,correo FROM groups";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No.</th>\n";
            echo "      <th>Cliente </th>\n";
            echo "      <th>Ciudad </th>\n";
            echo "      <th>Encargado </th>\n";
            echo "      <th>RFC </th>\n";
            echo "      <th>Direccion </th>\n";
            echo "      <th>Correo</th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                $id      = $row[0];
                $cliente = $row[1];
                $ciudad  = $row[2];
                $nombre  = $row[3];
                $rfc     = $row[4];
                $dir     = $row[5];
                $correo  = $row[6];

                $querys = "SELECT officename FROM offices WHERE $ciudad = officeid";
                $results = mysqli_query($con,$querys);
                while($row = mysqli_fetch_array($results))
                {
                    $name = $row[0];
                }
                echo "      <th>".$id."</th>\n";
                echo "      <th>".$cliente."</th>\n";
                echo "      <th>".$name."</th>\n";
                echo "      <th>".$nombre."</th>\n";
                echo "      <th>".$rfc."</th>\n";
                echo "      <th>".$dir."</th>\n";
                echo "      <th>".$correo."</th>\n";
                
                echo "      <th><a href = \"del_cl.php?id=".$id."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n"
    ?>
    
</body>
</html>