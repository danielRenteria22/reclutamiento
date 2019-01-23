<?php 
    include "../../verificacion.php";
    verificar_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Crear entrevista</title>
</head>
<body>
    <h1>Crear entrevista</h1>
    <form enctype="multipart/form-data" id = "formCrear" method="POST" >
        <label >Nombre: <input type="text" name="nombre" id = "nombre">
                        <button type="button" onclick="sendData()">Crear</button>
        </label> <br>
        <button onclick="agregarConsideracion(); return false">Agregar pregunta</button><br>
        <label >Pregunta #1: <input type="text" name = "p1" id = "p1"><br>
        </label>
    </form>
</body>
</html>

<script>
    var numDePasos = 1;

    function agregarConsideracion() {
        numDePasos++;
        var lbl1 = document.createElement("LABEL");
        var caption = document.createTextNode("Pregunta #" + numDePasos+": ");
        lbl1.appendChild(caption);

        var inpt = document.createElement("INPUT");
        inpt.setAttribute("name", "p" + numDePasos)
        console.log("c" + numDePasos);

        

        var enter = document.createElement("BR");

        var forma = document.getElementById("formCrear");

        forma.appendChild(lbl1);
        forma.appendChild(inpt);
        forma.appendChild(enter);
    }

    function sendData(data) {
        console.log("Enviando formulario")
        var formElement = document.getElementById("formCrear");
        formData = new FormData(formElement);
        formData.append("num", numDePasos);

        var request = new XMLHttpRequest();
        request.open("POST", "crear_entrevistaDB.php");
        request.send(formData);

        alert("Se han realizado los cambios. Si no se ven reflejados, por favor recarge la pagina");
        window.location.href = "ver_entrevistas.php";
    }

</script>
