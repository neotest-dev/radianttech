<?php

    $host = "localhost";
    $user = "root";
    $clave = "";
    $bd = "bd_radiant";

    $conexion = mysqli_connect($host,$user,$clave,$bd);
    if (mysqli_connect_errno()){
        echo "ERROR DE CONEXIÓN";
        exit();
    }

    mysqli_select_db($conexion,$bd) or die("BD NO EXISTE");

    mysqli_set_charset($conexion,"utf8");


?>
