<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar ponderacion</title>
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
        $query = "SELECT nombre_campo,peso,id FROM detalle_ponderacion WHERE id_ponderacion =$id;";
        $result= mysqli_query($con,$query);
        $cont = 0;
        while($rowDetalle = mysqli_fetch_array($result)){
            $consideracion = $rowDetalle[0];
            $peso = $rowDetalle[1];
            $idDetalle = $rowDetalle[2];
            $detallesID[$cont] = $idDetalle;
            $cont++;
            echo "<label>
            Consideracion: <input type=\"text\" name = \"c$cont\" value = '$consideracion' > 
            Peso <input type=\"number\" name = \"p$cont\" value = $peso>
            </label><br>";
            
        }
        echo "<button type=\"button\" onclick=\"sendData($cont,$id)\">Editar</button>";

        echo "<h2>Agregar consideraciones</h2>";
        echo "<button onclick=\"agregarConsideracion($cont); return false\">Agregar consideracion</button><br>";
        
    ?>
    
    
    </form>
    
    
</body>
</html>

<script>
    var numDePasos = 0;

    function agregarConsideracion(n) {
        numDePasos++;
        var numAct = numDePasos + n;
        var lbl1 = document.createElement("LABEL");
        var caption = document.createTextNode("Consideracion#" + numAct+": ");
        lbl1.appendChild(caption);

        var inpt = document.createElement("INPUT");
        inpt.setAttribute("name", "nc" + numAct)
        console.log("c" + numAct);

        var lbl2 = document.createElement("LABEL");
        var caption = document.createTextNode(" Peso: ");
        lbl2.appendChild(caption);
                
        var inpt2 = document.createElement("INPUT");
        inpt2.setAttribute("name", "np" + numAct)
        

        var enter = document.createElement("BR");

        var forma = document.getElementById("formEditar");

        forma.appendChild(lbl1);
        forma.appendChild(inpt);
        forma.appendChild(lbl2);
        forma.appendChild(inpt2);
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
        request.open("POST", "editar_ponderacionDB.php");
        request.send(formData);

        alert("Se ha editado! La pagina se recargara para confirmar");
        location.reload();
    }
</script>