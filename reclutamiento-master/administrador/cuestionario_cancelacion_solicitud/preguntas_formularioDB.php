<?php 
    include "../../verificacion.php";
    verificar();
?>

<?php
        include '../../config.php';
        $num;
        $num = $_POST["num"];
        //Verificar si todos las preguntas tienen texto
    
        $todoLleno = true;
        for($id = 1; $id <= $num; $id++){
            $preguntaTemp = $_POST["p" . $id];
            echo $id . ": " . $preguntaTemp . "\n";
            if($preguntaTemp == ""){
                $todoLleno = false;
                break;
            }
        }

        if($todoLleno){
            $con=mysqli_connect($host,$user,$pass,$name);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "No se ha podido conectar a la base de datos: " . mysqli_connect_error();
            } else{
                $query = "INSERT INTO  cuestionario_cancelacion_solicitud(pregunta) VALUES \n";
                for($id = 1; $id <= $num; $id++){
                    $preguntaTemp = $_POST["p" . $id];
                    
                    $currentValue = "('$preguntaTemp')";
                    if($id != $num) $currentValue = $currentValue . ",";
                    $currentValue = $currentValue . "\n";
                    
                    $query = $query . $currentValue;
                }
                $query = $query . ";";
                echo $query . "\n";

                mysqli_query($con,$query);


                if(mysqli_affected_rows($con) > 0){
                    echo "<p>Se hizo el rergistro</p>";
                    //echo $calificacion;
                    //header("Location: calificacionesMaestro.php?idMaestro=$idMaestro&maestro=".$nombreLink);
                    exit;
                    
                } else {
                    echo "No se hizo el regidtro en la BD<br />";
                    echo mysqli_error ($con);
                }
      
            }

        } else{
            echo "No se lleno todas las desccripciones";
            echo "<script> alert(\"No se han llenado todas las descripciones\"); </script> ";
            echo "<script> window.history.back(); </script>";
        }
    
?>
