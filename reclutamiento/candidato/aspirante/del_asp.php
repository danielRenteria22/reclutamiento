<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Descartar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <left><h1>Descartar</h1></left>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <?php
        $id = $_GET['id'];
        echo "  <tr><td nowrap>Motivos:</td><td><br>
            <textarea name='comentarios' rows='10' cols='40'>Escribe aquí tus comentarios</textarea>\n";
    ?>
    <input type = "submit" name = "crear" value = "Agregar Pregunta">
            
    </form>
    
</body>
</html>

<?php
    include '../../config.php';
    $id = $_GET["id"];
    $con=mysqli_connect($host,$user,$pass,$name);
    if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
    }
    
    $query = "UPDATE employees SET tipo = '1' WHERE employid = $id";
    mysqli_query($con,$query);
?>


<?php
    include '../../config.php';
    if(isset($_POST['crear'])){
        $id = $_GET['id'];
        $pr = $_POST['comentarios'];
        $conn=mysqli_connect($host,$user,$pass,$name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "INSERT INTO comentario 
                                VALUES  (
                                    '',
                                    '".$id."',
                                    '".$pr."'
                                );";      
        $conn->close();
    }
    $url = "index.php";
    header( "Location: $url" );
?>