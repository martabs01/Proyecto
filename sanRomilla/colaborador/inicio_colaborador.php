
<?php
/*
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Página inicial de la sesión de los colaboradores
*/
session_start();//Método que recoge la sesión iniciada
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>
    <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/estilos.css" type="text/css">
</head>
<?php
//Comprobación de si existe la sesión iniciada por el usuario, si existe muestra la página principal, sino muestra error
if(isset($_SESSION["correo"])){

    echo '

<body>
<nav class="main-menu">
    <ul>
        <li>
            <a href="../gestion_inscripciones/gestioninscripciones.php">
                <i class="fa fa-file-text-o fa-2x"></i>
                <span class="nav-text">
                        Inscripciones
                </span>
            </a>
        </li>
        <li>
            <a href="../gestion_donacion/gestiondonaciones.php">
                <i class="fa fa-money fa-2x"></i>
                <span class="nav-text">
                            Fila 0
                </span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-calendar-check-o fa-2x"></i>
                <span class="nav-text">
                        Evento
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
                <i class="fa fa-eur fa-2x"></i>
                <span class="nav-text">
                        Categorías
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
                <i class="fa fa-info fa-2x"></i>
                <span class="nav-text">
                        Documentación
                </span>
            </a>
        </li>
        <li>
            <a href="../modificacion_contrasenia/modificacion_contrasenia.php">
                <i class="fa fa-lock  fa-2x"></i>
                <span class="nav-text">
                        Modificar Contraseña
                </span>
            </a>
        </li>
    </ul>
    <ul class="logout">
        <li>
            <a href="../cerrar_sesion/cerrar_sesion.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">
                        Cerrar Sesión
                </span>
            </a>
        </li>
    </ul>
</nav>
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 pt-3 d-flex justify-content-center">
                    <i class="fa fa-key login-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title" id="panel">
                    PANEL COLABORADOR
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </div>
</main>
</body>
';
}else{
    echo '<div class="alert alert-danger" role="alert">
        Debes iniciar sesión  <a href="../login/login.php" class="alert-link">Iniciar sesión</a>  para poder acceder a esta página. 
       </div>';
}?>
</html>


