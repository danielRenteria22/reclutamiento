<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vacante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="main.js"></script>
</head>
<body>
    <h1>Vacante</h1>
    <?php
        include '../../config.php';
        $id = $_GET["id"];
        $solicitud = $_GET["id_solicitud"];
        $con=mysqli_connect($host,$user,$pass,$name);
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "SELECT
                employid,
                empfullname,
                apellidos,
                edociv,
                sexo,
                nss,
                telefono,
                email,
                foto
                    FROM 
                    employees
                        WHERE 
                        $id = employid";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "<img src=".$row[8]." alt ='Foto de Perfil' width='250' height='350'>";
                echo "      <br><b><th>No</b> ".$row[0]."</th><br/>\n";
                echo "      <br><b><th>Nombre:</b> ".$row[1]."</th><br/>\n";
                echo "      <br><b><th>Apellido:</b> ".$row[2]."</th><br/>\n";
                echo "      <br><b><th>Sexo:</b> ".$row[4]."</th><br/>\n";
                echo "      <br><b><th>Estado Civil:</b> ".$row[3]."</th><br/>\n";
                echo "      <br><b><th>NSS:</b> ".$row[5]."</th><br/>\n";
                echo "      <br><b><th>Telefono:</b> ".$row[6]."</th><br/>\n";
                echo "      <br><b><th>Email:</b> ".$row[7]."</th><br/>\n";
                echo "</tr>\n";
            }
//funciones generales
        echo"<h3>Solicitudes</h3>";
            $con=mysqli_connect($host,$user,$pass,$name);
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT id,id_usuario,id_requisicion,fecha FROM solicitudes WHERE $id = id_usuario";
            $result = mysqli_query($con,$query);
            echo "<table border = 1>\n";
            echo "  <tr>\n";
            echo "      <th>No. </th>\n";
            echo "      <th>Aspirante </th>\n";
            echo "      <th>Requisicion </th>\n";
            echo "      <th>Fecha </th>\n";
            echo "</tr>\n";
            $c=1;
            
            while($row = mysqli_fetch_array($result)){
                $aspirante   = $row[1];
                $requisicion = $row[2];
                $fecha       = $row[3];
                $querys = "SELECT empfullname,apellidos FROM employees WHERE $aspirante = employid";
                $results = mysqli_query($con,$querys);
                while($row = mysqli_fetch_array($results)){
                    $nombre    = $row[0];
                    $apellidos = $row[1];
                }
                $queryss = "SELECT nombre FROM requisicion WHERE $requisicion = id";
                $resultss = mysqli_query($con,$queryss);
                while($row = mysqli_fetch_array($resultss)){
                    $req    = $row[0];
                }

                echo "  <tr>\n";
                echo "      <th>".$c."</th>\n";
                echo "      <th>".$nombre," ", $apellidos."</th>\n";
                echo "      <th>".$req."</th>\n";
                echo "      <th>".$fecha."</th>\n";
                echo "  </tr>";
                $c++;
            }

            $queryss = "SELECT entrevista, ponderacion, referencia FROM calificaciones WHERE $solicitud = id_solicitud";
            $resultss = mysqli_query($con,$queryss);
            while($row = mysqli_fetch_array($resultss)){
                $entrevista    = $row[0];
                $ponderacion    = $row[1];
                $referencia    = $row[2];
            }

            echo "</table>\n";
            echo "<br><br>";

            if($entrevista == 0)
            {
                echo "      <h2><th><a href = \"../evaluaciones/realizar_entrevista.php?id=$id&id_solicitud=$solicitud\">Entrevista Laboral</a></th>\n</h2>";
            }
            else
            {
                echo "      <h2><th><a>Entrevista Laboral: Realizada</a></th>\n</h2>";
                echo "      <h4><th><a href = \"../evaluaciones/ver_respuestas_entrevista.php?id=$id&id_solicitud=$solicitud\">Respuestas de Entrevista Laboral</a></th>\n</h4>";
            }
            if($ponderacion == 0)
            {
                echo "      <h2><th><a href = \"../evaluaciones/realizar_ponderacion.php?id=$id&id_solicitud=$solicitud\">Ponderaciones</a></th>\n</h2>";
            }
            else
            {
                echo "      <h2><th><a>Ponderacion: ".$ponderacion."</a></th>\n</h2>";
                echo "      <h4><th><a href = \"../evaluaciones/ver_respuestas_ponderacion.php?id=$id&id_solicitud=$solicitud\">Respuestas de Ponderaciones</a></th>\n</h4>";
            }
            if($referencia == 0)
            {
                echo "      <h2><th><a href = \"../evaluaciones/realizar_cuestionario_referencias.php?id=$id&id_solicitud=$solicitud\">Referencias Personales</a></th>\n</h2>";
            }
            else
            {
                echo "      <h2><th><a>Referencias Personales: ".$referencia."</a></th>\n</h2>";
                echo "      <h4><th><a href = \"../evaluaciones/ver_respuestas_referencias.php?id=$id&id_solicitud=$solicitud\">Respuestas de Referencias Personales</a></th>\n</h4>";
            }
    ?>
    
</body>
</html>