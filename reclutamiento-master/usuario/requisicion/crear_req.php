<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Requisición</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <center><h1>Crear Requisición</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Nombre <input type="text" name="nombre"></label><br>
    <?php
                //INICIO conexion con la base de datos
			    include '../../config.php';
    			$con=mysqli_connect($host,$user,$pass,$name);
			    if (mysqli_connect_errno())
			    {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					exit;
                }
                //FIN conexion con la base de datos

                //Select para empleador****************************************************************
                $query = "SELECT empid,empleado FROM empleador ORDER BY nombre";
			    $result = mysqli_query($con,$query);
			    echo "Empleador: <select id = \"empleador\" name=\"empleador\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["empid"].">".$row["empleado"]."</option>\n";
				}
				echo "</select><br>\n";
				
				//Select para encargado***************************************************************
                $query = "SELECT a.id_usuario,a.nombre,a.apellidos,b.nombre FROM usuario a 
						  INNER JOIN permisos b ON a.permisos = b.id;";
			    $result = mysqli_query($con,$query);
			    echo "Encargado: <select id = \"encargado\" name=\"encargado\">\n";
				while($row = mysqli_fetch_array($result)){
					$id = $row[0];
					$nombre_completo = $row[1] . " " . $row[2];
					$permiso = $row[3];
					echo "<option value=$id>$nombre_completo | $permiso</option>\n";
				}
                echo "</select><br>\n";
                
				//Select para reculador***************************************************************
				$query = "SELECT a.id_usuario,a.nombre,a.apellidos,b.nombre FROM usuario a 
				INNER JOIN permisos b ON a.permisos = b.id;";
	  			$result = mysqli_query($con,$query);
	  			echo "Encargado: <select id = \"encargado\" name=\"reclutador\">\n";
	  			while($row = mysqli_fetch_array($result)){
		  			$id = $row[0];
		  			$nombre_completo = $row[1] . " " . $row[2];
		  			$permiso = $row[3];
		  			echo "<option value=$id>$nombre_completo | $permiso</option>\n";
	  			}
	  			echo "</select><br>\n";

                //Select para perfil*****************************************************************
                $query = "SELECT id_perfil,nombre FROM perfil ORDER BY nombre";
			    $result = mysqli_query($con,$query);
			    echo "Perfil: <select id = \"perfil\" name=\"perfil\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["id_perfil"].">".$row["nombre"]."</option>\n";
				}
                echo "</select><br>\n";

                //Select para obra******************************************************************
                $query = "SELECT Workname,IDWork FROM works ORDER BY Workname";
			    $result = mysqli_query($con,$query);
			    echo "Obra: <select id = \"obra\" name=\"obra\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["IDWork"].">".$row["Workname"]."</option>\n";
				}
                echo "</select><br>";

                //Select para Ciudad****************************************************************
                $query = "SELECT officename,officeid FROM offices ORDER BY officename";
			    $result = mysqli_query($con,$query);
			    echo "Ciudad: <select id = \"ciudad\" name=\"ciudad\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["officeid"].">".$row["officename"]."</option>\n";
				}
				echo "</select><br>\n";
				mysqli_close($con); 
				
				/*
					Office = ciudad
					Group = Cliente
					Work = obra
				*/
		    ?>
            
            <input type="checkbox" name="mInterno" value="i"> Mercado interno<br>
            <input type="checkbox" name="mExterno" value="e"> Mercado externo<br>
			<input type = "submit" name = "crear" value = "Crear requisision">
            
    </form>
    
</body>
</html>

<?php
	if(isset($_POST['crear'])){
		$nombre = $_POST["nombre"];
		$empleadorID = $_POST["empleador"];
		$encargadoID = $_POST["encargado"];
		$reclutadorID = $_POST["reclutador"];
		$perfilID = $_POST["perfil"];
		$obraID = $_POST["obra"];
		$ciudadID = $_POST["ciudad"];

		$mInterno = 0;
		$mExterno = 0;

		if(isset($_POST['mInterno'])){
			$mInterno = 1;
		}

		if(isset($_POST['mExterno'])){
			$mExterno = 1;
		}

		//echo "Mercado interno: " . $mInterno . "<br>";
		//echo "Mercado Externo: " . $mExterno . "<br>";

		date_default_timezone_set("America/Chihuahua");
		$fecha = date("Y/m/d");

		$sql = "INSERT INTO requisicion(id_encargado,id_reclutador,id_perfil,nombre,mercado_interno	,mercado_externo,fecha_creacion) 
				 VALUES ($encargadoID,$reclutadorID,$perfilID,'$nombre',$mInterno,$mInterno,'$fecha');";
		//echo $sql . "<br>";

		
		//Insertar la requisison en la base de datos
		include '../../config.php';
		$conn = new mysqli($host,$user,$pass,$name);
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		} 
		//Se obtiene el ID  de la ultima requision para agregar los pasos nulos en estado_req
		if ($conn->query($sql) === TRUE) {
    		$id_req = $conn->insert_id;
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		

		//Insertar todos los pasos como no autorizados en estado_req
		$sql_ins = "INSERT INTO estado_req(idRequisision,idPaso) VALUES ";

		$query = "SELECT id FROM pasos_requisicion ORDER BY id ASC";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_array($result)){
			$sql_ins = $sql_ins . "($id_req," . $row['id'] . "),";
		}
		//remover la ultima coma
		$length = strlen($sql_ins);
		$sql_ins = substr($sql_ins,0,$length-1);
		$sql_ins = $sql_ins . ";";
		//echo $sql_ins;

		if ($conn->query($sql_ins) === TRUE) {
    		echo "Se han insertado los pasos de manera exitosa";
		} else {
    		echo "Error: " . $sql_ins . "<br>" . $conn->error;
		}
		
		$conn->close();
		header("Location: ver_req.php");
	}
?>
