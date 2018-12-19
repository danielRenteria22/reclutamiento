<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Referencias</title>
</head>
<body>
<h1>Cuestionario de referencias</h1>
<h3>Conteste las preguntas</h3>
<form action="" method="post">

<?php
    include '../../config.php';
    $id_referencia = $_GET["id_referencia"];
    $preguntas_id = array();

    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    
    $query = "SELECT id_cuestionario_referencias,pregunta FROM cuestionario_referencias";
    $result = mysqli_query($conn, $query);
    $cont = 0;
    while($row = mysqli_fetch_array($result)){
        $id_pregunta = $row[0];
        $pregunta = $row[1];
        $preguntas_id[$cont] = $id_pregunta;
        $cont++;
        echo "<p><label>$pregunta</label><br><textarea name='p$id_pregunta' id='' cols='30' rows='10'></textarea></p>\n";
    }
    mysqli_close($conn);
?>
    <input type="submit" value="Guardar" name = "guardar_respuestas">
</form>
    
</body>
</html>


<?php
    include '../../config.php';
    if( isset($_POST["guardar_respuestas"]) ){
        $query = "INSERT INTO respuestas_cuestionario_referencias(id_referencia,respuesta,id_cuestionario_referencias) VALUES ";
        for($i = 0; $i < $cont; $i++){
            $id_pregunta = $preguntas_id[$i];
            $respuesta  = $_POST["p$id_pregunta"];
            $query = $query . "($id_referencia,'$respuesta',$id_pregunta),";
        }
        //remover la ultima coma
	    $length = strlen($query);
	    $query = substr($query,0,$length-1);
	    $query = $query . ";";
        echo $query;

        $conn=mysqli_connect($host,$user,$pass,$name);
        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }
    
        if (mysqli_query($conn, $query)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        header("Location: ver_respuestas_referencias.php?id_referencia=$id_referencia");
    }
?>