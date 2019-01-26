<?php 
    include "../../verificacion.php";
    verificar_admin();
?>

<html>
    
    <head>
       <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
        <a href="../menu/index.html">Volver al menu</a>
        <center><h1> Pasos para requisisiones</h1></center>
        <?php
            include '../../config.php';
            $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT * FROM permisos,pasos_reclutamiento WHERE permisos.id = pasos_reclutamiento.nivel_auto";
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
                echo "      <th>".$row[3]."</th>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "      <th><a href = \"editar_paso.php?id=".$row[2 ]."\">Editar</a></th>\n";
                echo "      <th><a href = \"borrar_paso.php?id=".$row[2 ]."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table\n"
        ?>
        <label ><a href="pasos_contratacion.php">Agregar pasos</a></label>
        
    </body>
    <b><b><b>
        <button onclick="location.href='../menu/index.html'">Atras</button>
</html>
