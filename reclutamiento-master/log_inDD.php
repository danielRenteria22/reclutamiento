<?php
    session_start();

    $username = $_POST["username"];
    $password = $_POST["password"];

    

    include 'config.php';
    $conn=mysqli_connect($host,$user,$pass,$name);
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }
    
    $id=0;
    $query = "SELECT employid FROM employees WHERE empfullname = '$username' AND employee_passwd = '$password'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $id = $row[0];
        $_SESSION["id_usuario"] = $row[0];
    }

    if($id!=0){
        
       
        header("Location: candidato/aspirante/inf_asp.php?id=$id");
    } else{
        echo "<script>
                alert('Usuario o contraseña equivocados');
                window.history.back();
             </script>";
    }
    
?>

