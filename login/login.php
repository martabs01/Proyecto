<!--
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Inicio de sesión de los colaboradores
-->
<?php
    require_once '../basedatos/operacionesBBDD.php';
    $objeto=new Consulta();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="../estilos/estiloLogin.css" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key pt-3">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    PANEL ADMINISTRADOR
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <?php
                            if(!isset($_POST["inicio"])){
                                echo '
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <label class="form-control-label">EMAIL</label>
                                        <input type="text" class="form-control" name="correo">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">CONTRASEÑA</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div><a href="../modificaciónContrasenia/modicicaciónpassword.php" class="link-danger">Modificar password</a></div>
                                    <div class="row loginbttm p-3">
                                        <div class="col-lg-7 login-btm login-text">
                                            Por favor, inicie sesión para continuar
                                        </div>
                                        <div class="col-lg-5 login-btm login-button">
                                            <button type="submit" class="btn btn-outline-primary" name="inicio">INICIAR SESIÓN</button>
                                        </div>
                                    </div>
                                </form>';
                            }else{

                                if ($objeto->inicioSesion($_POST["correo"], $_POST["password"]) == true){
                                    session_start();
                                    $_SESSION["correo"]=$_POST["correo"];
                                    $sql = "SELECT * FROM colaborador WHERE correo='".$_POST["correo"]."'";
                                    echo $sql;
                                    $objeto->hacerConsultas($sql);
                                    if($objeto->comprobarSelect()>0){
                                        $fila=$objeto->extraerFilas();
                                        $tipo=$fila["tipo"];
                                        if($tipo=='c'){
                                            header('Location: ../colaborador/inicioColaboradores.php');
                                        }else{
                                            header('Location: ../coordinador/incioCoordinador.php');
                                        }
                                    }
                                }else{
                                    if(empty($_POST["correo"] && $_POST["password"]) ){
                                        echo '
                                             <form action="#" method="POST">
                                                <div class="form-group">
                                                    <label class="form-control-label">EMAIL</label>
                                                    <input type="text" class="form-control" name="correo">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label">CONTRASEÑA</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <div><a href="../modificaciónContrasenia/modicicaciónpassword.php" class="link-danger">Modificar contraseña</a></div>
                                                <div class="row loginbttm p-3">
                                                    <div class="col-lg-8 login-btm login-text">
                                                        <span>Debes rellenar los campos del formulario</span>
                                                    </div>
                                                    <div class="col-lg-4 login-btm login-button">
                                                        <button type="submit" class="btn btn-outline-primary" name="inicio">INICIAR SESIÓN</button>
                                                    </div>
                                                </div>
                                            </form>
                                         ';
                                    }else{
                                        echo '
                                             <form action="#" method="POST">
                                                <div class="form-group">
                                                    <label class="form-control-label">EMAIL</label>
                                                    <input type="text" class="form-control" name="correo">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label">CONTRASEÑA</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <div><a href="../modificaciónContrasenia/modicicaciónpassword.php" class="link-danger">Modificar contraseña</a></div>
                                                <div class="row loginbttm p-3">
                                                    <div class="col-lg-8 login-btm login-text">
                                                        <span>Correo o contraseña incorrectos</span>
                                                    </div>
                                                    <div class="col-lg-4 login-btm login-button">
                                                        <button type="submit" class="btn btn-outline-primary" name="inicio">INICIAR SESIÓN</button>
                                                    </div>
                                                </div>
                                            </form>
                                         ';
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </body>
</html>
