<?php
    function verificar(){
        session_start();
        if(!isset($_SESSION["id_usuario"])){
            echo "<script>";
            echo "alert(\"¡Necesitas registrarte!\");\n";
            echo "window.location.href = \"log_in.php\"";
            echo "</script>";
        } 
    }
?>