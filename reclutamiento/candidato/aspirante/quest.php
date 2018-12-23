<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cuestionario de Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <left><h1>Cuestionario Inicial</h1></left>
    <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
    <?php
        include '../../config.php';
        $id = $_GET['idp'];
        $query = "SELECT
                pregunta
                    FROM 
                killer_question,
                respuestas 
            WHERE 
                $id = id_perfil 
            AND
                respuestas.id_killer_question=killer_question.id";
            $con=mysqli_connect($host,$user,$pass,$name);
            $result = mysqli_query($con,$query);
            $c=0;
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                echo "      <br><b><th>Pregunta:</b> ".$row[0]."</th><br/>\n";
                echo "  <input type='radio' name='rep[$c]' value='Si'checked>&nbsp;Si
                        <input type='radio' name='rep[$c]' value='No'>&nbsp;No</td></tr><br>\n";
                $c++;
            }
    ?>
    <br>
    <input type = "submit" name = "crear" value = "Enviar Solicitud">
            
    </form>
    
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