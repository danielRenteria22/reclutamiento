<?php
    include '../../config.php';
    $num = $_POST["num"];
    $nombre = $_POST["nombre"];

    //Verificar si todos las consideraciones y pesos estén llenos
    $validacion = true;
    for($id = 1; $id <= $num; $id++){
        $conTemp = $_POST["c" . $id];
        $pesoTemp = $_POST["p" . $id];
        echo "$id: $conTemp - $pesoTemp \n";
        if($conTemp == "" || $pesoTemp == ""){
            $validacion = false;
            break;
        }

        if(!is_numeric($pesoTemp)){
            $validacion = false;
            break;
        }
    }

    if(!$validacion){
        echo "Alguno de los daros no fue valido. Asegurese que todos los campos esten
              llenos y con valores validos";
        exit;
    }

    //Configuracion del sql
    $conn=mysqli_connect($host,$user,$pass,$name);
	if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    }

    //Insertamos la ponderacion a la DB
    $sql = "INSERT INTO ponderaciones(nombre) VALUES ('$nombre');";
    if ($conn->query($sql) === TRUE) {
        //Obtenemos el id de la ponderacion
        $id_ponderacion = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    //Insertamos los detalles de la ponderacion
    $sql = "INSERT INTO detalle_ponderacion (id_ponderacion	,nombre_campo,peso) VALUES ";
    for($id = 1; $id <= $num; $id++){
        $conTemp = $_POST["c" . $id];
        $pesoTemp = $_POST["p" . $id];
        $sql = $sql . "($id_ponderacion,'$conTemp',$pesoTemp),";
    }
        //remover la ultima coma
	$length = strlen($sql);
	$sql = substr($sql,0,$length-1);
	$sql = $sql . ";";
    echo $sql;
    
    if ($conn->query($sql) === TRUE) {
        echo "Se han insertado los pasos de manera exitosa";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>