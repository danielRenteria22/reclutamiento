<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <center><h1>Crear Perfil</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Nombre         <input type="text" name="nombre"></label><br>
    <label>Vacante        <input type="text" name="vacante"></label><br>
    <label>Descripcion    <input type="text" name="descripcion"></label><br>
    <label>Fecha de Inicio<input type="text" name="inicio"></label><br>
    <label>Sueldo Nominal <input type="text" name="sueldo"></label><br>
    <?php
    			include '../../config.php';
			    $con=mysqli_connect($host,$user,$pass,$name);
			    if (mysqli_connect_errno())
			    {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					//exit;
                }
//empleador
                $query = "SELECT empid,nombre FROM empleador ORDER BY nombre";
			    $result = mysqli_query($con,$query);
			    echo"<br><br>";
			    echo "Empleador: <select id = \"empleado\" name=\"empleado\">\n";
			    echo"<br><br>";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["empid"].">".$row["nombre"]."</option>\n";
				}
                echo "</select><br>\n";
//contratos
                $query = "SELECT contratoid,tipo FROM contratos ORDER BY tipo";
			    $result = mysqli_query($con,$query);
			    echo"<br><br>";
			    echo "Contrato: <select id = \"contrato\" name=\"contrato\">\n";
			    echo"<br><br>";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["contratoid"].">".$row["tipo"]."</option>\n";
				}
                echo "</select><br>\n";
//ponderaciones
                $query = "SELECT id,nombre FROM ponderaciones ORDER BY nombre";
			    $result = mysqli_query($con,$query);
			    echo"<br><br>";
			    echo "Ponderaciones: <select id = \"ponderacion\" name=\"ponderacion\">\n";
			    echo"<br><br>";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["id"].">".$row["nombre"]."</option>\n";
				}
				echo "</select><br>\n";
//ciudad
				$query = "SELECT officename,officeid FROM offices ORDER BY officename";
			    $result = mysqli_query($con,$query);
			    echo"<br><br>";
			    echo "Ciudad: <select id = \"ciudad\" name=\"ciudad\">\n";
			    echo"<br><br>";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["officeid"].">".$row["officename"]."</option>\n";
				}
				echo "</select><br>\n";
//cliente
				$query2 = "SELECT groupid,groupname FROM groups ORDER BY groupname";
			    $result2 = mysqli_query($con,$query2);
			    echo"<br><br>";
			    echo "Cliente: <select id = \"cliente\" name=\"cliente\">\n";
			    echo"<br><br>";
				while($row = mysqli_fetch_array($result2)){
					    echo "<option value=".$row["groupid"].">".$row["groupname"]."</option>\n";
				}
				echo "</select><br>\n";
//obra
				$query3 = "SELECT Workname,IDWork FROM works ORDER BY Workname";
			    $result3 = mysqli_query($con,$query3);
			    echo"<br><br>";
			    echo "Obra: <select id = \"obra\" name=\"obra\">\n";
			    echo"<br><br>";
				while($row = mysqli_fetch_array($result3)){
					    echo "<option value=".$row["IDWork"].">".$row["Workname"]."</option>\n";
				}
                echo "</select><br>";
				

				//Select para entrevista*****************************************************************
				echo "<label>";
                $query = "SELECT id_entrevista,nombre FROM entrevista ORDER BY nombre";
			    $result = mysqli_query($con,$query);
			    echo"<br></br>";
			    echo "Entrevista: <select id = \"ent\" name=\"ent\">\n";
			    echo"<br></br>";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["id_entrevista"].">".$row["nombre"]."</option>\n";
				}
				echo "</select><br>\n";
				echo "</label>";

				mysqli_close($con); 
		    ?>
			<input type = "submit" name = "crear" value = "Crear perfil">
    </form>
    <b><b>
        <button onclick="location.href='perfil.php'">Atras</button>
</body>
</html>

<?php
	include '../../config.php';
	if(isset($_POST['crear'])){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "reclutamiento";
		$conn=mysqli_connect($host,$user,$pass,$name);

		$nombre      = $_POST["nombre"];
		$inicio      = $_POST["inicio"];
		$empleado    = $_POST["empleado"];
		$ciudad      = $_POST["ciudad"];
		$cliente     = $_POST["cliente"];
		$obra        = $_POST["obra"];
		$vacante     = $_POST["vacante"];
		$descripcion = $_POST["descripcion"];
		$sueldo      = $_POST["sueldo"];
		$contrato    = $_POST["contrato"];
		$ponderacion = $_POST["ponderacion"];
		$entrevista = $_POST["ent"];

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO perfil 
				 		VALUES 	(
				 					'',
				 					'".$cliente."',
				 					'".$obra."',
				 					'".$ponderacion."',
				 					'".$ciudad."',
				 					'".$empleado."',
				 					'".$contrato."',
				 					'".$inicio."',
				 					'',
				 					'".$sueldo."',
				 					'',
				 					'".$descripcion."',
				 					'".$nombre."',
				 					'".$vacante."',
				 					'',
				 					'".$entrevista."'
				 				);");
		$conn->close();
		header("Location: perfil.php");
	}
?>
