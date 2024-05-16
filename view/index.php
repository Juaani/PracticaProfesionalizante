<?php
require_once '../includes/encabezado.php';
?>
</head>

<body>
    <?php
    require_once '../includes/logo.php';
    ?>

    <div class="container">




        <?php
        require_once '../includes/menu.php';
        ?>




        <!----------------------------------------------------------->
        <!-------------SECCIÓN HISTORIA Y SLIDER----------------->
        <section class="inicio w-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title fw-bold d-flex mb-4">
                            <span class="mx-auto mb-3">¡Bienvenidos a la Escuela N° 313 "Rosario M. Simón"!</span>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col md-12 d-flex text-center">

                        <div class="ms-5">
                            <?php
                            require_once '../includes/slider.php';
                            ?>
                        </div>

                    </div>

                </div>
                <div class="row mt-5 mb-5">

                    <!-------------Presentación------------------>
                    <h3 class="title fw-bold d-flex mb-4"><span class="mx-auto">
                            Presentación</span></h1>
                        <div class="col-md-12 p-3">
                            <p class="text">Somos una institución con 113 años de dedicación y excelencia educativa. Nos enorgullecemos de ser un pilar fundamental en la formación de generaciones de estudiantes en la ciudad San Luis, Argentina. Desde nuestros inicios, nos hemos comprometido con el desarrollo integral de cada alumno, brindando una educación de calidad que fomenta valores, creatividad y conocimiento.</p>
                            <p class="text">Contamos con un equipo de docentes altamente capacitados y comprometidos que trabaja día a día para ofrecer un ambiente de aprendizaje estimulante y enriquecedor, donde cada estudiante pueda alcanzar su máximo potencial.</p>
                            <p class="text">En la Escuela N° 313 "Rosario M. Simón", nos comprometemos a seguir cultivando un ambiente de respeto, colaboración y excelencia, donde cada miembro de nuestra comunidad educativa se sienta valorado y motivado a alcanzar sus metas.</p>
                            <p class="text">¡Te invitamos a explorar nuestra página web y descubrir todo lo que la Escuela N° 313 tiene para ofrecerte!</p>
                        </div>


                </div>
            </div>
        </section>


    </div>

    <?php
    require_once '../includes/pie.php';
    ?>