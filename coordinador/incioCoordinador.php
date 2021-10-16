<!--
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Página inicial de la gestión del coordinador
-->
<?php
    echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Title</title>
            <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
            <link rel="stylesheet" href="../estilos/estiloCoordinador.css" type="text/css">
        
        </head>
        <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 login-box">
                    <div class="col-lg-12 login-key pt-3">
                        <i class="fa fa-key login-key" aria-hidden="true"></i>
                    </div>
                    <div class="col-lg-12 login-title">
                        PANEL ADMINISTRADOR
                    </div>
                    <div class="col-lg-3 col-md-2"></div>
                </div>
            </div>
            <nav class="main-menu">
                <ul>
                    <li>
                        <a href="http://justinfarrow.com">
                            <i class="fa fa-calendar-check-o fa-2x"></i>
                            <span class="nav-text">
                                Evento
                            </span>
                        </a>
                    </li>
                    <li class="has-subnav">
                        <a href="#">
                            <i class="fa fa-users fa-2x"></i>
                            <span class="nav-text">
                                Colaboradores
                            </span>
                        </a>
                    </li>
                    <li class="has-subnav">
                        <a href="#">
                            <i class="fa fa-id-card-o fa-2x"></i>
                            <span class="nav-text">
                                Participantes
                            </span>
                        </a>
                    </li>
                    <li class="has-subnav">
                        <a href="#">
                            <i class="fa fa-list-ol fa-2x"></i>
                            <span class="nav-text">
                                Clasificación
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-map-o fa-2x"></i>
                            <span class="nav-text">
                                Recorrido
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-handshake-o fa-2x"></i>
                            <span class="nav-text">
                                Patrocinadores
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-file-text-o fa-2x"></i>
                            <span class="nav-text">
                                Inscripciones
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-eur fa-2x"></i>
                            <span class="nav-text">
                                Ventas
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-info fa-2x"></i>
                            <span class="nav-text">
                                        Documentación
                            </span>
                        </a>
                    </li>
                </ul>
        
                <ul class="logout">
                    <li>
                        <a href="#">
                            <i class="fa fa-power-off fa-2x"></i>
                            <span class="nav-text">
                                Cerrar Sesión
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </body>
        </html>
    ';
?>
