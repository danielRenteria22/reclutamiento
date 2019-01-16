<?php 
    include "../../verificacion.php";
    verificar();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <center><h1>Crear Perfil</h1></center>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Foto:         <input name="imagen" type="file" maxlength="150"></label><br>
    <label>Numero:       <input type="text" name="numb"></label><br>
    <label>Nombre:       <input type="text" name="name"></label><br>
    <label>Apellidos:    <input type="text" name="ape"></label><br>
    <label>Contraseña:   <input type="text" name="pas"></label><br>
    <label>Sexo:         <input type="text" name="sexo"></label><br>
    <label>Estado Civil: <input type="text" name="civ"></label><br>
    <label>NSS:          <input type="text" name="nss"></label><br>
    <label>Telefono:     <input type="text" name="tel"></label><br>
    <label>Email:        <input type="text" name="email"></label><br>
            <input type = "submit" name = "crear" value = "Crear perfil">
    </form>
</body>
</html>

<?php
    include '../../config.php';
    if(isset($_POST['crear'])){
        $conn=mysqli_connect($host,$user,$pass,$name);

        $nombre = $_FILES['imagen']['name'];
        $nombrer = strtolower($nombre);
        $cd=$_FILES['imagen']['tmp_name'];
        $ruta = "fotos/" . $_FILES['imagen']['name'];
        $destino = "fotos/".$nombrer;
        $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

        $numero    = $_POST["numb"];
        $nombre    = $_POST["name"];
        $apellido  = $_POST["ape"];
        $pas      = $_POST["pas"];
        $sexo      = $_POST["sexo"];
        $nss       = $_POST["civ"];
        $civil     = $_POST["nss"];
        $telefono  = $_POST["tel"];
        $email     = $_POST["email"];

$link = mysqli_connect($host, $user, $pass,$name);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO employees 
                        VALUES  (
                                    '".$nombre."',
                                    '".$pas."',
                                    '".$apellido."',
                                    '".$numero."',
                                    '".$civil."',
                                    '".$sexo."',
                                    '".$nss."',
                                    '".$email."',
                                    '".$telefono."',
                                    '0',
                                    '".$destino."'
                                );");
    $query = "SELECT employid FROM employees WHERE employid = (SELECT MAX(employid) from employees)";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_array($result)){
            $pasomax=$row[0];
        }

mysqli_query($link, "INSERT INTO referencias 
                        VALUES  (
                                    '',
                                    '".$pasomax."',
                                    '".$nombre1."',
                                    '".$casa1."',
                                    '".$tel1."',
                                    '".$ocup1."',
                                    '".$tiempo1."'
                                );");
mysqli_query($link, "INSERT INTO referencias 
                        VALUES  (
                                    '',
                                    '".$pasomax."',
                                    '".$nombre2."',
                                    '".$casa2."',
                                    '".$tel2."',
                                    '".$ocup2."',
                                    '".$tiempo2."'
                                );");
mysqli_query($link, "INSERT INTO referencias 
                        VALUES  (
                                    '',
                                    '".$pasomax."',
                                    '".$nombre3."',
                                    '".$casa3."',
                                    '".$tel3."',
                                    '".$ocup3."',
                                    '".$tiempo3."'
                                );");
        $conn->close();
    }
?>