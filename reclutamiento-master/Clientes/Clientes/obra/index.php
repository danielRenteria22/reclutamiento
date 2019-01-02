<?php 
    include "../../verificacion.php";
    verificar();
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Obras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>Obras</h1>
    <label ><a href="new_obra.php">Agregar Obra</a></label>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT IDWork,Workname,groupid,nombre,rfc,direccion,correo,phone FROM works";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No.</th>\n";
            echo "      <th>Obra </th>\n";
            echo "      <th>Cliente </th>\n";
            echo "      <th>Encargado </th>\n";
            echo "      <th>RFC </th>\n";
            echo "      <th>Direccion </th>\n";
            echo "      <th>Correo</th>\n";
            echo "      <th>Telefono</th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                $id      = $row[0];
                $obra    = $row[1];
                $cliente = $row[2];
                $nombre  = $row[3];
                $rfc     = $row[4];
                $dir     = $row[5];
                $correo  = $row[6];
                $tel     = $row[7];

                $querys = "SELECT groupname FROM groups WHERE $cliente = groupid";
                $results = mysqli_query($con,$querys);
                while($row = mysqli_fetch_array($results))
                {
                    $name = $row[0];
                }
                echo "      <th>".$id."</th>\n";
                echo "      <th>".$obra."</th>\n";
                echo "      <th>".$name."</th>\n";
                echo "      <th>".$nombre."</th>\n";
                echo "      <th>".$rfc."</th>\n";
                echo "      <th>".$dir."</th>\n";
                echo "      <th>".$correo."</th>\n";
                echo "      <th>".$tel."</th>\n";
                
                echo "      <th><a href = \"del_obra.php?id=".$id."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n"
    ?>
    
</body>
</html>