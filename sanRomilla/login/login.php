<?php
/*
Alumno: Marta Broncano Suárez
Asignatura: Proyecto San Romilla
Curso: 20-21
Descripción: Inicio de sesión de los colaboradores
*/
//Archivo que incluye la validación del inicio de sesión
include("validarsesion.php");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="../estilos/estilos.css" type="text/css">
    </head>
    <body>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2"></div>
                    <div class="col-lg-6 col-md-8 login-box">
                        <div class="col-lg-12 pt-3 d-flex justify-content-center">
                            <i class="fa fa-key login-key" aria-hidden="true"></i>
                        </div>
                        <div class="col-lg-12 login-title">
                            PANEL ADMINISTRADOR
                        </div>
                        <div class="col-lg-12 login-form">
                            <div class="col-lg-12 login-form">
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <label class="form-control-label">EMAIL</label>
                                        <input type="email" class="form-control" name="correo">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">CONTRASEÑA</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="row loginbttm ">
                                        <?php
                                            //Método que muestra mensajes según la respuesta recibida
                                            switch (validar()){
                                                case 1://Correo o contraseña incorrectos
                                                    echo '<p class="error">*Correo o contraseña incorrectos</p>';
                                                    break;
                                                case 2://Campos vacíos
                                                    echo '<p class="error">*Debes completar los campos del formulario</p>';
                                                    break;
                                            }
                                        ?>
                                    </div>
                                    <div class="row loginbttm p-3">
                                        <div class="col-lg-7 login-btm login-text">
                                            Por favor, inicie sesión para continuar
                                        </div>
                                        <div class="col-lg-5 login-btm login-button">
                                            <button type="submit" class="btn btn-outline-primary" name="inicio">INICIAR SESIÓN</button>
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
    </body>
</html>
