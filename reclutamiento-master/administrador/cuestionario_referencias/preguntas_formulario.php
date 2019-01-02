<?php 
    include "../../verificacion.php";
    verificar_admin();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
        <center><h1> Agregar preguntas al formulario de referencias</h1></center>
        <form enctype="multipart/form-data" id = "formaAgregar" method="POST" >
            <button onclick="agregarPaso(); return false">Agregar pregunta</button><br>
            <button type="button" onclick="sendData()">Agregar</button><br>
            <!--<input hidden name = "num" type = "number" id = "num"> -->
            <label>Pregunta: <input type="text" name="p1"></label><br>
        </form>    
    </body>
</html>

<script>
    var numDePasos = 1;

    function agregarPaso() {
        numDePasos++;
        var lbl1 = document.createElement("LABEL");
        var caption = document.createTextNode("Pregunta: ");
        lbl1.appendChild(caption);

        var inpt = document.createElement("INPUT");
        inpt.setAttribute("name", "p" + numDePasos)
        console.log(inpt);

        

        //document.getElementById("num").value = numDePasos;

        var enter = document.createElement("BR");

        var forma = document.getElementById("formaAgregar");

        forma.appendChild(lbl1);
        forma.appendChild(inpt);
        forma.appendChild(enter);
    }

    function sendData(data) {
        console.log("Enviando formulario")
        var formElement = document.getElementById("formaAgregar");
        formData = new FormData(formElement);
        formData.append("num", numDePasos);

        var request = new XMLHttpRequest();
        request.open("POST", "preguntas_formularioDB.php");
        request.send(formData);
    }
</script>



