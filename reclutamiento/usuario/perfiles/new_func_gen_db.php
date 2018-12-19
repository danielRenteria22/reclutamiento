<?php
    include '../../config.php';
    $num = $_POST["num"];
		
	$con=mysqli_connect($host,$user,$pass,$name);
	if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    }
    $idp2 = $_POST["idp2"];
    $idp = $_GET["idp"];
    //Insertamos los detalles de la ponderacion
    $sql = "INSERT INTO funciones_gles VALUES ";
    for($id = 1; $id <= $num; $id++){
        $conTemp = $_POST["c" . $id];
        $sql = $sql . "('','3','$conTemp'),";
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