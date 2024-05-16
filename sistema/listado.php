<?php 
session_start();

//si tengo vacio mi elemento de sesion me tiene q redireccionar al login.. 
//al cerrarsesion para que mate todo de la sesion y el se encarga de ubicar en el login
if (empty($_SESSION['Usuario_Nombre']) ) {
    header('Location: cerrarsesion.php');
    exit;
}


//voy a necesitar la conexion: incluyo la funcion de Conexion.
require_once 'funciones/conexion.php';

//genero una variable para usar mi conexion desde donde me haga falta
//no envio parametros porque ya los tiene definidos por defecto
$MiConexion = ConexionBD();

//Ahora llamo a la función que muestra las primeras veinte palabras
require_once 'funciones/primeras20palabras.php';

require_once 'funciones/FechaGuion.php';
//ahora voy a llamar el script con la funcion que genera mi listado
require_once 'funciones/select_general.php';

//voy a ir listando lo necesario para trabajar en este script: 
$ListadoSolicitud = Listar_Solicitud($MiConexion);
$CantidadSolicitud = count($ListadoSolicitud);

if (empty($ListadoSolicitud)) {
    $_SESSION['Mensaje']="No tienes consultas registradas.";
    $_SESSION['Estilo']='info';
}


?>
  
  <?php
  require_once 'header.inc.php';
  ?>
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.php">Mi Panel</a>
      <?php 
    require_once 'menuderecho.inc.php';
    ?>
    </header>
    <!-- Sidebar menu-->
    <?php
  require_once 'menulateral.inc.php';
  ?>
    <!-- fin Sidebar menu-->
    <main class="app-content">
    <div class="app-title">
    <?php
  require_once 'menu.inc.php';
  ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            
          <h3 class="tile-title">Solicitudes (Nro Total=<?php echo $CantidadSolicitud ?>)</h3>
          <?php if (!empty($_SESSION['Mensaje'])) { ?>
              <div class="alert alert-<?php echo $_SESSION['Estilo']; ?> alert-dismissable">
              <?php echo $_SESSION['Mensaje'] ?>
           </div>
          <?php } ?>
          
            <?php if (!empty($ListadoSolicitud)) { ?>
            <div class="table-responsive">
              <table class="table">


                <thead>
                  <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Registro</th>
                    <th>Fecha estimada</th>
                    <th>Solicitante</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                
                    <!-------Insertar código PHP --> 
                    <!--------que diga el tipo de color segun el tipo de solicitud ---->
                <?php for ($i=0; $i<$CantidadSolicitud; $i++) { ?>


                   <!---La solicitud de tipo 1 son Desarrollo de nuevas funcionalidades---->
                  <!------------Tabla color info---------------->
                  <?php if ($ListadoSolicitud[$i]['TIPOSOL'] ==1){
                                  $Estilo = 'table-info';

                        //La solicitud de tipo 2 son Reporte de Errores
                        //Tabla color warning
                            }elseif($ListadoSolicitud[$i]['TIPOSOL'] == 2){
                                  $Estilo = 'table-warning';

                           //La solicitud de tipo  son Soporte Técnico
                        //Tabla color danger       
                            }elseif($ListadoSolicitud[$i]['TIPOSOL'] == 3){
                                    $Estilo = 'table-danger';
                        }?>

                      <tr class="<?php echo $Estilo; ?>" >
                            <!---Insertar Código PHP -->
                          <td><?php echo $i+1; ?></td>
                          <td><?php echo $ListadoSolicitud[$i]['TITULO']; ?></td>
                          <td><?php  PrimerasVeinte(explode(' ', $ListadoSolicitud[$i]['DESCRIPCION'])); ?></td>
                          <td><?php echo $ListadoSolicitud[$i]['DENOMINACIONSOL']; ?></td>
                          <td><?php echo FechaGuion($ListadoSolicitud[$i]['REGISTRO']); ?></td>
                          <td><?php echo FechaGuion($ListadoSolicitud[$i]['FECHASOLICITUD']); ?></td>
                          <td><?php echo $ListadoSolicitud[$i]['ID_USUARIO']; ?></td>
                          <td>
                            <?php 
                               //el usuario Admin puede 
                              if ($_SESSION['Usuario_IdRol'] == 1 ) { ?>
                              <!-- eliminar la consulta -->
                              <a href="eliminar_solicitud.php?ID_REGISTRO=<?php echo $ListadoSolicitud[$i]['ID']; ?>" 
                              onclick="if (confirm('Confirma eliminar esta consulta?')) {return true;} else {return false;}">
                              <i class="pp-menu__icon fa fa-cog">Eliminar...</i></a>
                              <!-- ver solamente la consulta -->
                              <a href="#"><i class="fa fa-info">Ver detalles...</i></a>
                            <?php } ?>        

                  
                            <?php 

                                //el usuario Suscriptor Básico puede :
                                if ($_SESSION['Usuario_IdRol'] == 2 ) {?>
                                  <!-- eliminar la solicitud -->
                                  <a href="eliminar_solicitud.php?ID_REGISTRO=<?php echo $ListadoSolicitud[$i]['ID']; ?>" 
                                  onclick="if (confirm('Confirma eliminar esta consulta?')) {return true;} else {return false;}">
                                  
                                  <i class="pp-menu__icon fa fa-cog">Eliminar...</i></a>
                                                    
                                    <!-- modificar la solicitud -->
                                    <a href="#" ><i class="fa fa-pencil">Modificar... </i></a> 
                            <?php } ?>
                            <?php 
                                     //el usuario Abogado Asesor puede :
                                    if ($_SESSION['Usuario_IdRol'] == 3 || $_SESSION['Usuario_IdRol'] == 4  ) { ?>
                                    <a href="#" ><i class="fa fa-sign-in">Resolver...</i></a>
                                    <a href="#" ><i class="fa fa-info">Ver detalles...</i></a>
                            <?php } ?>
                        
                    
                          </td>
                        </tr>
                  
                        <?php } ?> 
                </tbody>
              </table>
            </div>
           <?php } ?>
          </div>
        </div>
        <div class="clearfix"></div>
        
      </div>
    </main>
    <?php
      require_once 'footer.inc.php';
      ?>