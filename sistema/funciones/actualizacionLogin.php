<?php
function ActualizarFecha_UltimoAcceso($vIdUsuario, $vFechaUltimoAcceso, $vConexion){
    session_start();

    //Obtener la fecha y hora actuales en formato de MYSQL
    $fecha_Actual = date('Y-m-d H:i:s');

    $SQL = "UPDATE usuarios SET FechaUltimoAcceso = '$fecha_Actual' WHERE Id=$VIdUsuario";

    if(!mysqli_query($vConexion, $SQL)){
        return false;
    }
    return true;
}
?>