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
    <?php 
        $id1 = $_GET["id"];
        $id2 = $_GET["idp"];
        $id3 = $_GET["idr"];
        $query = "SELECT id FROM solicitudes WHERE $id2 = id_usuario and $id3 = id_requisicion";
        if(!isset($query))
        {
            echo"<br>";
            echo"Usted ya ha aplicado para esta vacante";
            exit();
        } 
    ?>
    <h1>Perfil</h1>
    <?php
        include '../../config.php';
        $id = $_GET["id"];
        $con=mysqli_connect($host,$user,$pass,$name);
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT
                nombre,
                vacante, 
                descripcion_del_puesto,
                sueldo,
                tope_de_bonos,
                id_ciudad,
                id_cliente,
                id_empleador,
                id_obra,
                id_ponderacion,
                id_contrato,
                id_perfil
                    FROM 
                    perfil 
                        WHERE 
                        $id = id_perfil";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <br><b><th>Nombre:</b> ".$row[0]."</th><br/>\n";
                echo "      <br><b><th>Vacante:</b> ".$row[1]."</th><br/>\n";
                echo "      <br><b><th>Descripcion:</b> ".$row[2]."</th><br/>\n";
                echo "      <br><b><th>Sueldo:</b> ".$row[3]."</th><br/>\n";
                echo "</tr>\n";
                $ciudad     = $row[5];
                $cliente    = $row[6];
                $empleador  = $row[7];
                $obra       = $row[8];
                $ponderacion= $row[9];
                $contrato   = $row[10];
                $perf       = $row[11];
            }
            $query = "SELECT
                officename
                    FROM 
                    offices 
                        WHERE 
                        $ciudad = officeid";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result))
            {
                echo "  <tr>\n";
                echo "      <br><b><th>Ciudad:</b> ".$row[0]."</th><br/>\n";
                echo "</tr>\n";
            }
            $query = "SELECT
                groupname
                    FROM 
                    groups 
                        WHERE 
                        $cliente = groupid";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result))
            {
                echo "  <tr>\n";
                echo "      <br><b><th>Cliente:</b> ".$row[0]."</th><br/>\n";
                echo "</tr>\n";
            }
            $query = "SELECT
                nombre
                    FROM 
                    empleador 
                        WHERE 
                        $empleador = empid";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result))
            {
                echo "  <tr>\n";
                echo "      <br><b><th>Empleador:</b> ".$row[0]."</th><br/>\n";
                echo "</tr>\n";
            }
            $query = "SELECT
                Workname
                    FROM 
                    works 
                        WHERE 
                        $obra = IDWork";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result))
            {
                echo "  <tr>\n";
                echo "      <br><b><th>Obra:</b> ".$row[0]."</th><br/>\n";
                echo "</tr>\n";
            }
            $query = "SELECT
                tipo
                    FROM 
                    contratos 
                        WHERE 
                        $contrato = contratoid";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result))
            {
                echo "  <tr>\n";
                echo "      <br><b><th>Contrato:</b> ".$row[0]."</th><br/>\n";
                echo "</tr>\n";
            }
//funciones generales
        echo"<h3>Funciones Generales</h3>";
            $con=mysqli_connect($host,$user,$pass,$name);
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT id,funcion FROM funciones_gles WHERE $id = id_perfil";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No. </th>\n";
            echo "      <th>Descripcion </th>\n";
            echo "</tr>\n";
            $perfg = $row[0];
            $c=1;
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>".$c."</th>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "  </tr>";
                $c++;
            }
            echo "</table>\n";
//funciones particulares
        echo"<h3>Funciones Particulares</h3>";
            $con=mysqli_connect($host,$user,$pass,$name);
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT id,funcion FROM funciones_especiales WHERE $id = id_perfil";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No. </th>\n";
            echo "      <th>Descripcion </th>\n";
            echo "</tr>\n";
            $perfp = $row[0];
            $c=1;
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <th>".$c."</th>\n";
                echo "      <th>".$row[1]."</th>\n";
                echo "  </tr>";
                $c++;
            }
            echo "</table>\n";
            echo "      <br><b><th><a href = \"quest.php?idp=$id\">Enviar solicitud</a></th></b><br/>\n";
    ?>
    
</body>
</html>