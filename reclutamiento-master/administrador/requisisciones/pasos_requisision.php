<?php 
    include "../../verificacion.php";
    verificar();
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../style.css">
	</head
    <body>
        <center><h1> Agregar pasos para autorizacion de requisisiones</h1></center>
        <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
            <button onclick="agregarPaso(); return false">Agregar Paso</button><br>
            <button type="button" onclick="sendData()">Agregar</button><br>
            <!--<input hidden name = "num" type = "number" id = "num"> -->
            <label>Descripcion del paso <input type="text" name="desc1"></label>
            <?php
                include '../../config.php';
			    $con=mysqli_connect($host,$user,$pass,$name);
			    // Check connection
			    if (mysqli_connect_errno())
			    {
				    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $query = "SELECT * FROM permisos ORDER BY nombre";
			    $result = mysqli_query($con,$query);
			    echo "Nivel autorizacion: <select id = \"permiso\" name=\"idPermiso1\">\n";
				while($row = mysqli_fetch_array($result)){
					    echo "<option value=".$row["id"].">".$row["nombre"]."</option>\n";
				}
                echo "</select><br>\n";	
                mysqli_close($con); 
		    ?>
        </form>    
    </body>
</html>

<script>
    var numDePasos = 1;

    function agregarPaso() {
        numDePasos++;
        var lbl1 = document.createElement("LABEL");
        var caption = document.createTextNode("Descripcion del paso ");
        lbl1.appendChild(caption);

        var inpt = document.createElement("INPUT");
        inpt.setAttribute("name", "desc" + numDePasos)
        console.log(inpt);

        var lbl2 = document.createElement("LABEL");
        var caption = document.createTextNode(" Nivel Autorizacion: ");
        lbl2.appendChild(caption);
                
        var permisoCopia = document.getElementById("permiso").cloneNode(true);
        permisoCopia.setAttribute("name", "idPermiso" + numDePasos);

        //document.getElementById("num").value = numDePasos;

        var enter = document.createElement("BR");

        var forma = document.getElementById("formaAgregar");

        forma.appendChild(lbl1);
        forma.appendChild(inpt);
        forma.appendChild(lbl2);
        forma.appendChild(permisoCopia);
        forma.appendChild(enter);
    }

    function sendData(data) {
        console.log("Enviando formulario")
        var formElement = document.getElementById("formaAgregar");
        formData = new FormData(formElement);
        formData.append("num", numDePasos);

        var request = new XMLHttpRequest();
        request.open("POST", "pasos_requisisionDB.php");
        request.send(formData);
    }
</script>



