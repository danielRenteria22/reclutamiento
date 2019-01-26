<?php 
//
// 3 = contratado
// 0 = candidato normal
// 1 = despedido
//

    include "../../verificacion.php";
    verificar_admin();
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
    echo"<h3>Mercado Interno</h3>";
    echo "<table border = 1>
    <tr>
        <th>No.</th>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Estado Civil</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>NSS</th>
        <th>Despedir</th>
    </tr>";
    $query = "SELECT * FROM employees where tipo = '3'";
    $c=1;
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $id = $row["employid"];
        $email = $row["email"];
        $nombre = $row["empfullname"];
        $apellidos = $row["apellidos"];
        $username = $row["employid"];
        $civ = $row["edociv"];
        $phone = $row["telefono"];
        $nss = $row["nss"];
        echo "<tr>
                <td>$c</td>
                <td>$username</td>
                <td>$nombre</td>
                <td>$apellidos</td>
                <td>$civ</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$nss</td>
                <td><a href = 'despedir.php?id=$id'>Eliminar</a></td>
            </tr>";
        $c++;
    }
    echo "</table>";
    echo "</br>";


    echo"<h3>Mercado Externo</h3>";
    echo "<table border = 1>
    <tr>
        <th>No.</th>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Estado Civil</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>NSS</th>
    </tr>";
    $query = "SELECT * FROM employees where tipo = '0'";
    $c=1;
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $email = $row["email"];
        $nombre = $row["empfullname"];
        $apellidos = $row["apellidos"];
        $username = $row["employid"];
        $civ = $row["edociv"];
        $phone = $row["telefono"];
        $nss = $row["nss"];
        echo "<tr>
                <td>$c</td>
                <td>$username</td>
                <td>$nombre</td>
                <td>$apellidos</td>
                <td>$civ</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$nss</td>
            </tr>";
        $c++;
    }
    echo "</table>";
    echo "</br>";

    echo"<h3>Despedidos</h3>";
    echo "<table border = 1>
    <tr>
        <th>No.</th>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Estado Civil</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>NSS</th>
    </tr>";
    $query = "SELECT * FROM employees where tipo = '1'";
    $c=1;
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $email = $row["email"];
        $nombre = $row["empfullname"];
        $apellidos = $row["apellidos"];
        $username = $row["employid"];
        $civ = $row["edociv"];
        $phone = $row["telefono"];
        $nss = $row["nss"];
        echo "<tr>
                <td>$c</td>
                <td>$username</td>
                <td>$nombre</td>
                <td>$apellidos</td>
                <td>$civ</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$nss</td>
            </tr>";
        $c++;
    }
    echo "</table>";
    echo "</br>";
    mysqli_close($conn);


?>
    <b><b>
    <button onclick="location.href='../menu/index.html'">Atras</button>
</body>
</html>
