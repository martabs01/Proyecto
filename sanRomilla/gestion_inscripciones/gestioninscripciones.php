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
    <title>Gestión inscripciones</title>
    <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
    <link rel="stylesheet" href="../librerias/bootstrap.css">
    <link rel="stylesheet" href="../librerias/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
<?php
//Comprobación de si existe la sesión iniciada por el usuario, si existe muestra la página principal, sino muestra error
if(isset($_SESSION["correo"])){
    echo '
<body>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="gestioninscripciones.php">
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
                <a href="../documentacion/documentacion.php">
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
        <div class="container" id="tabla" >
            <div class="jumbotron jumbotron-fluid">
                <div class=" mt-5 mb-5">
                    <h1>Gestión inscripciones</h1>
                </div>
            </div>
            <div><button id="inscripcion" type="button" class="btn btn-primary mb-5" name="enviar" onclick="mostrarInsertar()"><i class="bi bi-plus"></i>Nueva inscripción</button></div>
            <div id="cuadro_inscripcion1" class="alert alert-warning mb-5" role="alert">El proceso  de inscripción se habilitará cuando el plazo esté abierto.</div>
            <div id="cuadro_inscripcion2" class="alert alert-warning mb-5" role="alert">El proceso  de inscripción ha finalizado.</div>
            <div class="table-responsive" >
                <table id="example" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Inscripción</th>
                        <th>DNI</th>
                        <th>Fecha de nacimiento</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Dorsal</th>
                        <th>Talla Camiseta</th>
                        <th>Categoría</th>
                        <th>Importe Donación</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
        <div id="mostrarInsertar" class="container"></div>
        <div id="editar" class="container"></div>
        <div id="cuadroTramitar" class="container"></div>
        <div id="cuadroTerminos" class="container"></div>
    </main>
    <footer class="mb-5">
        <center>
            <a href="https://www.w3.org/WAI/WCAG2AAA-Conformance"
               title="Explanation of WCAG 2 Level AAA conformance">
                <img height="32" width="88"
                     src="https://www.w3.org/WAI/wcag2AAA"
                     alt="Level AAA conformance,
            W3C WAI Web Content Accessibility Guidelines 2.0">
            </a>
        </center>
    </footer>
    <script src="../librerias/jquery.min.js"></script>
    <script src="../librerias/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="../librerias/datatables.min.js"></script>
    <script src="gestioninscripciones.js"></script>
</body>

';
}else{
    echo '<div class="alert alert-danger" role="alert">
        Debes iniciar sesión  <a href="../login/login.php" class="alert-link">Iniciar sesión</a>  para poder acceder a esta página. 
       </div>';
}?>
</html>