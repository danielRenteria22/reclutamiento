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
    <title>Ponderación</title>
</head>
<body>
<h1>Respuestas</h1>
<table border = 1>
    <tr>
        <th>Consideración</th>
        <th>Peso</th>
        <th>Calificacion</th>
        </tr>
<?php
    $id_solicitud = $_GET["id_solicitud"];
    //Obtenemos las preguntas y las respuestas de la ponderacion de la solicitud
    $query = "SELECT a.calificacion,b.nombre_campo,b.peso FROM respuestas_ponderaciones a 
              INNER JOIN detalle_ponderacion b ON a.id_detalle_ponderacion = b.id
              WHERE A.id_solicitud = $id_solicitud;";
    //Conexion con la base de datos
    include '../../config.php';
    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $califiacion = $row[0];
        $consideracion = $row[1];
        $peso = $row[2];
        echo "<tr>
                <td>$consideracion</td>
                <td>$peso</td>
                <td>$califiacion</td>
              </tr>";
    }
    $query = "SELECT promedio_ponderaciones($id_solicitud)";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $promedio = $row[0];

   
    mysqli_close($conn);
?>
</table>    
<?php  
    include '../../config.php';
    $id_solicitud = $_GET['id_solicitud'];
    echo "<p>Promedio: $promedio</p>"; 
    $sql = "UPDATE calificaciones 
                SET ponderacion = $promedio 
                WHERE id_solicitud = $id_solicitud";
        $conn = new mysqli($host,$user,$pass,$name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($conn->query($sql) === TRUE) {
            echo "Se efectuaron los cambios con exito";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
?>
</body>
</html>
