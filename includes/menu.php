<!-------------------------------------------------------->
        <!--------------------Fila del menú de navegación---------------------->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISINSC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../view/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <button id="ofertasModalBtn" class="nav-link" style="cursor: pointer;">Oferta Educativa</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../view/historia.php">Historia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../view/noticias.php">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <button id="contactoModalBtn" class="nav-link" style="cursor: pointer;">Contacto</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../sistema/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal para Ofertas Educativas -->
    <div class="modal fade" id="ofertasModal" tabindex="-1" aria-labelledby="ofertasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ofertasModalLabel">Oferta Educativa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido de Ofertas Educativas -->
                   <p>Nuestra Institución cuenta con los siguientes niveles educativos:</p>
                   <ul>
                    <li>Nivel Inicial</li>
                    <li>Nivel Primario</li>
                    <li>Nivel Secundario
                        <ul>
                            <li>Ciclo Básico</li>
                            <li>Ciclo Orientado</li>
                        </ul>
                    </li>
                   </ul>
                   <hr>
                   <p>La oferta académica que brinda es:<strong>"Bachillerato en Informática"</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Contacto -->
    <div class="modal fade" id="contactoModal" tabindex="-1" aria-labelledby="contactoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactoModalLabel">Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido de Contacto -->
                    <div class="col-md-12">
                    <div class="mb-3">
                        
                        <label for="exampleFormControlInput1" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Ingrese su comentario</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>