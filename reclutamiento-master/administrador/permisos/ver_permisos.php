<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Usarios</title>
</head>
<body>
<?php
    include '../../config.php';
    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    
    echo "<table border = 1>
    <tr>
        <th>Nombre</th>
        <th>Eliminar</th>
    </tr>";
    $query = "SELECT * FROM permisos";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $id = $row["id"];
        $nombre = $row["nombre"];

        echo "<tr>
                <td>$nombre</td>
                <td><a href = 'eliminar_permiso.php?id=$id'>Eliminar</a></td>
            </tr>";
        
    }
    echo "</table>";
    echo "</br>";
    mysqli_close($conn);

?>

<p><a href="agregar_permisos.php">Agregar permiso</a></p>
    
</body>
</html>
