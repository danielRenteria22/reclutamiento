<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
        <center><h1> Pasos para requisisiones</h1></center>
        <?php
            include '../../config.php';
            $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT * FROM permisos,pasos_requisicion WHERE permisos.id = pasos_requisicion.id_permisos ";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>Descripcion </th>\n";
            echo "      <th>Nivel de autorizacion </th>\n";
            echo "      <th>Editar </th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>".$row[5]."</th>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "      <th><a href = \"editar_paso.php?id=".$row[2 ]."\">Editar</a></th>\n";
                echo "      <th><a href = \"borrar_Paso.php?id=".$row[2 ]."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n"
        ?>
        <label ><a href="pasos_requisision.php">Agregar pasos</a></label>
    </body>
</html>
