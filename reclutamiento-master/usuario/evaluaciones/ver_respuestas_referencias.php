<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Referencias</title>
</head>
<body>
<h1>Referencias</h1>
<h3>Respuestas</h3>
<form action="" method="post">

<?php
    include '../../config.php';
    $id_solicitud = $_GET["id_solicitud"];
    $conn=mysqli_connect($host,$user,$pass,$name);
    $query = "SELECT id FROM referencias_personal WHERE $id_solicitud = id_solicitud";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $id_referencia = $row[0];
    }
    $preguntas_id = array();

    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    
    $query = "SELECT 
                a.pregunta,
                b.respuesta 
            FROM 
                cuestionario_referencias a 
            INNER JOIN 
                respuestas_cuestionario_referencias b 
            ON 
                a.id_cuestionario_referencias = b.id_cuestionario_referencias
            WHERE 
                b.id_referencia = $id_referencia;";
    $result = mysqli_query($conn, $query);
    $cont = 0;
    while($row = mysqli_fetch_array($result)){
        $pregunta = $row[0];
        $respuesta = $row[1];
        echo "<p><label>$pregunta</label><br><textarea cols='30' rows='10'  disabled>$respuesta</textarea></p>\n";
    }
    mysqli_close($conn);
?>
</form>
    
</body>
</html>
