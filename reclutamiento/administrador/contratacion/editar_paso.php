<html>
</<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Paso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <center><h1>Editar paso</h1></center>
    <form enctype="multipart/form-data" action="" method="POST">
    <?php
        $id = $_GET['id'];
        $GLOBALS['id'] = $id;
        $con=mysqli_connect("localhost","root","","reclutamiento");
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        //Buscar la informacion de un paso
        $query = "SELECT * FROM pasos_reclutamiento WHERE id = $id";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_array($result);
        $desc = $row[1];
        $permiso = $row[2];

        //Colocar el formulario
        echo "<label>Descripcion del paso <input type=\"text\" name=\"desc1\" value = \"$desc\"></label>";
        $query = "SELECT * FROM permisos ORDER BY nombre";
	    $result = mysqli_query($con,$query);
		echo "Nivel autorizacion: <select id = \"permiso\" name=\"idPermiso1\">\n";
		while($row = mysqli_fetch_array($result)){
            if($row["id"] != $permiso){
                echo "<option value=".$row["id"].">".$row["nombre"]."</option>\n";
            } else{
                echo "<option selected = \"selected\" value=".$row["id"].">".$row["nombre"]."</option>\n";
            }
		    
		}
        echo "</select><br>\n";	   
        mysqli_close($con);     
    ?>
    <input type = "submit" class = "inputEditar" value = "Editar" name = "editar">
    </form>
</body>
</html>

<?php
    if(isset($_POST['editar'])){
        $con=mysqli_connect("localhost","root","","reclutamiento");
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		} else{
            $desc = $_POST["desc1"];
            $permiso = $_POST["idPermiso1"];
            $id = $GLOBALS['id'];

            $query = "UPDATE  pasos_reclutamiento
                      SET nivel_auto = $permiso, nombre = '$desc'
                      WHERE id = $id";
            mysqli_query($con,$query);


            if(mysqli_affected_rows($con) > 0){
                //echo "<p>Se hizo el rergistro</p>";
                //echo $calificacion;
                header("Location: ver_pasos.php");
                exit;
                    
            } else {
                echo "No se hizo el regidtro en la BD<br />";
                echo mysqli_error ($con);
            }
        }
    }
?>