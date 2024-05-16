<?php
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) ) {
        header('Location: cerrarsesion.php');
        exit;
    }
    
    require_once 'funciones/conexion.php';
    $MiConexion = ConexionBD();
   

    require_once 'funciones/select_general.php';

    if ( Eliminar_Solicitud($MiConexion , $_GET['ID_REGISTRO']) != false ) {
        $_SESSION['Mensaje'].='Se ha eliminado la solicitud seleccionada';
        $_SESSION['Estilo']='success';
    }else {
        $_SESSION['Mensaje'].='No se pudo borrar la solicitud. <br /> ';
        $_SESSION['Estilo']='warning';
    }
    
   
    header('Location: listado.php');
    exit;
?>