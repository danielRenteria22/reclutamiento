<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Killer Question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
    <left><h1>Crear Killer Question</h1></left>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <?php
        $id = $_GET['idp'];
        echo "  <tr><td nowrap>Pregunta:</td><td>
            <input name='pregunta'>&nbsp;</td></tr><br>\n";
        echo "  <tr><td nowrap>Respuesta:</td>\n";
        echo "  <input type='radio' name='rep' value='Si'checked>&nbsp;Si
                <input type='radio' name='rep' value='No'>&nbsp;No</td></tr><br>\n";
        echo "  <tr><td nowrap>Descalificar:</td>\n";
        echo "  <input type='radio' name='des' value='Si'checked>&nbsp;Si
                <input type='radio' name='des' value='No'>&nbsp;No</td></tr><br>\n";
    ?>
    <input type = "submit" name = "crear" value = "Agregar Pregunta">
            
    </form>
<?php  
    $ids = $_GET['idp'];
    echo" <button onclick=location.href='inf_prof.php?id=$ids'>Atras</button>";
?>
    
</body>
</html>

<?php
    include '../../config.php';
    if(isset($_POST['crear'])){
        $id = $_GET['idp'];
        $pr = $_POST['pregunta'];
        $re = $_POST['rep'];
        $ds = $_POST['des'];
        $conn=mysqli_connect($host,$user,$pass,$name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
/*
mysqli_select_db($conn, "reclutamiento");
mysqli_query($conn, "INSERT INTO killer_question 
                        VALUES  (
                                    '',
                                    '".$id."',
                                    '".$pr."'
                                );");
*/
        $sql = "INSERT INTO killer_question 
                                VALUES  (
                                    '',
                                    '".$id."',
                                    '".$pr."'
                                );";
        if ($conn->query($sql) === TRUE) {
        //Obtenemos el id de la ponderacion
        $myid = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit;
        }
mysqli_query($conn, "INSERT INTO respuestas 
                        VALUES  (
                                    '',
                                    '".$myid."',
                                    '".$re."',
                                    '".$ds."'
                                );");
        echo"pregunta agregada";        
        $conn->close();
    }
?>
