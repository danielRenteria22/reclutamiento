<?php 
    include "../../verificacion.php";
    verificar_admin();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
        <center><h1>Cuestionario para referencias</h1></center>
        <?php
            include '../../config.php';
            $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT * FROM cuestionario_referencias";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>Pregunta </th>\n";
            echo "      <th>Editar </th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <td>".$row[1]."</td>\n";
                echo "      <td><a href = \"editar_pregunta.php?id=".$row[0]."\">Editar</a></td>\n";
                echo "      <td><a href = \"borrar_pregunta.php?id=".$row[0]."\">Eliminar</a></td>\n";
                echo "  </tr>";
            }
            echo "</table\n"
        ?>
        <label ><a href="preguntas_formulario.php">Agregar pasos</a></label>
    </body>
</html>
