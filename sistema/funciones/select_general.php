<?php
function Listar_General($vConexion , $vTabla) {

    $Listado=array();

    //1) genero la consulta que deseo con la tabla que especifico
    $SQL = "SELECT * FROM $vTabla ORDER BY Denominacion"; //ordeno por el campo denominacion

    //2) a la conexion actual le brindo mi consulta, y el resultado lo entrego a variable $rs
    $rs = mysqli_query($vConexion, $SQL);
        
     //3) el resultado deberá organizarse en una matriz, entonces lo recorro
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['Id'];
            $Listado[$i]['NOMBRE'] = $data['Denominacion'];
            $i++;
    }


    //devuelvo el listado generado en el array $Listado. (Podra salir vacio o con datos)..
    return $Listado;

}


//Insertamos una solicitud
function Registrar_Solicitud($vConexion) {

   require_once 'test.php';

    $SQL_Insert="INSERT INTO Registros (Titulo, Descripcion, IdSolicitud,
    Registro, FechaSolicitud, IdUsuario)
    VALUES ('{$_POST['Titulo']}' , '{$_POST['Descripcion']}'
    , {$_POST['Solicitud']}, NOW(), '$fechaSolicitud','{$_SESSION['Usuario_Id']}' )";
    //en la base es un valor tinyint que vale:
        //respondida = 0 --> Sin responder
        //respondida = 1 --> Respondida
        //por defecto se graba en cero

    if (!mysqli_query($vConexion, $SQL_Insert)) {
        //si surge un error, finalizo la ejecucion del script con un mensaje
        die('<h4>Error al intentar insertar la consulta.</h4>');
    }

    return true;
}

//Seleccionamos las solicitudes de la bade de datos

function Listar_Solicitud($vConexion) {
    $Listado = array();

    // 1) genero la consulta que deseo
    $RolSolicitud = mysqli_real_escape_string($vConexion, $_SESSION['Usuario_IdRol']);
    // ojo que según el nivel de usuario debo ver cierto listado.
    // Si soy admin o asesor, veré todas
    if($RolSolicitud == 1){
        $SQL = "SELECT USU.Id, USU.Nombre, USU.Apellido, REG.Id, REG.Titulo, REG.Descripcion, REG.IdUsuario,
        Registro,
        FechaSolicitud, 
        REG.IdSolicitud,
        ROL.Denominacion,
        SOL.Id,
        SOL.Denominacion as NombreSolicitud

        FROM usuarios USU, registros REG, roles ROL, solicitud SOL 
        WHERE USU.Id = REG.IdUsuario
        AND USU.IdRol = ROL.Id
        AND REG.IdSolicitud = SOL.Id

        ORDER BY REG.Registro ASC";
     //Si soy usuario normal veré las solicitudes de las personas de usuario normal
    } else if($RolSolicitud == 2){
        $SQL = "SELECT  USU.Id, USU.Nombre, USU.Apellido, REG.Id, REG.Titulo, REG.Descripcion, REG.IdUsuario,
         Registro,
        FechaSolicitud, 
        REG.IdSolicitud,
        ROL.Denominacion,
        SOL.Id,
        SOL.Denominacion as NombreSolicitud
        FROM usuarios USU, registros REG, roles ROL, solicitud SOL 
        WHERE USU.Id = REG.IdUsuario
        AND USU.IdRol = ROL.Id
        AND ROL.Id = 2
        AND SOL.Id = REG.IdSolicitud

        ORDER BY REG.Registro ASC";
       //Los analistas veran las 
    }elseif($RolSolicitud == 3){
        $SQL = "SELECT  USU.Id, USU.Nombre, USU.Apellido, REG.Id, REG.Titulo, REG.Descripcion, REG.IdUsuario,
        Registro,
       FechaSolicitud, 
        REG.IdSolicitud,
        ROL.Denominacion,
        SOL.Id,
        SOL.Denominacion as NombreSolicitud
        FROM usuarios USU, registros REG, roles ROL, solicitud SOL 
        WHERE USU.Id = REG.IdUsuario
        AND USU.IdRol = ROL.Id
        AND REG.IdSolicitud = 3
        AND SOL.Id = REG.IdSolicitud

        ORDER BY REG.Registro ASC";

        

    } else if($RolSolicitud == 4){
        $SQL = "SELECT  USU.Id, USU.Nombre, USU.Apellido, REG.Id, REG.Titulo, REG.Descripcion, REG.IdUsuario,
        Registro,
        FechaSolicitud, 
        REG.IdSolicitud,
        ROL.Denominacion,
        Sol.Id,
        SOL.Denominacion as NombreSolicitud
        FROM usuarios USU, registros REG, roles ROL, solicitud SOL 
        WHERE USU.Id = REG.IdSolicitud
        AND USU.IdRol = ROL.Id
        AND REG.IdSolicitud in( 2, 1)
        AND SOL.Id = REG.IdSolicitud

        ORDER BY REG.Registro ASC";

    }
  

    
    
    // 2) a la conexión actual le brindo mi solicitud, y el resultado lo entrego a la variable $rs
    $rs = mysqli_query($vConexion, $SQL);

    // 3) el resultado deberá organizarse en una matriz, entonces lo recorro
    if ($rs === false) {
        die("Error en la solicitud: " . mysqli_error($vConexion));
    }

    $i = 0;
    while ($data = mysqli_fetch_array($rs)) {
        $Listado[$i]['ID'] = $data['Id'];
        $Listado[$i]['TITULO'] = $data['Titulo'];
        $Listado[$i]['DESCRIPCION'] = $data['Descripcion'];
        $Listado[$i]['TIPOSOL'] = $data['Id'];
        $Listado[$i]['DENOMINACIONSOL'] = $data['NombreSolicitud'];
        $Listado[$i]['REGISTRO'] = $data['Registro'];
        $Listado[$i]['FECHASOLICITUD'] = $data['FechaSolicitud'];
        $Listado[$i]['ID_USUARIO'] = $data['Nombre'] . ' ' . $data['Apellido'];
     
        $i++;

    }

    // devuelvo el listado generado en el array $Listado. (Podrá salir vacío o con datos)..
    return $Listado;
}

function Eliminar_Solicitud($vConexion , $vIdRegistros) {
    //voy a permitir eliminar si :

    //soy admin 
    if ($_SESSION['Usuario_IdRol'] == 1 ) {
        $SQL_MiSolicitud="SELECT Id FROM Registros
                        WHERE Id = $vIdRegistros ";
    }else {

        
    //o soy dueño de la consulta
        $SQL_MiSolicitud="SELECT Id FROM Registros 
                        WHERE Id = $vIdRegistros AND IdUsuario = ".$_SESSION['Usuario_Id'];
    }
    
    $rs = mysqli_query($vConexion, $SQL_MiSolicitud);
        
    $data = mysqli_fetch_array($rs);

    if (!empty($data['Id']) ) {
        //si se cumple todo, entonces elimino:
        mysqli_query($vConexion, "DELETE FROM registros WHERE Id = $vIdRegistros");
        return true;

    }else {
        return false;
    }
    
}

function Datos_Solicitud($vConexion , $vIdSolicitud) {
    $DatosSolicitud  =   array();
    //me aseguro que la consulta exista y sea dueño el usuario logueado
    $SQL = "SELECT * FROM registros
            WHERE Id = $vIdSolicitud AND IdUsuario = {$_SESSION['Usuario_Id']} ";

    $rs = mysqli_query($vConexion, $SQL);

    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $DatosSolicitud['ID_REGISTRO'] = $data['Id'];
        $DatosSolicitud['TITULO'] = $data['Titulo'];
        $DatosSolicitud['DESCRIPCION'] = $data['Descripcion'];
        $DatosSolicitud['TIPOSOL'] = $data['IdSolicitud'];
        $DatosSolicitud['REGISTRO'] = $data['Registro'];
        $DatosSolicitud['FECHASOLICITUD'] = $data['FechaSolicitud'];
        $DatosSolicitud['ID_USUARIO'] = $data['IdUsuario'];
    }
    return $DatosSolicitud;

}

function Modificar_Solicitud($vConexion) {
    $SQL_MiSolicitud="UPDATE Registros 
                    SET Titulo = '{$_POST['Titulo']}' ,
                        Descripcion = '{$_POST['Descripcion']}' ,
                        IdSolicitud   = {$_POST['Solicitud']}, 
                        Registro   = {$_POST['Registro']}
                        IdUsuario   = {$_POST['IdUsuario']}
                        WHERE Id = {$_POST['IdRegistro']} ";

    if ( mysqli_query($vConexion, $SQL_MiSolicitud) != false) {
        return true;
    }else {
        return false;
    }
    
}

//Preguntar si los intentos son mayor a 3 

function ActualizarIntento($vConexion) {
    $SQL_MiIntento="UPDATE usuarios
                    SET intentos = intentos+1; 
                    
                        WHERE Id = {$_POST['email']} ";

    if ( mysqli_query($vConexion, $SQL_MiIntento) != false) {
        return true;
    }else {
        return false;
    }
    
}
/*function Datos_Solicitud_Para_Resolver($vConexion , $vIdSolicitud) {
    $DatosSolicitud  =   array();
    $SQL = "SELECT REG.Id as IdRegistro,
            REG.Titulo , 
            REG.Descripcion,
            REG.Registro,
            SOL.Denominacion Solicitud_Nombre, 
            
            CONCAT(USU.Apellido, ',', USU.Nombre ) as Usuario_Nombre
            FROM registros REG, solicitud SOL,  usuarios USU
            WHERE REG.IdSolicitud = SOL.Id AND 
                REG.IdUsuario = USU.Id AND
                REG.Id = $vIdSolicitud ";

    $rs = mysqli_query($vConexion, $SQL);

    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $DatosSolicitud['ID_REGISTRO']   = $data['Id'];
        $DatosSolicitud['TITULO']        = $data['Titulo'];
        $DatosSolicitud['DESCRIPCION']      = $data['Descripcion'];
        $DatosSolicitud['TIPOSOL']     = $data['Solicitud_Nombre'];
        $DatosSolicitud['REGISTRO']   = $data['Registro'];
        $DatosSolicitud['FECHASOLICITUD']     = $data['FechaSolicitud'];
        //Consultar
        $DatosSolicitud['IDUSUARIO']   = $data['Usuario_Nombre'];

    }
    return $DatosSolicitud;

}*/

/*function Resolver_Consulta($vConexion) {
   $SQL_MiConsulta="UPDATE Consultas 
                    SET Respondida          = 1,
                        Resolucion          = '{$_POST['Resolucion']}' ,
                       FechaResolucion     = NOW(),
                        IdUsuarioResolucion = {$_SESSION['Usuario_Id']}
                        WHERE Id            = {$_POST['IdConsulta']} ";

    if ( mysqli_query($vConexion, $SQL_MiConsulta) != false) {
       return true;
    }else {
      return false;
  }
}*/

/*function Datos_Consulta_Completa($vConexion , $vIdConsulta) {
    $DatosConsulta  =   array();
    $SQL = "SELECT CON.Id as IdConsulta,
            CON.Titulo , 
            CON.TextoConsulta,
            DATE_FORMAT( CON.FechaCarga, '%d/%m/%Y %H:%i:%s' ) FechaCarga,
            CON.Resolucion,
            DATE_FORMAT( CON.FechaResolucion, '%d/%m/%Y %H:%i:%s' ) as FechaResolucion,
            CAT.Denominacion Categoria_Nombre, 
            PRI.Denominacion Prioridad_Nombre,
            CONCAT(USU.Apellido, ',', USU.Nombre ) as Usuario_Nombre,
            CONCAT(USURES.Apellido, ',', USURES.Nombre ) as Resolutor_Nombre
            FROM consultas CON, categorias CAT, prioridades PRI, usuarios USU, usuarios USURES
            WHERE CON.IdCategoria = CAT.Id AND 
                CON.IdPrioridad = PRI.Id  AND
                CON.IdUsuarioCarga = USU.Id AND
                CON.IdUsuarioResolucion = USURES.Id  AND
                CON.Id = $vIdConsulta ";

    $rs = mysqli_query($vConexion, $SQL);

    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $DatosConsulta['ID_CONSULTA']   = $data['IdConsulta'];
        $DatosConsulta['TITULO']        = $data['Titulo'];
        $DatosConsulta['CONSULTA']      = $data['TextoConsulta'];
        $DatosConsulta['FECHA_CARGA']   = $data['FechaCarga'];
        $DatosConsulta['RESOLUCION']    = $data['Resolucion'];
        $DatosConsulta['FECHA_RESOLUCION']    = $data['FechaResolucion'];
        $DatosConsulta['CATEGORIA']     = $data['Categoria_Nombre'];
        $DatosConsulta['PRIORIDAD']     = $data['Prioridad_Nombre'];
        $DatosConsulta['USUARIO_CARGA']   = $data['Usuario_Nombre'];
        $DatosConsulta['USUARIO_RESOLUTOR']   = $data['Resolutor_Nombre'];

    }
    return $DatosConsulta;

}*/
?>