<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear ponderacion</title>
</head>
<body>
    <h1>Crear ponderacion</h1>
    <form enctype="multipart/form-data" id = "formCrear" method="POST" >
        <button type="button" onclick="sendData()">Crear</button><br>
        <button onclick="agregarConsideracion(); return false">Agregar Funcion</button><br>
        <label >Funcion#1: <input type="text" name = "c1" id = "c1"><br>
        </label>
    </form>
</body>
</html>

<script>
    var numDePasos = 1;

    function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    function agregarConsideracion() {
        numDePasos++;
        var lbl1 = document.createElement("LABEL");
        var caption = document.createTextNode("Funcion#" + numDePasos+": ");
        lbl1.appendChild(caption);

        var inpt = document.createElement("INPUT");
        inpt.setAttribute("name", "c" + numDePasos)
        console.log("c" + numDePasos);
        

        var enter = document.createElement("BR");

        var forma = document.getElementById("formCrear");

        forma.appendChild(lbl1);
        forma.appendChild(inpt);
        forma.appendChild(enter);
    }

    function sendData(data) {
        var idp2 = getParameterByName('prodId');
        console.log("Enviando formulario")
        var formElement = document.getElementById("formCrear");
        formData = new FormData(formElement);
        formData.append("num", numDePasos);
        var request = new XMLHttpRequest();
        request.open("POST", "new_func_part_db.php");
        request.send(formData);
    }

</script>