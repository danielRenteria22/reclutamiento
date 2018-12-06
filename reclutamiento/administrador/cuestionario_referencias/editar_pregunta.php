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
    <center><h1>Editar pregunta</h1></center>
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
        $query = "SELECT pregunta FROM cuestionario_referencias WHERE id_cuestionario_referencias = $id";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_array($result);
        $pregunta = $row[0];

        //Colocar el formulario
        echo "<label>Pregunts <input type=\"text\" name=\"pregunta1\" value = \"$pregunta\"></label><br>";   
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
            $pregunta = $_POST["pregunta1"];
            $id = $GLOBALS['id'];

            $query = "UPDATE  cuestionario_referencias
                      SET pregunta = '$pregunta'
                      WHERE id_cuestionario_referencias = $id";
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
    }
?>