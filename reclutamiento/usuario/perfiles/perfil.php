<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Perfiles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="main.js"></script>
</head>
<body>
    <h1>Perfiles</h1>
    <label ><a href="new_prof.php">Crear pefil</a></label>
    <?php
        $con=mysqli_connect("localhost","root","","reclutamiento");
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT id_perfil,nombre,vacante, descripcion_del_puesto FROM perfil";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No.</th>\n";
            echo "      <th>Nombre </th>\n";
            echo "      <th>Vacante </th>\n";
            echo "      <th>Descripcion </th>\n";
            echo "      <th>Ver </th>\n";
            echo "      <th>Eliminar</th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>".$row[0]."</th>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "      <th>".$row[2]."</th>\n";
                echo "      <th>".$row[3]."</th>\n";
                echo "      <th><a href = \"inf_prof.php?id=".$row[0]."\">Ver</a></th>\n";
                echo "      <th><a href = \"del_prof.php?id=".$row[0]."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n"
    ?>
    
</body>
</html>