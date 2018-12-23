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
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT empfullname,apellidos,email,telefono,employid FROM employees where tipo = '1'";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No.</th>\n";
            echo "      <th>Nombre </th>\n";
            echo "      <th>Apellido </th>\n";
            echo "      <th>Telefono </th>\n";
            echo "      <th>Correo </th>\n";
            echo "      <th>Editar</th>\n";
            echo "</tr>\n";
            $c=1;
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>$c</th>\n";
                echo "      <th>".$row[0]."</th>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "      <th>".$row[3]."</th>\n";
                echo "      <th>".$row[2]."</th>\n";
                echo "      <th><a href = \"inf_asp.php?id=".$row[4]."\">Ver</a></th>\n";
                echo "  </tr>";
                $c++;
            }
            echo "</table>\n"
    ?>
    
</body>
</html>