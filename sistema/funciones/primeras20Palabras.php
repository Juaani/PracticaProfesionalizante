<?php

$Palabras_Array = array();

function PrimerasVeinte($Palabras_Array){
    
    $Cant_Palabras = count($Palabras_Array);

    if ($Cant_Palabras > 20){
        for ($i = 0; $i < 20; $i++){
            echo $Palabras_Array[$i]." ";
        }
    } else {
        echo implode(" ", $Palabras_Array);
    }
}
return PrimerasVeinte($Palabras_Array);
?>
<?php  PrimerasVeinte(explode(' ', $ListadoSolicitud[$i]['DESCRIPCION'])); ?>
<!---EXPLODE: Separa los caracteres de una cadena, mediante uno de sus propios caracteres.
 cada sepeparación es un elemento del Array
 
 El IMPLODE : junta las palabras de array que había separado para contar. -->