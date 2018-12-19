<?php
    include '../../config.php';
    $id = $_GET['id'];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno())
    {
        echo "No se ha podido conectar a la base de datos: " . mysqli_connect_error();
    } else{
        $query = "DELETE FROM cuestionario_referencias WHERE id_cuestionario_referencias = $id";
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