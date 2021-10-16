<!--
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Modificación de la contraseña de los colaboradores
-->
<?php
    echo'
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Login</title>
          <script src="https://use.fontawesome.com/b99e2c8f94.js"></script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
          <link rel="stylesheet" href="../estilos/estiloModificaciónContraseña.css" type="text/css">
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
                MODIFICACIÓN CONTRASEÑA
              </div>
              <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                  <form>
                    <div class="form-group">
                      <label class="form-control-label">EMAIL</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label class="form-control-label">CONTRASEÑA ACTUAL</label>
                      <input type="password" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label class="form-control-label">NUEVA CONTRASEÑA</label>
                      <input type="password" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label class="form-control-label">REPETIR NUEVA CONTRASEÑA</label>
                      <input type="password" class="form-control" >
                    </div>
                    <div class="row loginbttm p-3">
                      <div class="col-lg-6 login-btm login-text">
                        Mensaje
                      </div>
                      <div class="col-lg-6 login-btm login-button">
                        <button type="submit" class="btn btn-outline-primary">ACTUALIZAR</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-3 col-md-2"></div>
            </div>
          </div>
        </body>
        </html>
    ';
?>
