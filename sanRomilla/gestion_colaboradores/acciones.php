<?php
/*
     Alumno: Marta Broncano Suárez
     Asignatura: Proyecto San Romilla
     Curso: 20-21
     Descripción: Archivo que contiene las acciones que se van a realizar en la gestión de colaboradores
*/
//Archivo incluido para emplear los métodos necesarios
require_once ('../basedatos/operaciones.php');
//Variable que recoge los métodos
$objeto= new consulta();
//Variable que recoge la acción que se quiere realizar
$accion=$_REQUEST['accion'];
//Método que realiza la acción según la indicada
switch ($accion) {
    case 'consultar':
        //Comprobación de si la función es lsitar
        if($_POST['funcion'] == "listar"){
            //Método que realiza la consulta del registro de colaboradores
            $objeto->mostrar_colaborador();
            //Declaración de array
            $json=array();
            //Variable para recorrer el array
            $x=0;
            //Método que recorre el array
            foreach ($objeto->colaborador as $data){
                $json['data'][]=$data;
                $id_colaborador=$data["idColaborador"];
                $json['data'][$x]['acciones']='<button class="btn btn-secondary m-2" onclick="mostrarEditar('.$id_colaborador.')"><i class="bi bi-pencil-square"></i></button>
                                                   <button class="btn btn-danger m-2" onclick="cuadroEliminar('.$id_colaborador.')" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-trash"></i></button>';
                $x++;
            }
            //Conversion a json para poder mostrar el resultado
            $jsonstring=json_encode($json);
            echo $jsonstring;
        }
        break;
    case 'mostrar_insertar':
        ?>
        <!--Diseño del formulario de inserción-->
        <div class="row" id="mostrarInsertar">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 pt-3 d-flex d-grid gap-2 d-md-flex justify-content-md-end"><button onclick="location.href='gestioncolaborador.php'" type="button" class="btn btn-danger btn-sm me-md-2"><i class="bi bi-x-lg"></i></button></div>
                <div class="col-lg-12 pt-3 d-flex justify-content-center">
                    <i class="bi bi-person-plus-fill login-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    NUEVO COLABORADOR
                </div>
                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form id="insertar" class="cmxform needs-validation" action="#" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">CORREO</label>
                                <input type="email" id="email" class="form-control" name="email"  required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">TIPO COLABORADOR</label>
                                <br>
                                <select class="w-100 mb-0 mt-4 form-control" name="tipo">
                                    <option selected value="a">Administrador</option>
                                    <option value="c">Colaborador</option>
                                    <option value="m>">Meta</option>
                                    <option value="i">Imagen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">NOMBRE</label>
                                <input type="text" id="nombre" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">APELLIDOS</label>
                                <input type="text" id="apellidos" class="form-control" name="apellidos" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">TELÉFONO</label>
                                <input type="text" id="telefono" class="form-control" name="telefono" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">CONTRASEÑA</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">REPETIR CONTRASEÑA</label>
                                <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" required>
                            </div>
                            <div class="row loginbttm p-3">
                                <div class="col-lg-6 login-btm login-text">
                                    Por favor, rellene el formulario para dar de alta un nuevo colaborador
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary" name="enviar" id="enviar_colaborador" onclick="validarInsertar()">AÑADIR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
        <?php
        break;

    case 'insertar':
        //Variables que recogen los campos del formualrio
        $correo=$_REQUEST['email'];
        $tipo=$_REQUEST['tipo'];
        $nombre=$_REQUEST['nombre'];
        $apellidos=$_POST['apellidos'];
        $telefono=$_REQUEST['telefono'];
        $password=$_REQUEST['password'];
        $confirm_password=$_REQUEST['confirm_password'];
        //Consulta inserción
        $sql="INSERT INTO  colaborador (correo, tipo, nombre, apellidos, telefono, password)
            VALUES ('".$correo."','".$tipo."','".$nombre."','".$apellidos."','".$telefono."',
            '".password_hash($password,PASSWORD_DEFAULT)."');";
        $objeto->hacer_consultas($sql);//Método que realiza consulta
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_actualizacion()>0){
            echo "ok";
        }else{
            echo "ko";
        }
        break;
    case 'mostrar_editar':
        //Variable que recoge el id seleccionado
        $id=$_GET['id'];
        //Consulta datos colaborador seleccionado
        $sql=" SELECT * FROM colaborador WHERE idColaborador='".$id."'";
        //Método que realiza consulta
        $objeto->hacer_consultas($sql);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_consulta()>0){
            $fila=$objeto->extraer_filas();
        }
        //Comprobación del tipo de colaborador seleccionado
        if($fila['tipo']=='a'){
            $tipo1='Administrador';
        }else{
            if($fila['tipo']=='c'){
                $tipo1='Colaborador';
            }else{
                if($fila['tipo']=='m'){
                    $tipo1='Meta';
                }else{
                    if($fila['tipo']=='i'){
                        $tipo1='Imagen';
                    }
                }
            }
        }
        //Comprobación de colaboradores para mostrar las opciones
        if ($tipo1=='Administrador') {
            $tipo2='Colaborador';
            $tipo3='Meta';
            $tipo4='Imagen';
        }else{
            if($tipo1== 'Colaborador'){
                $tipo2='Administrador';
                $tipo3='Meta';
                $tipo4='Imagen';
            }else{
                if($tipo1== 'Meta'){
                    $tipo2='Administrador';
                    $tipo3='Colaborador';
                    $tipo4='Imagen';
                }else{
                    if($tipo1== 'Imagen'){
                        $tipo2='Administrador';
                        $tipo3='Colaborador';
                        $tipo4='Meta';
                    }
                }
            }
        }
        //Comprobación de colaboradores para dar valor a las opciones
        if($tipo1=='Administrador'){
            $valor1='a';
        }else{
            if($tipo1=='Colaborador'){
                $valor1='c';
            }else{
                if($tipo1=='Meta'){
                    $valor1='m';
                }else{
                    if($tipo1=='Imagen'){
                        $valor1='i';
                    }
                }
            }
        }
        if($tipo2=='Administrador'){
            $valor2='a';
        }else{
            if($tipo2=='Colaborador'){
                $valor2='c';
            }else{
                if($tipo2=='Meta'){
                    $valor2='m';
                }else{
                    if($tipo2=='Imagen'){
                        $valor2='i';
                    }
                }
            }
        }
        if($tipo3=='Administrador'){
            $valor3='a';
        }else{
            if($tipo3=='Colaborador'){
                $valor3='c';
            }else{
                if($tipo3=='Meta'){
                    $valor3='m';
                }else{
                    if($tipo3=='Imagen'){
                        $valor3='i';
                    }
                }
            }
        }
        if($tipo4=='Administrador'){
            $valor4='a';
        }else{
            if($tipo4=='Colaborador'){
                $valor4='c';
            }else{
                if($tipo4=='Meta'){
                    $valor4='m';
                }else{
                    if($tipo4=='Imagen'){
                        $valor4='i';
                    }
                }
            }
        }
        ?>
        <!--Diseño del formulario de edición-->
        <div id="editar" class="row" >
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 pt-3 d-flex d-grid gap-2 d-md-flex justify-content-md-end"><button onclick="location.href='gestioncolaborador.php'" type="button" class="btn btn-danger btn-sm me-md-2"><i class="bi bi-x-lg"></i></button></div>
                <div class="col-lg-12 pt-3 d-flex justify-content-center">
                    <i class="bi bi-pencil-square login-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    <?php echo $fila["nombre"].' '.$fila["apellidos"]?>
                </div>
                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form id="submitenviar" class="cmxform" action="#" method="POST" >
                            <div class="form-group">
                                <label class="form-control-label">CORREO</label>
                                <input type="email" id="email" class="form-control" name="email" value='<?php echo $fila["correo"];?>' required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">TIPO COLABORADOR</label>
                                <br>
                                <select class="w-100 mb-0 mt-4" name="tipo">
                                    <option selected value="<?php echo $valor1?>">
                                        <?php echo  $tipo1  ;?>
                                    </option>
                                    <option value="<?php echo $valor2?>">
                                        <?php echo $tipo2;?>
                                    </option>
                                    <option value="<?php echo $valor3?>">
                                        <?php echo $tipo3 ;?>
                                    </option>
                                    <option value="<?php echo $valor4?>">
                                        <?php echo $tipo4 ;?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">NOMBRE</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo $fila["nombre"];?>' required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">APELLIDOS</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value='<?php echo $fila["apellidos"]?>' required >
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">TELÉFONO</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value='<?php echo $fila["telefono"]?>' required>
                            </div>
                            <div class="row loginbttm p-3">
                                <div class="col-lg-12 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary" name="modificar" onclick="validarEditar('<?php echo $id?>')">GUARDAR CAMBIOS</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
        <?php
        break;
    case 'editar':
        //Variables que recogen los campos del formulario
        $id=$_GET['id'];
        $correo=$_REQUEST['email'];
        $tipo=$_REQUEST['tipo'];
        $nombre=$_REQUEST['nombre'];
        $apellidos=$_REQUEST['apellidos'];
        $telefono=$_REQUEST['telefono'];
        //Consulta actualización
        $sql="UPDATE colaborador SET correo='".$correo."', tipo='".$tipo."',
            nombre='".$nombre."', apellidos='".$apellidos."', telefono='".$telefono."' WHERE idColaborador=".$id; //Consulta para modificar el colaborador seleccionado
        //Método que realiza consulta
        $objeto->hacer_consultas($sql);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_actualizacion()>0){
            echo "ok";
        }else{
            echo "ko";
        }
        break;
    case 'cuadro_eliminar':
        //Variable que recoge el id seleccionado
        $id=$_GET['id'];
        //Consulta datos del colaborador seleccinado
        $sql=" SELECT * FROM colaborador WHERE idColaborador=".$id;
        //Método que realiza consulta
        $objeto->hacer_consultas($sql);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_consulta()>0){
            //Variable que guarda el resultado del método que extrae las filas
            $fila=$objeto->extraer_filas();
        }
        ?>
        <!--Diseño del cuadro de eliminación-->
        <div class="window-notice" id="window-notice">
            <div class="content">
                <div class="content-text justify-content-center">
                    ¿Estás seguro de que quieres eliminar al colaborador <?php echo $fila["nombre"]. '  ' .$fila["apellidos"] //Mostración de variables que recogen el nombre y los apellidos del colabor seleccionado?>?
                </div>
                <div>
                    <center>
                        <button name="aceptar" type="button" class="btn btn-success m-3" onclick="aceptarEliminar(<?php echo $fila["idColaborador"] ?>)">Aceptar</button>
                        <button name="cancelar" type="button" class="btn btn-danger m-3" onclick="cancelarEliminar()">Cancelar</button>
                    </center>
                </div>
            </div>
        </div>
        <?php
        break;
    case 'aceptar_eliminar':
        //Variable que recoge el id seleccionado
        $id=$_GET['id'];
        //Consulta borrado del colaborador seleccionado
        $sql=" DELETE FROM colaborador WHERE idColaborador=".$id;
        //Método que realiza consulta
        $objeto->hacer_consultas($sql);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_actualizacion()>0){
            echo "ok";
        }else{
            echo "ko";
        }
        break;
}
?>

