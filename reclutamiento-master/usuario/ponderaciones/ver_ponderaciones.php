<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Ponderaciones</title>
</head>
<body>
    <h1>Ponderaciones</h1>
    <a href="../menu/index.html">Volver al menu</a>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
        //Obtenemps todas las ponderaciones
        $query = "SELECT id,nombre FROM ponderaciones;";
        $resultPonderaciones = mysqli_query($con,$query);
        
        while($row = mysqli_fetch_array($resultPonderaciones)){
            $idPonderacion = $row[0];
            $nombre = $row[1];
            echo "<h3>$nombre</h3>";
            echo "<label ><a href=\"editar_ponderacion.php?id=$idPonderacion&nombre=$nombre\">Editar </a></label>";
            echo "<label ><a href=\"borrar_ponderacion.php?id=$idPonderacion\">Eliminar</a></label><br>";
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>Consideracion</th>\n";
            echo "      <th>Peso</th>\n";
            echo "</tr>\n";

            /*Obtenemos todos los detalle de poderacion*/
            $query = "SELECT nombre_campo,peso,id FROM detalle_ponderacion WHERE id_ponderacion =$idPonderacion;";
            $resultDetalle = mysqli_query($con,$query);
            while($rowDetalle = mysqli_fetch_array($resultDetalle)){
                $consideracion = $rowDetalle[0];
                $peso = $rowDetalle[1];
                $idDetalle = $rowDetalle[2];
                echo "  <tr>\n";
                echo "      <th>$consideracion</th>\n";
                echo "      <th>$peso</th>\n";
                echo "  </tr>";
            }
            
            echo "</table>\n";
        }
        mysqli_close($con); 
    ?>

    <label ><a href="crear_ponderacion.php">Crear</a></label>
</body>
</html>
