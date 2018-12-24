<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Requisicion en proceso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script> -->
</head>
<body>
    <h1>Requisicion</h1>
    <form enctype="multipart/form-data" action="" method="POST">
    <?php
         $id_req = $_GET['id'];
         $GLOBALS['id'] = $id;
         include '../../config.php';
         $con=mysqli_connect($host,$user,$pass,$name);
         // Check connection 
         if (mysqli_connect_errno())
         {
             echo "Failed to connect to MySQL: " . mysqli_connect_error();
         }
        
         //Buscar la informacion de una requisicion
         $query = "SELECT * FROM requisicion WHERE id = $id_req";
         $result = mysqli_query($con,$query);
         $row = mysqli_fetch_array($result);
         $idEncargado = $row[1];
         $idReclutador = $row[2];
         $idPerfil = $row[3];
         $nombre = $row[4];
         $mi = $row[5];
         $me = $row[6];
         echo "<label>Nombre: <input id = \"nombre\" type=\"text\" name=\"nombre\" value = \"$nombre\" disabled> </label><br>";
         //Select para encargado***************************************************************
         $query = "SELECT a.id_usuario,a.nombre,a.apellidos,b.nombre FROM usuario a 
                   INNER JOIN permisos b ON a.permisos = b.id;";
         $result = mysqli_query($con,$query);
         echo "Encargado: <select id = \"encargado\" name=\"encargado\" disabled>\n";
         while($row = mysqli_fetch_array($result)){
            $id = $row[0];
            $nombre_completo = $row[1] . " " . $row[2];
            $permiso = $row[3];
            if($idEncargado == $id){
                echo "<option selected = \"selected\" value=$id>$nombre_completo | $permiso</option>\n";
            } else{
                echo "<option value=$id>$nombre_completo | $permiso</option>\n";
            }
         }
         echo "</select><br>\n";
         //Select para reculador***************************************************************
         $query = "SELECT a.id_usuario,a.nombre,a.apellidos,b.nombre FROM usuario a 
                   INNER JOIN permisos b ON a.permisos = b.id;";
         $result = mysqli_query($con,$query);
         echo "Reclutador: <select id = \"reclutador\" name=\"reclutador\" disabled>\n";
         while($row = mysqli_fetch_array($result)){
            $id = $row[0];
            $nombre_completo = $row[1] . " " . $row[2];
            $permiso = $row[3];
            if($idEncargado == $id){
                echo "<option selected = \"selected\" value=$id>$nombre_completo | $permiso</option>\n";
            } else{
                echo "<option value=$id>$nombre_completo | $permiso</option>\n";
            } 
         }
         echo "</select><br>\n";
         //Select para perfil*****************************************************************
         $query = "SELECT id_perfil,nombre FROM perfil ORDER BY nombre";
         $result = mysqli_query($con,$query);
         echo "Perfil: <select id = \"perfil\" name=\"perfil\" disabled>\n";
         while($row = mysqli_fetch_array($result)){
             if($idPerfil == $row[0]){
                echo "<option  selected = \"selected\" value=".$row["id_perfil"].">".$row["nombre"]."</option>\n";
             } else{
                echo "<option value=".$row["id_perfil"].">".$row["nombre"]."</option>\n";
             }
                 
         }
         echo "</select><br>\n";
         /**Falta empleador,obra y ciudad */
         //Mercado interno
         if($mi == 1){
            echo "<input  id = \"mInterno\" checked=\"checked\" type=\"checkbox\" name=\"mInterno\" value=\"i\" disabled> Mercado interno<br>";
         } else{
            echo "<input  id = \"mInterno\" type=\"checkbox\" name=\"mInterno\" value=\"i\"> Mercado interno<br disabled>";
         }
         //Mercado externo
         if($mi == 1){
            echo "<input  id = \"mExterno\" checked=\"checked\" type=\"checkbox\" name=\"mExterno\" value=\"e\" disabled> Mercado externo<br>";
         } else{
            echo "<input id = \"mExterno\" type=\"checkbox\" name=\"mExterno\" value=\"e\" disabled > Mercado externo<br >";
         }          
         //mysqli_close($con); 
    ?>
    <input id = "guardar" type = "submit" name = "guardar" value = "Guardar cambios" disabled >
    <input  type="button" onclick="abilitarEdicion()">Editar</input>
    </from>

    <h1>Estado de requisison</h1>
    <?php
        //Muestra los pasos aprovados y los proximos a aprovar
        $query = "SELECT a.id as estadoID,a.fecha,a.autorizacion,b.id_permisos,b.nombre as nombrePaso,c.nombre,c.apellidos
                  FROM estado_req a 
                  INNER JOIN pasos_requisicion b ON a.idPaso = b.id
                  LEFT JOIN usuario c ON a.idUsuario = c.id_usuario
                  WHERE a.idRequisision = $id_req;";
        $result = mysqli_query($con,$query);
        echo "<table border = 1>\n";
        echo "  <tr>\n";
        echo "      <th>Nombre del paso </th>\n";
        echo "      <th>Estatus</th>\n";
        echo "      <th>Fecha</th>\n";
        echo "      <th>Usarion que autorizo</th>\n";
        echo "      <th>Accion</th>\n";
        echo "</tr>\n";
        $primerNoAuto = false;
        while($row = mysqli_fetch_array($result)){
            $nombre = $row['nombrePaso'];
            $auto = $row['autorizacion'];
            $fecha = $row['fecha'];
            $usuario = $row["nombre"] . " " . $row["apellidos"];
            $idEstado = $row['estadoID'];
            $idPermisos = $row['id_permisos'];
            $accion = "";
            if(!$fecha){
                $fecha = "-";
            }
            if($auto == 1){
                $auto = "Autorizada";
                $accion = "-";
            } else{
                $auto = "No Autorizada";
                if(!$primerNoAuto){
                    $accion = "<a href = \"autorizarPaso.php?idEstado=$idEstado&idPermiso=$idPermisos\">Autorizar</a>";
                    $primerNoAuto = TRUE;
                } else{
                    $accion = "Esperando";
                }
            }
            if(!$usuario){
                $usuario = "-";
            }
            
            
            
            echo "  <tr>\n";
            echo "      <th>$nombre</th>\n";
            echo "      <th>$auto</th>";
            echo "      <th>$fecha</th>\n";
            echo "      <th>$usuario</th>\n";
            echo "      <th>$accion</th>\n";
            echo "  </tr>";
        }
        echo "</table>\n";
    ?>
</body>
</html>

<?php
    if(isset($_POST['guardar'])){
        echo "Hola";
        $id = $GLOBALS['id'];
        $nombre = $_POST["nombre"];
        //$empleadorID = $_POST["empleador"];
        $encargadoID = $_POST["encargado"];
        $reclutadorID = $_POST["reclutador"];
        $perfilID = $_POST["perfil"];
        //$obraID = $_POST["obra"];
        //$ciudadID = $_POST["ciudad"];
        $mInterno = 0;
        $mExterno = 0;
        if(isset($_POST['mInterno'])){
            $mInterno = 1;
        }
        if(isset($_POST['mExterno'])){
            $mExterno = 1;
        }
        
        $sql = "UPDATE requisicion 
                SET id_encargado = $idEncargado,id_perfil = $idPerfil,nombre = '$nombre',mercado_interno = $mInterno, mercado_externo = $mExterno 
                WHERE id = $id";
        //echo $sql . "<br>";
        
        //Insertar la requisison en la base de datos
        include '../../config.php';
        $conn = new mysqli($host,$user,$pass,$name);
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
<script>
    function abilitarEdicion(){
        document.getElementById("nombre").disabled = false;
        document.getElementById("encargado").disabled = false;
        document.getElementById("reclutador").disabled = false;
        document.getElementById("perfil").disabled = false;
        document.getElementById("mInterno").disabled = false;
        document.getElementById("mExterno").disabled = false;
        document.getElementById("guardar").disabled = false;
    }
</script>
