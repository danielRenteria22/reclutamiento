<?php 
    include "../../verificacion.php";
    verificar();
?>


<?php
    include '../../config.php';
    $numNuevos = $_POST["nuevos"];
    $numCons = $_POST["num"];
    $idPonderacion = $_POST["id"];
    $idDetalleArray = array();
    

    //Actualizar los detalles que ya habia
    $i = 0;
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
	}
    //Obtenemos los id de detalles
    $query = "SELECT id FROM detalle_ponderacion WHERE id_ponderacion =$idPonderacion;";
    $result= mysqli_query($con,$query);
    while($rowDetalle = mysqli_fetch_array($result)){
        $idDetalleArray[$i] = $rowDetalle[0];
        $i++;
    }

    //Actualizamos las consideraciones existentes
    for($c = 1; $c <= count($idDetalleArray); $c++){
        $consideracion = $_POST["c$c"];
        $peso = $_POST["p$c"];
        $idDetalle = $idDetalleArray[$c - 1];
        $query = "UPDATE detalle_ponderacion 
                  SET nombre_campo = '$consideracion', peso = $peso
                  WHERE id = $idDetalle";
        mysqli_query($con,$query);
    }

    //Insertamos las nuevas consideraciones
    //Creamos el query para insertar
    $query = "INSERT INTO detalle_ponderacion (id_ponderacion,nombre_campo,peso) VALUES";
    for($x = 1; $x <= $numNuevos; $x++){
        $nIndex = $numCons + $x;
        $nueva_cons = $_POST["nc$nIndex"];
        $nuevo_peso = $_POST["np$nIndex"];
        $query = $query . "($idPonderacion,'$nueva_cons',$nuevo_peso),";
    }
    //remover la ultima coma
	$length = strlen($query);
	$query = substr($query,0,$length-1);
	$query = $query . ";";
    //echo $query;
    mysqli_query($con,$query);

    mysqli_close($con); 

?>
