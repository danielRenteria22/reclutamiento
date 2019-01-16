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
    <h3>Informacion Personal</h3>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <label>Foto:         <input name="imagen" type="file" maxlength="150"></label><br>
    <label>Nombre:       <input type="text" name="name"></label><br>
    <label>Apellidos:    <input type="text" name="ape"></label><br>
    <label>Contraseña:   <input type="text" name="pas"></label><br>
    <label>Sexo:         <input type="text" name="sexo"></label><br>
    <label>Estado Civil: <input type="text" name="civ"></label><br>
    <label>NSS:          <input type="text" name="nss"></label><br>
    <label>Telefono:     <input type="text" name="tel"></label><br>
    <label>Email:        <input type="text" name="email"></label><br>

    <h3>Referencias Personales</h3>
    <label>Nombre:              <input type="text" name="nombre1"></label><br>
    <label>Domicilio:           <input type="text" name="casa1"></label><br>
    <label>Telefono:            <input type="text" name="tel1"></label><br>
    <label>Ocupacion:           <input type="text" name="ocup1"></label><br>
    <label>Tiempo de Conocerlo: <input type="text" name="tiempo1"></label><br>
<br><br>
    <label>Nombre:              <input type="text" name="nombre2"></label><br>
    <label>Domicilio:           <input type="text" name="casa2"></label><br>
    <label>Telefono:            <input type="text" name="tel2"></label><br>
    <label>Ocupacion:           <input type="text" name="ocup2"></label><br>
    <label>Tiempo de Conocerlo: <input type="text" name="tiempo2"></label><br>
<br><br>
    <label>Nombre:              <input type="text" name="nombre3"></label><br>
    <label>Domicilio:           <input type="text" name="casa3"></label><br>
    <label>Telefono:            <input type="text" name="tel3"></label><br>
    <label>Ocupacion:           <input type="text" name="ocup3"></label><br>
    <label>Tiempo de Conocerlo: <input type="text" name="tiempo3"></label><br>
<br><br>
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

        $nombre    = $_POST["name"];
        $apellido  = $_POST["ape"];
        $pas      = $_POST["pas"];
        $sexo      = $_POST["sexo"];
        $nss       = $_POST["civ"];
        $civil     = $_POST["nss"];
        $telefono  = $_POST["tel"];
        $email     = $_POST["email"];

        $nombre1 = $_POST["nombre1"];
        $casa1   = $_POST["casa1"];
        $tel1    = $_POST["tel1"];
        $ocup1   = $_POST["ocup1"];
        $tiempo1 = $_POST["tiempo1"];

        $nombre2 = $_POST["nombre2"];
        $casa2   = $_POST["casa2"];
        $tel2    = $_POST["tel2"];
        $ocup2   = $_POST["ocup2"];
        $tiempo2 = $_POST["tiempo2"];

        $nombre3 = $_POST["nombre3"];
        $casa3   = $_POST["casa3"];
        $tel3    = $_POST["tel3"];
        $ocup3   = $_POST["ocup3"];
        $tiempo3 = $_POST["tiempo3"];

$link = mysqli_connect($host, $user, $pass,$name);
mysqli_select_db($link, "reclutamiento");
mysqli_query($link, "INSERT INTO employees 
                        VALUES  (
                                    '".$nombre."',
                                    '".$pas."',
                                    '".$apellido."',
                                    '',
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
        header("Location: ../../menu/index.html");
    }

?>