<?php
/*
        Alumno: Marta Broncano Suárez
        Asignatura: Proyecto San Romilla
        Curso: 20-21
        Descripción: Modificación de la contraseña de los colaboradores
    */
//Archivo que incluye la validación la modificación de la contraseña
require_once ('validarmodificacioncontrasenia.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificación Contraseña</title>
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
                <a href="#">
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
            </li>
            <li class="has-subnav">
                <a href="../gestion_colaboradores/gestioncolaborador.php">
                    <i class="fa fa-users fa-2x"></i>
                    <span class="nav-text">
                        Colaboradores
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
                <a href="modificacion_contrasenia.php">
                    <i class="fa fa-lock  fa-2x"></i>
                    <span class="nav-text">
                        Modificar contraseña
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
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 login-box">
                    <div class="col-lg-12 pt-3 d-flex justify-content-center">
                        <i class="fa fa-key login-key" aria-hidden="true"></i>
                    </div>
                    <div class="col-lg-12 login-title">
                        MODIFICACIÓN CONTRASEÑA
                    </div>
                    <div class="col-lg-12 login-form">
                        <div class="col-lg-12 login-form">
                            <form id="mensajes" action="#" method="POST">
                                <div class="form-group">
                                    <label class="form-control-label">CONTRASEÑA ACTUAL</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">NUEVA CONTRASEÑA</label>
                                    <input type="password" class="form-control" name="nuevapassword">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">REPETIR NUEVA CONTRASEÑA</label>
                                    <input type="password" class="form-control" name="repetirpassword">
                                </div>
                                <div>';
                                        //Método que para cada resultado devuelto de la validación  muestra un mensaje especifíco
                                        switch (validar()){
                                            case 1://Campos vacíos
                                                echo '<p class="error">*Debes completar los campos del formulario</p>';
                                            break;
                                            case 2://Las contraseñas deben tener mínimo 5 caracteres
                                                echo'<p class="error">*Las contraseñas deben tener mínimo 5 caracteres</p>';
                                                break;
                                            case 3://Las nuevas contraseñas no coinciden
                                                echo'<p class="error">*Las nuevas contraseñas no coinciden</p>';
                                            break;
                                            case 4://Contraseña modificada correctamente
                                                echo'<p class="correcto">*Contraseña modificada correctamente</p>';
                                            break;
                                            case 5://Error en modificación de contraseña
                                                echo'<p class="error">*Error en modificación de contraseña</p>';
                                            break;
                                            case 6://Ninguno de los campos son válidos
                                                echo'<p class="error">*Ninguno de los campos son válidos</p>';
                                            break;
                                            case 7://Contraseña actual incorrecta
                                                echo'<p class="error">*Contraseña actual incorrecta</p>';
                                            break;
                                        }
                                    echo'
                                </div>
                                <div class="row loginbttm p-3">
                                    <div class="col-lg-6 login-btm login-text">
                                        Por favor, rellene el formulario para cambiar la contraseña
                                    </div>
                                    <div class="col-lg-6 login-btm login-button">
                                        <button type="submit" class="btn btn-outline-primary mt-3" name="actualizar">ACTUALIZAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </main>
</body>';
}else{
    echo '<div class="alert alert-danger" role="alert">
        Debes iniciar sesión  <a href="../login/login.php" class="alert-link">Iniciar sesión</a>  para poder acceder a esta página. 
       </div>';
}?>
</html>
