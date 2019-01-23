<?php 
    include "../../verificacion.php";
    verificar();
?>

<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ver Requisiciones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>Requisiciones aprovadas</h1>
    <a href="../menu/index.html">Volver al menu</a>
    <label ><a href="crear_req.php">Crear requisicion</a></label>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT id,nombre FROM requisicion WHERE autorizacion = 1";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>Nombre </th>\n";
            echo "      <th>Aspirantes </th>\n";
            echo "      <th>Editar </th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "      <th><a href = \"contrato.php?id=".$row[0]."\">Ver</a></th>\n";
                echo "      <th><a href = \"editar_req.php?id=".$row[0]."\">Editar</a></th>\n";
                echo "      <th><a href = \"borrar_req.php?id=".$row[0]."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n"
    ?>

    <h1>Requisiciones en proceso de aprovamiento</h1>
    <?php
            include '../../config.php';        
            $query = "SELECT id,nombre FROM requisicion WHERE autorizacion = 0";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>Nombre </th>\n";
            echo "      <th>Proximo paso</th>\n";
            echo "      <th>Editar </th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                $idReq = $row[0];
                /*Obtenemos el id,nombre y nivel de autorizacion del proximo paso*/
                $query = "SELECT a.id,b.id_Permisos,b.nombre FROM estado_req a 
                          INNER JOIN pasos_requisicion b on a.idPaso = b.id 
                          WHERE a.idRequisision = $idReq AND a.autorizacion = 0 
                          ORDER BY a.idPaso ASC LIMIT 1";
                $resultPaso = mysqli_query($con,$query);
                $sigPaso = mysqli_fetch_array($resultPaso);
                $pasoID = $sigPaso[0];
                $paso_permisoID = $sigPaso[1];
                $nombrePaso = $sigPaso[2];


                echo "  <tr>\n";
                echo "      <th><a>".$row[1]."</a> </th>\n";
                echo "      <th> <a>$nombrePaso(Aprovar)</a> </th>";
                echo "      <th><a href = \"editar_req.php?id=".$row[0]."\">Editar</a></th>\n";
                echo "      <th><a href = \"borrar_req.php?id=".$row[0]."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n";
            mysqli_close($con); 
    ?>
    
</body>
</html>
