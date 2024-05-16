<div>
          <h1><i class="fa fa-th-list"></i> Listados</h1>

          <!-- si es administrador vera este titulo-->
          <!--Admin Sue-->
          <?php if ($_SESSION['Usuario_IdRol'] == 1 ) { ?>
          <p>Listado total de solicitudes</p>
          
          <!---------Renzo--->
          <?php }else if ($_SESSION['Usuario_IdRol'] == 2) { ?>
          <!-- si es usuario normal vera este titulo-->
          <p>Listado de mis solicitudes cargadas</p> 

          <!---------Martin es el soporte Tecnico -->
          <?php }else if ($_SESSION['Usuario_IdRol'] == 3 ||$_SESSION['Usuario_IdRol'] == 4 ) { ?>
          <!-- si es analista o tecnico vera este título--->
          <p>Listado de solicitudes cargadas</p> 

          <?php } ?>


        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Listado</li>
          <li class="breadcrumb-item active"><a href="#">Listado de Solicitudes</a></li>
        </ul>
       
      </div>