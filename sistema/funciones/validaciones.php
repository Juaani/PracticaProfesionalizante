<?php
function Validar_Datos() {
    $vMensaje='';
    //Contar la cantidad de caracteres de cada una de las cadenas
    //strlen

    if(strlen($_POST['Titulo']) < 5){
        $vMensaje.='Debes ingresar un título que contenga por lo menos 5 caracters.<br/>';

    }
    if(strlen($_POST['Descripcion']) < 5){
        $vMensaje.='Debes ingresar una descripción que contenga por lo menos 5 caracters.<br/>';

    }
    if(empty($_POST['Solicitud'])){
        $vMensaje.='Debes seleccionar el tipo de solicitud.<br/>';

    }
    return $vMensaje;
}

?>