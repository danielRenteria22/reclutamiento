<?php
    $id = $_GET['id'];
    $con=mysqli_connect("localhost","root","","reclutamiento");
    if (mysqli_connect_errno())
    {
        echo "No se ha podido conectar a la base de datos: " . mysqli_connect_error();
    } else{
        $query = "DELETE FROM cuestionario_cancelacion_solicitud WHERE id_pregunta = $id";
        mysqli_query($con,$query);


        if(mysqli_affected_rows($con) > 0){
            //echo "<p>Se hizo el rergistro</p>";
            //echo $calificacion;
            header("Location: ver_preguntas.php");
            exit;
                    
        } else {
            echo "No se hizo el regidtro en la BD<br />";
            echo mysqli_error ($con);
        }
    }
?>