<?php 
session_start();

//si tengo vacio mi elemento de sesion me tiene q redireccionar al login.. 
//al cerrarsesion para que mate todo de la sesion y el se encarga de ubicar en el login
if (empty($_SESSION['Usuario_Nombre']) ) {
    header('Location: cerrarsesion.php');
    exit;
}

require_once 'header.inc.php'; ?>
 
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
    <?php
  require_once 'paneladmin.inc.php';
  ?>
    </main>

    <?php
  require_once 'footer.inc.php';
  ?>

  