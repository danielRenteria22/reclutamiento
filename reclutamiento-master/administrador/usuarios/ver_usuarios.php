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
        <th>Apellidos</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Permisos</th>
        <th>Correo</th>
        <th>Eliminar</th>
    </tr>";
    $query = "SELECT * FROM usuario";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $id = $row["id_usuario"];
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
        $username = $row["username"];
        $password = $row["password"];
        $permisos = $row["permisos"];
        $correo = $row["correo"];
        


        echo "<tr>
                <td>$nombre</td>
                <td>$apellidos</td>
                <td>$username</td>
                <td>$password</td>
                <td>$permisos</td>
                <td>$correo</td>
                <td><a href = 'eliminar_usuario.php?id=$id'>Eliminar</a></td>

            </tr>";
        
    }
    echo "</table>";
    echo "</br>";
    mysqli_close($conn);

?>

<p><a href="crear_usuario.php">Crear usuario</a></p>
    
</body>
</html>
