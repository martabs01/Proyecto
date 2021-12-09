<?php
/*
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Página inicial de la gestión de inscripciones
*/
session_start(); //Método que recoge la sesión iniciada
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reglamento Carrera San Romilla</title>
    <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
    <link rel="stylesheet" href="../librerias/bootstrap.css">
    <link rel="stylesheet" href="../librerias/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
<?php
//Comprobación de si existe la sesión iniciada por el usuario, si existe muestra la página principal, sino muestra error
if(isset($_SESSION["correo"])){
    echo '
<body>
<nav class="main-menu me-5">
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
            <a href="http://justinfarrow.com">
                <i class="fa fa-calendar-check-o fa-2x"></i>
                <span class="nav-text">
                            Evento
                    </span>
            </a>
        </li>';
        //Comprobación del tipo de colaborador que ha iniciado sesión, si es coordinador(admin) mostramos la opción de gestión de colaboradores
        if($_SESSION["tipo"]=='a'){
        echo '<li class="has-subnav">
        <a href="../gestion_colaboradores/gestioncolaborador.php">
            <i class="fa fa-users fa-2x"></i>
            <span class="nav-text">
                        Colaboradores
                    </span>
        </a>
    </li>';
        }
        echo'
        <li class="has-subnav">
            <a href="#">
                <i class="fa fa-list-ol fa-2x"></i>
                <span class="nav-text">
                            Clasificación
                    </span>
            </a>
        </li>
        <li>
            <a href="../gestion_donacion/gestiondonaciones.php">
                <i class="fa fa-list-ul fa-2x"></i>
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
<main class="mb-5" id="filtro">
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class=" mt-5 mb-5">
                <h1>Reglamento Carrera San Romilla</h1>
            </div>
        </div>
        <div>
            <embed src="reglamento.pdf" width="100%" height="1700px"/>
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

