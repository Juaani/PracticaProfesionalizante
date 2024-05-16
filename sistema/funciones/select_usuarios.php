<?php
function Listar_Usuarios($vConexion) {

    $Listado=array();

    //1) genero la consulta que deseo
    $SQL = "SELECT U.Id, U.Nombre, U.Apellido, U.Email, R.Rol as Rol, U.Activo
        FROM usuarios U, Roles R
        WHERE U.IdRol=R.Id 
        ORDER BY U.Apellido, U.Nombre";

    //2) a la conexion actual le brindo mi consulta, y el resultado lo entrego a variable $rs
     $rs = mysqli_query($vConexion, $SQL);
        
     //3) el resultado deberá organizarse en una matriz, entonces lo recorro
     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['Id'];
            $Listado[$i]['NOMBRE'] = $data['Nombre'];
            $Listado[$i]['APELLIDO'] = $data['Apellido'];
            $Listado[$i]['EMAIL'] = $data['Email'];
            $Listado[$i]['CLAVE'] = $data['Clave'];
            $Listado[$i]['ROL'] = $data['IdRol'];
            $Listado[$i]['ULTIMAFECHAACCESO'] = $data['UltimaFechaAcceso'];
            $Listado[$i]['ACTIVO'] = $data['Activo'];
            $i++;
    }


    //devuelvo el listado generado en el array $Listado. (Podra salir vacio o con datos)..
    return $Listado;

}

function EncontrarUsuario($vIDUsuario, $vConexion){
    $Usuario=array();
    
    $SQL="SELECT U.*,
                R.Id as Id_Rol, R.Denominacion as Rol
     FROM Usuarios U, Roles R
     WHERE U.Id_usuario = $vIDUsuario
     AND U.IdRol=R.Id";

    $rs = mysqli_query($vConexion, $SQL);
        
    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $Usuario['NOMBRE']     = $data['Nombre'];
        $Usuario['APELLIDO']   = $data['Apellido'];
        $Usuario['EMAIL']      = $data['Email'];
        $Usuario['ROL']      = $data['Rol'];
       
        if (empty( $data['Imagen'])) {
            $data['Imagen'] = 'user.png'; 
        }
        $Usuario['IMG']        = $data['Imagen'];
        $Usuario['ACTIVO']     = $data['Activo'];
        //agregados
        $Usuario['ID']              = $data['Id'];
        $Usuario['ID_ROL']    = $data['IdRol'];
       
        
    }
    return $Usuario;
}

function Modificar_Acceso_Usuario($vIdUsuario, $vActivo, $vConexion){
    
    $SQL="UPDATE Usuarios SET Activo = $vActivo WHERE Id = $vIdUsuario";
    
    if (!mysqli_query($vConexion, $SQL)) {
        return false;
    }
    
    return true;
}

?>