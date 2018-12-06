<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entrevista</title>
</head>
<body>
<h1>Entrevista</h1>
<h3>Respuestas</h3>
<form action="" method="post">

<?php
    $id_entrevista = $_GET["id_entrevista"];
    $id_solicitud = $_GET["id_solicitud"];
    $preguntas_id = array();

    $conn = mysqli_connect("localhost","root","","reclutamiento");
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    
    $query = "SELECT a.pregunta,b.respuesta FROM pregunta_entrevista a 
              INNER JOIN respuesta_entrevista b ON a.id_pregunta_entrevista = b.id_pregunta_entrevista
              WHERE a.id_entrevista = $id_entrevista AND b.id_solicitud = $id_solicitud;";
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