<?php 
    include "../../verificacion.php";
    verificar();
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cotratos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>Contratos</h1>
    <label ><a href="new_cont.php">Agregar Contrato</a></label>
    <?php
        include '../../config.php';
        $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT contratoid,tipo,empleadorid FROM contratos";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No.</th>\n";
            echo "      <th>Contrato </th>\n";
            echo "      <th>Empleador </th>\n";
            echo "      <th>Eliminar </th>\n";
            echo "</tr>\n";
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>".$row[0]."</th>\n";
                echo "      <th>".$row[1]."</th>\n";
                $emp = $row[2];
                $id = $row[0];

                $querys = "SELECT nombre FROM empleador WHERE $emp = empid";
                $results = mysqli_query($con,$querys);
                while($row = mysqli_fetch_array($results))
                {
                    $emps = $row[0];
                }

                echo "      <th>".$emps."</th>\n";
                echo "      <th><a href = \"del_cont.php?id=".$id."\">Eliminar</a></th>\n";
                echo "  </tr>";
            }
            echo "</table>\n"
    ?>
    <b><b>
        <button onclick="location.href='../menu/index.html'">Atras</button>
    
</body>
</html>