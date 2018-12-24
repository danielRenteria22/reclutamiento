<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Usuario</title>
</head>
<body>  
<form action="" method="post">
    <p>Nombre <input type="text" name="nombre" id="" required></p>
    <p>Apellidos <input type="text" name="apellidos" id="" required></p>
    <p>Usuario <input type="text" name="username" id="" required></p>
    <p>Correo <input type="text" name="correo" id="" required></p>
    <p>Nivel de Acceso <select name="permisos" id="" required></p>
    <?php
        include '../../config.php';
        $conn=mysqli_connect($host,$user,$pass,$name);
        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }
        $query = "SELECT * FROM permisos ORDER BY nombre";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_array($result)){
		    echo "<option value=".$row["id"].">".$row["nombre"]."</option>\n";
		}	
        mysqli_close($conn); 
    ?>
    </select>
    <p>Contraseña <input type="text" name="password" id="" required></p>
    <input type="submit" value="Crear" name = "crear">

</form>
    
</body>
</html>

<?php
    if(isset($_POST["crear"])){
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $username = $_POST["username"];
        $correo = $_POST["correo"];
        $permisos = $_POST["permisos"];
        $password = $_POST["password"];

        $conn = mysqli_connect("localhost","root","","reclutamiento");
        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }
        $sql = "INSERT INTO usuario(username,nombre,apellidos,password,permisos,correo) 
        VALUES ('$username','$nombre','$apellidos','$password',$permisos,'$correo')";
        mysqli_query($conn,$sql);
        header("Location: ver_usuarios.php");
        if(mysqli_error($conn)){
            echo mysqli_error($conn);
        }
        mysqli_close($conn); 
    }

    
?>