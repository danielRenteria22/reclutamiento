<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Killer Question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
</body>
</html>

<?php
    include '../../config.php';
    if(isset($_POST['crear'])){
        $pr = $_POST['pregunta'];
        $re = $_POST['rep'];
        $ds = $_POST['des'];
        $conn=mysqli_connect($host,$user,$pass,$name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "INSERT INTO killer_question VALUES ('','$id','$pr')";
        $query = "SELECT
                    id
                        FROM 
                        killer_question 
                            WHERE 
                            $id = id_perfil
                            AND
                            $pr = pregunta";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_array($result)){
            $myid=$row[0];
        }
        $sql = "INSERT INTO respuestas VALUES ('','$myid','$re','$ds')";
        echo"pregunta agregada";        
        $conn->close();
    }
?>