<?php
    session_start();

    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = mysqli_connect("localhost","root","","reclutamiento");
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    
   
    $query = "SELECT id_usuario,permisos FROM usuario WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    if($row){
        $_SESSION["id_usuario"] = $row[0];
        $_SESSION["nivel"] = $row[1];

        $id = $_SESSION["id_usuario"];
        $nivel = $_SESSION["nivel"];

        echo "<script>
                alert('id = $id, nivel = $nivel');
                window.history.back();
             </script>";
        //header("Location: menu/index.html");
    } else{
        echo "<script>
                alert('Usuario o contraseña equivocados');
                window.history.back();
             </script>";
    }
    
?>

