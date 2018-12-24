<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Entrevistas</title>
</head>
<body>
    <h1>Entrevistas</h1>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
        //Obtenemps todas las ponderaciones
        $query = "SELECT id_entrevista,nombre FROM  entrevista;";
        $resultPonderaciones = mysqli_query($con,$query);
        
        while($row = mysqli_fetch_array($resultPonderaciones)){
            $id_entrevista = $row[0];
            $nombre = $row[1];
            echo "<h3>$nombre</h3>";
            echo "<label ><a href=\"editar_entrevista.php?id=$id_entrevista&nombre=$nombre\">Editar </a></label>";
            echo "<label ><a href=\"borrar_entrevista.php?id=$id_entrevista\">Eliminar</a></label><br>";
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>Pregunta</th>\n";
            echo "</tr>\n";

            /*Obtenemos todos los detalle de poderacion*/
            $query = "SELECT pregunta,id_pregunta_entrevista FROM pregunta_entrevista WHERE id_entrevista =$id_entrevista;";
            $resultDetalle = mysqli_query($con,$query);
            while($rowDetalle = mysqli_fetch_array($resultDetalle)){
                $pregunta = $rowDetalle[0];
                $idDetalle = $rowDetalle[1];
                echo "  <tr>\n";
                echo "      <td>$pregunta</th>\n";
                echo "  </tr>";
            }
            
            echo "</table>\n";
        }
        mysqli_close($con); 
    ?>

    <label ><a href="crear_entrevista.php">Crear</a></label>
</body>
</html>
