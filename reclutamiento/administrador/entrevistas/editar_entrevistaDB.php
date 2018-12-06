<?php
    $numNuevos = $_POST["nuevos"];
    $numCons = $_POST["num"];
    $id_entrevista = $_POST["id"];
    $idPreguntasArray = array();
    

    //Actualizar los detalles que ya habia
    $i = 0;
    $con=mysqli_connect("localhost","root","","reclutamiento");
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
	}
    //Obtenemos los id de detalles
    $query = "SELECT id_pregunta_entrevista FROM pregunta_entrevista WHERE id_entrevista =$id_entrevista;";
    $result= mysqli_query($con,$query);
    while($rowPreguntas = mysqli_fetch_array($result)){
        $idPreguntasArray[$i] = $rowPreguntas[0];
        $i++;
    }

    //Actualizamos las preguntaes existentes
    for($c = 1; $c <= count($idPreguntasArray); $c++){
        $pregunta = $_POST["p$c"];
        $id_pregunta = $idPreguntasArray[$c - 1];
        $query = "UPDATE pregunta_entrevista 
                  SET pregunta = '$pregunta'
                  WHERE id_pregunta_entrevista = $id_pregunta";
        mysqli_query($con,$query);
    }

    //Insertamos las nuevas preguntaes
    //Creamos el query para insertar
    $query = "INSERT INTO pregunta_entrevista (id_entrevista,pregunta) VALUES";
    for($x = 1; $x <= $numNuevos; $x++){
        $nIndex = $numCons + $x;
        $nueva_pregunta = $_POST["np$nIndex"];
        $query = $query . "($id_entrevista,'$nueva_pregunta'),";
    }
    //remover la ultima coma
	$length = strlen($query);
	$query = substr($query,0,$length-1);
	$query = $query . ";";
    //echo $query;
    mysqli_query($con,$query);

    mysqli_close($con); 

    $url = "ver_entrevistas.php";
    header( "Location: $url" );

?>