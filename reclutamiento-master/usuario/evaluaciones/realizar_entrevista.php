<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Entrevista</title>
</head>
<body>
<h1>Entrevista</h1>
<h3>Conteste las preguntas</h3>
<form action="" method="post">

<?php
    include '../../config.php';
    //$id_entrevista = $_GET["id_entrevista"];
    $id_solicitud = $_GET["id_solicitud"];

    //******************
    $id_entrevista;
    $id_perfil;
    $id_requisicion;
    //******************
    $conn=mysqli_connect($host,$user,$pass,$name);
    $query = "SELECT id_requisicion FROM solicitudes WHERE $id_solicitud = id";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $id_requisicion = $row[0];
    }
    $querys = "SELECT id_perfil FROM requisicion WHERE $id_requisicion = id";
    $results = mysqli_query($conn, $querys);
    while($row = mysqli_fetch_array($results)){
        $id_perfil = $row[0];
    }
    $querys = "SELECT entrevista FROM perfil WHERE $id_perfil = id_perfil";
    $results = mysqli_query($conn, $querys);
    while($row = mysqli_fetch_array($results)){
        $id_entrevista = $row[0];
    }
    $preguntas_id = array();

    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    
    $query = "SELECT id_pregunta_entrevista,pregunta FROM pregunta_entrevista WHERE id_entrevista = $id_entrevista";
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

        $conn=mysqli_connect($host,$user,$pass,$name);
        $sql = "UPDATE calificaciones 
                SET entrevista = 1
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


        $query = "INSERT INTO respuesta_entrevista(id_pregunta_entrevista,respuesta,id_solicitud) VALUES ";
        for($i = 0; $i < $cont; $i++){
            $id_pregunta = $preguntas_id[$i];
            $respuesta  = $_POST["p$id_pregunta"];
            $query = $query . "($id_pregunta,'$respuesta',$id_solicitud),";
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
        $id = $_GET["id"];
        $id_solicitud = $_GET["id_solicitud"];
        header("Location: ver_respuestas_entrevista.php?id=$id&id_solicitud=$id_solicitud");
    }
?>
