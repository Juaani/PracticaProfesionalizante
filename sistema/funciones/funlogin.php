

<?php 
function DatosLogin($vUsuario, $vClave,  $vConexion){

    //Creo una variable de tipo array que me va a levantar la bolsa que me venga de BD
    $Usuario=array();//Este array levanta la info de la Base de daros en caso de que exista usuario y clave o mando en le box del formulario
    

    //Creo una variable $SQL y le almaceno la consulta que le hago a la BD
    //agrego la función de MD5 para que se encripte y compare con lo de la tabla
    $SQL="SELECT U.Id, U.Nombre, U.Apellido, U.IdRol, U.Imagen, U.UltimaFechaAcceso, U.Activo, 
    R.Denominacion as NombreRol
     FROM Usuarios U, Roles R
     WHERE Email='$vUsuario' AND Clave = MD5('$vClave') 
     AND U.IdRol = R.Id ";


     
    $rs = mysqli_query($vConexion, $SQL);
     
    //Creamos una variable de tipo $data y le almacenamos 
    //la función mysqli_fetch_array que tiene como parámetro la funcion mysqli_query
  //Trae los registros de la base de datos
    $data = mysqli_fetch_array($rs) ;

    //Consulto que la devolución de la base de datos no está vacía
    if (!empty($data)) {

        //Le asigno cada uno de los valores traídos de la base de datos
        //A los elementos de mi array
        $Usuario['ID'] = $data['Id'];
        $Usuario['NOMBRE'] = $data['Nombre'];
        $Usuario['APELLIDO'] = $data['Apellido'];
        $Usuario['IDROL'] = $data['IdRol'];
        $Usuario['IMG'] = $data['Imagen'];
        $Usuario['DENOM_ROL'] = $data['NombreRol'];
    

        
        //Consulto si el campo imagen está vacío y le asingo una imagen
        if (empty( $data['Imagen'])) {
            $data['Imagen'] = 'user.jpeg'; 
        }
        $Usuario['IMG'] = $data['Imagen'];
        $Usuario['FECHAULTIMOACCESO'] = $data['UltimaFechaAcceso'];
        $Usuario['ACTIVO'] = $data['Activo'];

        
    }
    return $Usuario;
}

?>