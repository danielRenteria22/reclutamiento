<?php
    function verificar(){
        session_start();
        if(!isset($_SESSION["id_usuario"])){
            echo "<script>";
            echo "alert(\"¡Necesitas registrarte!\");\n";
            echo "window.location.href = \"../../log_in_us.php\"";
            echo "</script>";
        } 
    }

    function verificar_admin(){
        session_start();
        if(!isset($_SESSION["id_usuario"])){
            echo "<script>";
            echo "alert(\"¡No estas autorizado para entrar aquí!\");\n";
            echo "window.location.href = \"../../log_in_us.php\"";
            echo "</script>";
            
        } else{
            if($_SESSION["nivel"] != 3){
                echo "<script>";
                echo "alert(\"¡No estas autorizado para entrar aquí!\");\n";
                echo "window.location.href = \"../../log_in_us.php\"";
                echo "</script>";
            }
        }

        
    }
?>