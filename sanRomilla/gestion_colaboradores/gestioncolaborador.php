
<?php
/*
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Página inicial de la gestión de los colaboradores*/
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestión colaboradores</title>
    <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
    <link rel="stylesheet" href="../librerias/bootstrap.css">
    <link rel="stylesheet" href="../librerias/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
<?php
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
                <a href="http://justinfarrow.com">
                    <i class="fa fa-calendar-check-o fa-2x"></i>
                    <span class="nav-text">
                            Evento
                    </span>
                </a>
            </li>';
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
                <a href="#">
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
        <div id="tabla" class="container" >
            <div class="jumbotron jumbotron-fluid">
                <div class="mt-5 mb-5">
                    <h1>Gestión colaboradores</h1>
                </div>
            </div>
            <div><button type="button" class="btn btn-primary mb-5" name="enviar" onclick="mostrarInsertar()"><i class="bi bi-plus"></i>Nuevo colaborador</button></div>
            <div class="m-0">
                <table id="example" class="table table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
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
        <div id="eliminar" class="container"></div>
    </main>
    <script src="../librerias/jquery.min.js"></script>
    <script src="../librerias/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="../librerias/datatables.min.js"></script>
    <script src="gestioncolaborador.js"></script>
</body>

';
}else{
echo '<div class="alert alert-danger" role="alert">
        Debes iniciar sesión  <a href="../login/login.php" class="alert-link">Iniciar sesión</a>  para poder acceder a esta página. 
       </div>';
}?>
</html>

