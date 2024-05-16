<?php 

function FechaGuion($FechaBBD){
    //strtotime Procesar cualquier descripción textual de fecha/hora en Inglés convirtiéndola en una timestamp
    //timestamp: especifica la hora y la fecha según el reloj
$NuevaFecha = date('d/m/Y H:i:s', strtotime($FechaBBD));
return $NuevaFecha;
}

$FechaModificada = FechaGuion($FechaBBD);
echo $FechaModificada;
?>