<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Realizar ponderacion</title>
</head>
<body>
    <h1>Ponderación</h1>
    <form action="" method="post">
    <?php
        include '../../config.php';
        //Las ponderaciones estan en funcion de id_solicitud
        $id_solicitud = $_GET["id_solicitud"];
        //Obtenemos las consideraciones de la ponderacion correspondiente a esta solicitud
        $query = "SELECT e.id,e.nombre_campo FROM solicitudes a 
                  INNER JOIN requisicion b ON a.id_requisicion = b.id
                  INNER JOIN perfil c ON b.id_perfil = c.id_perfil
                  INNER JOIN ponderaciones d ON c.id_ponderacion = d.id
                  INNER JOIN detalle_ponderacion e ON d.id = e.id_ponderacion
                  WHERE a.id = $id_solicitud;";

        //Conexion con la base de datos
        $conn=mysqli_connect($host,$user,$pass,$name);

        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }
        $result = mysqli_query($conn, $query);
        $consideraciones_id = array();
        $cont = 0;
        while($row = mysqli_fetch_array($result)){
            $consideraciones_id[$cont] = $row[0];
            $id = $row[0];
            $consideracion = $row[1];
            $cont++;
            echo "<p>Consideracion#$cont: $consideracion
                    <select name='c$id' >
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                    </select>
                  </p>\n";
        }
        mysqli_close($conn);
    ?>
    <input type="submit" value="Guardar" name = "guardar">
    </form>

    
    
</body>
</html>

<?php
    if( isset( $_POST["guardar"] ) ){
        $query = "INSERT INTO respuestas_ponderaciones (id_solicitud,id_detalle_ponderacion,calificacion) VALUES ";
        for($i = 0; $i < $cont; $i++){
            $id_consideracion = $consideraciones_id[$i];
            $califiacion = $_POST["c$id_consideracion"];
            $query = $query . "($id_solicitud,$id_consideracion,$califiacion),";
        }
        $length = strlen($query);
	    $query = substr($query,0,$length-1);
	    $query = $query . ";";
        //echo $query;
        include '../../config.php';
        $conn=mysqli_connect($host,$user,$pass,$name);
        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }
        if (mysqli_query($conn, $query)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        header("Location: ver_respuestas_ponderacion.php?id_solicitud=$id_solicitud");
    }

?>