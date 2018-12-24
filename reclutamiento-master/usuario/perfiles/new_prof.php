<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <center><h1>Crear Perfil</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Nombre         <input type="text" name="nombre"></label><br>
    <label>Vacante        <input type="text" name="vacante"></label><br>
    <label>Descripcion    <input type="text" name="descripcion"></label><br>
    <label>Fecha de Inicio<input type="text" name="inicio"></label><br>
    <label>Sueldo Nominal <input type="text" name="sueldo"></label><br>
    <label>Tope de Bonos  <input type="text" name="bonos"></label><br>
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
			    echo "Empleador: <select id = \"empleado\" name=\"empleado\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["empid"].">".$row["nombre"]."</option>\n";
				}
                echo "</select><br>\n";
//contratos
                $query = "SELECT contratoid,tipo FROM contratos ORDER BY tipo";
			    $result = mysqli_query($con,$query);
			    echo "Contrato: <select id = \"contrato\" name=\"contrato\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["contratoid"].">".$row["tipo"]."</option>\n";
				}
                echo "</select><br>\n";
//ponderaciones
                $query = "SELECT id,nombre FROM ponderaciones ORDER BY nombre";
			    $result = mysqli_query($con,$query);
			    echo "Ponderaciones: <select id = \"ponderacion\" name=\"ponderacion\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["id"].">".$row["nombre"]."</option>\n";
				}
				echo "</select><br>\n";
//ciudad
				$query = "SELECT officename,officeid FROM offices ORDER BY officename";
			    $result = mysqli_query($con,$query);
			    echo "Ciudad: <select id = \"ciudad\" name=\"ciudad\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["officeid"].">".$row["officename"]."</option>\n";
				}
				echo "</select><br>\n";
//cliente
				$query2 = "SELECT groupid,groupname FROM groups ORDER BY groupname";
			    $result2 = mysqli_query($con,$query2);
			    echo "Cliente: <select id = \"cliente\" name=\"cliente\">\n";
				while($row = mysqli_fetch_array($result2)){
					    echo "<option value=".$row["groupid"].">".$row["groupname"]."</option>\n";
				}
				echo "</select><br>\n";
//obra
				$query3 = "SELECT Workname,IDWork FROM works ORDER BY Workname";
			    $result3 = mysqli_query($con,$query3);
			    echo "Obra: <select id = \"obra\" name=\"obra\">\n";
				while($row = mysqli_fetch_array($result3)){
					    echo "<option value=".$row["IDWork"].">".$row["Workname"]."</option>\n";
				}
                echo "</select><br>";
				
				
				mysqli_close($con); 
		    ?>
			<input type = "submit" name = "crear" value = "Crear perfil">
    </form>
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
		$bonos       = $_POST["bonos"];
		$contrato    = $_POST["contrato"];
		$ponderacion = $_POST["ponderacion"];

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
				 					'".$bonos."',
				 					'".$descripcion."',
				 					'".$nombre."',
				 					'".$vacante."',
				 					''
				 				);");
		$conn->close();
	}
?>