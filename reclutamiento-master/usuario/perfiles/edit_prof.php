<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../style.css">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script> -->
</head>
<body>
    <h1>Perfil</h1>
    <form enctype="multipart/form-data" action="" method="POST">
    <?php
        include '../../config.php';
         $id = $_GET['id'];
         $GLOBALS['id'] = $id;
         $con=mysqli_connect($host,$user,$pass,$name);
         // Check connection
         if (mysqli_connect_errno())
         {
             echo "Failed to connect to MySQL: " . mysqli_connect_error();
         }
        
         //Buscar la informacion de una requisicion
        //nombre, vacante, descripcion, fecha, sueldo, bonos
        //empleador, contrato, ponderaciones, ciudad, cliente, obra
         $query = "SELECT nombre,
                          vacante,
                          descripcion_del_puesto,
                          fecha_inicio,
                          sueldo,
                          tope_de_bonos,
                          id_empleador,
                          id_contrato,
                          id_ponderacion,
                          id_ciudad,
                          id_cliente,
                          id_obra
                           FROM perfil WHERE $id = id_perfil";
         $result = mysqli_query($con,$query);
         $row = mysqli_fetch_array($result);
         $nombre        = $row[0];
         $vacante       = $row[1];
         $descripcion   = $row[2];
         $fecha         = $row[3];
         $sueldo        = $row[4];
         $bonos         = $row[5];
         $empleador     = $row[6];
         $contrato      = $row[7];
         $ponderaciones = $row[8];
         $ciudad        = $row[9];
         $cliente       = $row[10];
         $obra          = $row[11];

         echo "<label>Nombre: <input id      = \"nombre\"      type=\"text\" name=\"nombre\"      value = \"$nombre\" > </label><br>";
         echo "<label>vacante: <input id     = \"vacante\"     type=\"text\" name=\"vacante\"     value = \"$vacante\" > </label><br>";
         echo "<label>descripcion: <input id = \"descripcion\" type=\"text\" name=\"descripcion\" value = \"$descripcion\" > </label><br>";
         echo "<label>fecha: <input id       = \"fecha\"       type=\"text\" name=\"fecha\"       value = \"$fecha\" > </label><br>";
         echo "<label>sueldo: <input id      = \"sueldo\"      type=\"text\" name=\"sueldo\"      value = \"$sueldo\" > </label><br>";
         echo "<label>bonos: <input id       = \"bonos\"       type=\"text\" name=\"bonos\"       value = \"$bonos\" > </label><br>";

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
    ?>
    <input id = "guardar" type = "submit" name = "guardar" value = "Guardar cambios"  >
    </from>
</body>
</html>

<?php
    include '../../config.php';
	if(isset($_POST['guardar'])){

        $id = $GLOBALS['id'];
        $nombre        = $_POST["nombre"];
        $vacante       = $_POST["vacante"];
        $descripcion   = $_POST["descripcion"];
        $fecha         = $_POST["fecha"];
        $sueldo        = $_POST["sueldo"];
        $bonos         = $_POST["bonos"];
        $empleador     = $_POST["empleado"];
        $contrato      = $_POST["contrato"];
        $ponderaciones = $_POST["ponderacion"];
        $ciudad        = $_POST["ciudad"];
        $cliente       = $_POST["cliente"];
        $obra          = $_POST["obra"];

        $sql = "UPDATE perfil 
                SET
                    id_perfil = $id, 
                    id_cliente             = $cliente,
                    id_obra                = $obra,
                    id_ponderacion         = $ponderaciones,
                    id_ciudad              = $ciudad,
                    id_empleador           = $empleador,
                    id_contrato            = $contrato,
                    fecha_inicio           = $fecha,
                    tipo_de_contrato       = '0',
                    sueldo                 = $sueldo,
                    tope_de_bonos          = $bonos,
                    descripcion_del_puesto = $descripcion,
                    nombre                 = $nombre,
                    vacante                = $vacante,
                    id_bonos               = '0'      
                    
                        WHERE $id = id_perfil";

		//echo $sql . "<br>";
		$conn=mysqli_connect($host,$user,$pass,$name);
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		} 
		//Se obtiene el ID  de la ultima requision para agregar los pasos nulos en estado_req
		if ($conn->query($sql) === TRUE) {
    		echo "Se efectuaron los cambios con exito";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
?>
