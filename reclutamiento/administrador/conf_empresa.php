<html>
    <body>
        <center><h1>Configurar Empresa</h1></center>
        <form enctype="multipart/form-data" action="" method="POST">
            <label>Nombre <input type="text" name="nombre"></label><br>
            <label>Direccion <input type="text" name="direccion"></label><br>
            <label>RFC<input type="text" name="rfc"></label><br>
            <input type = "submit" class = "inputEnviar" value = "Configurar" name = "confg">
        </form>
    </body>
</html>

<?php
    include '../config.php';
    if(isset($_POST['confg'])){ 
        $con=mysqli_connect($host,$user,$pass,$name);
			// Check connection
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			} else{
                $nombre = $_POST["nombre"];
                $dir = $_POST["direccion"];
                $rfc = $_POST["rfc"];
                $query = "UPDATE empresa 
                          SET nombre = '$nombre', direccion = '$dir', rfc = '$rfc'
                          WHERE id = 1";
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