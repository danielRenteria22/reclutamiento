<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Editar entrevista</title>
</head>
<body>

    <form enctype="multipart/form-data" id = "formEditar" method="POST" >
    
    <?php
        include '../../config.php';
        $id = $_GET["id"];
        $GLOBALS['id'] = $id;
        $nombre = $_GET["nombre"];
        $detallesID = array();

        echo "<label>Nombre: <input type=\"text\" name = \"nombre\" value = $nombre></label><br>\n";

        $con=mysqli_connect($host,$user,$pass,$name);

        //Obtenemos los detalles
        $query = "SELECT pregunta,id_pregunta_entrevista FROM pregunta_entrevista WHERE id_entrevista =$id;";
        $result= mysqli_query($con,$query);
        $cont = 0;
        while($rowDetalle = mysqli_fetch_array($result)){
            $pregunta = $rowDetalle[0];
            $id_preguta = $rowDetalle[1];
            $detallesID[$cont] = $id_preguta;
            $cont++;
            echo "<label>
            pregunta: <input type=\"text\" name = \"p$cont\" value = '$pregunta' > 
            </label><br>";
            
        }
        echo "<button type=\"button\" onclick=\"sendData($cont,$id)\">Editar</button>";

        echo "<h2>Agregar preguntaes</h2>";
        echo "<button onclick=\"agregarpregunta($cont); return false\">Agregar pregunta</button><br>";
        
    ?>
    
    
    </form>
    
    
</body>
</html>

<script>
    var numDePasos = 0;

    function agregarpregunta(n) {
        numDePasos++;
        var numAct = numDePasos + n;
        var lbl1 = document.createElement("LABEL");
        var caption = document.createTextNode("Pregunta#" + numAct+": ");
        lbl1.appendChild(caption);

        var inpt = document.createElement("INPUT");
        inpt.setAttribute("name", "np" + numAct)
        console.log("c" + numAct);

        
        

        var enter = document.createElement("BR");

        var forma = document.getElementById("formEditar");

        forma.appendChild(lbl1);
        forma.appendChild(inpt);
        forma.appendChild(enter);
    }

    function sendData(data,id) {
        console.log("Enviando formulario")
        var formElement = document.getElementById("formEditar");
        formData = new FormData(formElement);
        formData.append("nuevos", numDePasos);
        formData.append("num", data);
        formData.append("id", id);

        var request = new XMLHttpRequest();
        request.open("POST", "editar_entrevistaDB.php");
        request.send(formData);

        alert("Se ha editado! La pagina se recargara para confirmar");
        location.reload();
    }
</script>
