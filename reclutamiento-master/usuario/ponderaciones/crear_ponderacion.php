<?php 
    include "../../verificacion.php";
    verificar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title>Crear ponderacion</title>
</head>
<body>
    <h1>Crear ponderacion</h1>
    <form enctype="multipart/form-data" id = "formCrear" method="POST" >
        <label >Nombre: <input type="text" name="nombre" id = "nombre">
                        <button type="button" onclick="sendData()">Crear</button>
        </label> <br>
        <button onclick="agregarConsideracion(); return false">Agregar consideracion</button><br>
        <label >Consderacion #1: <input type="text" name = "c1" id = "c1">
                Peso: <input type="text" name = "p1" id = "p1"><br>
        </label>
    </form>
</body>
</html>

<script>
    var numDePasos = 1;

    function agregarConsideracion() {
        numDePasos++;
        var lbl1 = document.createElement("LABEL");
        var caption = document.createTextNode("Consideracion#" + numDePasos+": ");
        lbl1.appendChild(caption);

        var inpt = document.createElement("INPUT");
        inpt.setAttribute("name", "c" + numDePasos)
        console.log("c" + numDePasos);

        var lbl2 = document.createElement("LABEL");
        var caption = document.createTextNode(" Peso: ");
        lbl2.appendChild(caption);
                
        var inpt2 = document.createElement("INPUT");
        inpt2.setAttribute("name", "p" + numDePasos)
        

        var enter = document.createElement("BR");

        var forma = document.getElementById("formCrear");

        forma.appendChild(lbl1);
        forma.appendChild(inpt);
        forma.appendChild(lbl2);
        forma.appendChild(inpt2);
        forma.appendChild(enter);
    }

    function sendData(data) {
        console.log("Enviando formulario")
        var formElement = document.getElementById("formCrear");
        formData = new FormData(formElement);
        formData.append("num", numDePasos);

        var request = new XMLHttpRequest();
        request.open("POST", "crear_ponderacionesDB.php");
        request.send(formData);

        alert("Se han realizado los cambios. Si no se ven reflejados, por favor recarge la pagina");
        window.location.href = "ver_ponderaciones.php";
    }

</script>
