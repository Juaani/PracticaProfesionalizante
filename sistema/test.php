<?php
//usando un ejemplo


$fecha_Actual = date("Y-m-d H:i:s");

$nombre = mysqli_real_escape_string($vConexion, $_SESSION['Usuario_Nombre']);
$apellido = mysqli_real_escape_string($vConexion, $_SESSION['Usuario_Apellido']);
$IdUsuario = mysqli_real_escape_string($vConexion, $_SESSION['Usuario_Id']);

//Verificación 
$Titulo = isset($_POST['Titulo'])? mysqli_real_escape_string($vConexion, $_POST['Titulo']) :'';
$Descripcion = isset($_POST['Descripcion'])? mysqli_real_escape_string($vConexion, $_POST['Descripcion']) :'';
$TSolicitud = isset($_POST['Solicitud'])? mysqli_real_escape_string($vConexion, $_POST['Solicitud']) :'';

$fechaSolicitud= '';

//Hacemos el cálculo

if ($TSolicitud == 1){
    $fechaSolicitud = date("Y-m-d H:i:s", strtotime($fecha_Actual . "+ 1 week"));

}else if ($TSolicitud == 2){
    $fechaSolicitud = date("Y-m-d H:i:s", strtotime($fecha_Actual . "+ 3 days"));
}else if ($TSolicitud == 3){
    $fechaSolicitud = date("Y-m-d H:i:s", strtotime($fecha_Actual . "+ 1 days"));
}




//detalles en:  https://elinawebs.com/como-sumar-y-restar-fechas-con-php-con-strtotime-y-date/
?>