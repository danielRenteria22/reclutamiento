<?php
	if(isset($_POST['agregar'])){ 
        $con=mysqli_connect("localhost","root","","reclutamiento");
			// Check connection
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			} else{
                $nombre = $_POST["nombre"];
                $query = "INSERT INTO permisos(nombre) VALUES('$nombre')";
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
   }else{
        //code to be executed  
   }
?>

<html>
    <body>
        <center> Agregar permisos </center>
        <form enctype="multipart/form-data" action="" method="POST">
            <label> Nombre <input type="text" name="nombre"></label><br>
            <input type = "submit" class = "inputEnviar" value = "Agregar" name = "agregar">
        </form>
    </body>
</html>