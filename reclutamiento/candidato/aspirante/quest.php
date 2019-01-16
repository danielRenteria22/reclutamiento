<?php 
    include "../../verificacion.php";
    verificar();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cuestionario de Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../style.css">
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
            $pregunta;
            while($row = mysqli_fetch_array($result)){
                echo "  <tr>\n";
                $pregunta[$c] = $row[0];
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
        $idu = $_GET['idu'];
        $idp = $_GET['idp'];
        $idr = $_GET['idr'];
        date_default_timezone_set("America/Chihuahua");
        $fecha = date("Y/m/d");
        $pasomax;
        $conn=mysqli_connect($host,$user,$pass,$name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
//insertamos una nueva solicitud
        mysqli_query($conn,"INSERT INTO solicitudes 
                                VALUES  (
                                    '',
                                    '".$idu."',
                                    '".$idr."',
                                    '".$fecha."',
                                    '',
                                    '0',
                                    0
                                );");
                                echo "Holaaaaaaaaa!";
                                echo mysqli_error($conn);
//buscamos la solicitud con mayor id (la que se acaba de insertar)
        $query = "SELECT id FROM solicitudes WHERE id = (SELECT MAX(id) from solicitudes)";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_array($result)){
            $pasomax=$row[0];
        }
        
//insertamos una calificacion para las encuestas
        mysqli_query($conn,"INSERT INTO calificaciones 
                                VALUES  (
                                    '',
                                    '',
                                    '',
                                    '',
                                    '$pasomax'
                                );");
//isnertar las respuestas de las KQ
        $a=0;
        $idresp;
        $resp = $_POST['rep'];;
        $querys = "SELECT
                killer_question.id
                    FROM 
                killer_question,
                respuestas 
                    WHERE 
                        $id = id_perfil 
                    AND
                        respuestas.id_killer_question=killer_question.id";
                    $results = mysqli_query($conn,$querys);
            while($row = mysqli_fetch_array($results)){
                $val = $resp[$a];
                $myid = $row[0];

                $eseql = "SELECT id FROM respuestas WHERE id_killer_question = $myid";
                $rest = mysqli_query($conn,$eseql);
                while($raw = mysqli_fetch_array($rest))
                {
                    $idresp = $raw[0];
                }

                mysqli_query($conn,"INSERT INTO resp_killer_questions
                                VALUES(
                                    '',
                                    '".$pasomax."',
                                    '".$myid."',
                                    '".$idresp."',
                                    '".$val."'
                                );");
                $a++;
            }
        echo"Solicitud enviada";        
        $conn->close();
    }
?>