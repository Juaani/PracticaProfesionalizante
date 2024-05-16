<?php
//Inicio sesión
session_start();
//Si tengo vacío mi elemento de sesión me tiene que redireccionar al login
//al cerrar sesión para que mate todo de la sesión y el que se encarga de ubicar en el login
if(empty($_SESSION['Usuario_Nombre'])){
    header('Location: cerrarsesion.php');
    exit;
}

//voy a necesitar la conexion: incluyo la funcion de Conexion
require_once 'funciones/conexion.php';


//Genero una variable para usar mi conexion desde donde me haga falta
//no envio parámentros porque ya los tengo definidos por defecto
$MiConexion = ConexionBD(); 

//Ahora llamo el script gral para usar las funciones necesarias
require_once 'funciones/select_general.php';
require_once 'funciones/validaciones.php';


//Genero el listado de tipos de solicitudes
//Apunta a la tabla solicitud
$ListadoTipoSolicitud = Listar_General($MiConexion, 'Solicitud');
$CantidadTipoSolicitud = count($ListadoTipoSolicitud);

//Advertimos al usuario que debe ingresar datos en cada tabla

$Mensaje='';
$Estilo='';

if(!empty($_POST['BtnRegSolicitud'])){
    $Mensaje=Validar_Datos();
    $Estilo='alert-danger';
    if(empty($Mensaje)){
        if(Registrar_Solicitud($MiConexion) != false){
            $Mensaje='Solicitud almacenada!';
            $Estilo='alert-success';
            $_POST = array();
        }
    }
}
?>
<?php
require_once 'header.inc.php';
?>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.php">Mi Panel</a>
        <!-- Sidebar toggle button-->
        <!-- Navbar Right Menu-->
        <?php
        require_once 'menuderecho.inc.php';
        ?>
    </header>
    <!-- Sidebar menu-->

    <?php
    require_once 'menulateral.inc.php';
    ?>
    </header>
    <!-- fin Sidebar menu-->
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Registra aqui tu solicitud</h1>
                <p>Detalla lo mas que puedas para que un encargado pueda asesorarte.</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item"><a href="#">Registro</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <!---MENSAJES --->
                    <!---------------->
                    <!----Copiar el código de insertar consultas---->

                    <h3 class="tile-title">Ingresa los datos solicitados</h3>
                   
                    <!---<div class="bs-component">
                        <div class="alert alert-dismissible alert-success">
                            <strong>Solicitud almacenada!</strong>
                        </div>
                    </div> -->
                    <div class="bs-component">
                        <div class="alert alert-dismissible alert-info">
                            <strong>Los campos con <i class="fa fa-asterisk" aria-hidden="true"></i> son
                                obligatorios</strong>
                        </div>
                    </div>
                    <div class="bs-component">
                   <div class="alert alert-dismissible <?php echo $Estilo; ?>">
                            <strong><?php echo $Mensaje; ?>.</strong>
                        </div>
                    </div>
                    <div class="tile-body">


                        
                        <form role="form" method="post">
                        <?php if (!empty($_SESSION['Mensaje'])) { ?>
                                        <div class="alert alert-<?php echo $_SESSION['Class_Mensaje']; ?> ">
                                        <?php echo $_SESSION['Mensaje']; ?>
                                        </div>
                                        <?php } ?>
                        
                            <div class="form-group">
                                <label class="control-label">Título</label> <i class="fa fa-asterisk" aria-hidden="true"></i>
                                <input name="Titulo" id="titulo" class="form-control" value="<?php echo !empty($_POST['Titulo']) ? $_POST['Titulo'] : ''; ?>" >
                            </div>


                            <!--------------------------------->
                            <!--------------TEXTAREA------------>
                            <div class="form-group">
                                <label class="control-label">Descripción de solicitud <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                                <textarea name="Descripcion" id="descripcion"  class="form-control" rows="4"
                                    placeholder="Ingresa los detalles..."><?php echo !empty($_POST['Descripcion']) ? $_POST['Descripcion'] : ''; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Tipo de solicitud</label> <i class="fa fa-asterisk" aria-hidden="true"></i>
                    
                                <div class="form-check">
                                <?php
                                                $Checked='';
                                                for ($i=0; $i<$CantidadTipoSolicitud; $i++) { 
                                                    $Checked = (!empty($_POST['Solicitud']) && $_POST['Solicitud'] == $ListadoTipoSolicitud[$i]['ID'] )?'checked':''; ?>
                                                    <label class="radio_inblock">
                                                    <input  type="radio" name="Solicitud" id="solicitud"  <?php echo $Checked; ?> 
                                                        value="<?php echo $ListadoTipoSolicitud[$i]['ID']; ?>" />
                                                        <?php echo $ListadoTipoSolicitud[$i]['NOMBRE']; ?>
                                                    </label>
                                                </br>
                                                <?php }?>
                           


                                
                                </div>

                            </div>
                            <!--
                            <div class="form-group">
                            <label class="control-label">Puedes subir una captura de pantalla</label>
                            <input class="form-control" type="file">
                            </div>
                            -->
                            <div class="tile-footer">

                                <!--------------------------------->
                                <!--------------BOTONES------------>

                                <button type="submit" class="btn btn-primary" type="button" value="Registrar" name="BtnRegSolicitud"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-secondary" href="index.html"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>

        </div>
    </main>
      <?php 
      $_SESSION['Mensaje'] ='';
      $_SESSION['Class_Mensaje'] ='';
    require_once 'footer.inc.php';
    ?>