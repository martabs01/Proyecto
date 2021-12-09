<?php
/*
     Alumno: Marta Broncano Suárez
     Asignatura: Proyecto San Romilla
     Curso: 20-21
     Descripción: Archivo que contiene las acciones que se van a realizar en la gestión de inscripciones
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
        //Comprobación de si la función es listar
        if($_POST['funcion'] == "listar"){
            //Método que realiza la consulta del registro de inscripciones
            $objeto->mostrar_inscripcion();
            //Declaración de array
            $json=array();
            //Variable para recorrer el array
            $x=0;
            //Método que recorre el array
            foreach ($objeto->inscripcion as $data){
                $json['data'][]=$data;
                $id_inscripcion=$data["nInscripcion"];
                $json['data'][$x]['acciones']='<button class="btn btn-secondary m-2" onclick="mostrarEditar('.$id_inscripcion.')"><i class="bi bi-pencil-square"></i></button>';
                $x++;
            }
            //Conversion a json para poder mostrar el resultado
            $jsonstring=json_encode($json);
            echo $jsonstring;
        }
        break;
    case 'fecha_inscripcion':
        //Consulta datos de la tabla evento
        $sql="SELECT * FROM evento";
        //Método que realiza consulta
        $objeto->hacer_consultas($sql);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_consulta()>0){
            //Variable que guarda el resultado del método que extrae las filas
            $fila=$objeto->extraer_filas();
            //Variable que guarda la fecha de inicio de inscripción devuelta
            $fecha_inicio_ins=$fila["fecha_inicio_ins"];
            //Variable que guarda la fecha final de inscripción devuelta
            $fecha_final_ins=$fila["fecha_final_ins"];
        }
        //Variable que recoge la fecha actual
        $hoy=date("Y-m-d");
        //Comprobación de la fecha actual con la de inicio de inscripción y final
        if($hoy>=$fecha_inicio_ins && $hoy<=$fecha_final_ins){
            echo "ok";
        }else{
            if($hoy<$fecha_inicio_ins){
                echo "ko1";
            }else{
                if($hoy>$fecha_final_ins)
                    echo "ko2";
            }
        }
        break;
    case 'mostrar_insertar':
        ?>
        <!--Diseño del formulario de inserción-->
        <div class="row" id="mostrar_insertar" >
            <div class="col-lg-12 pt-3 d-flex d-grid gap-2 d-md-flex justify-content-md-end"><button onclick="location.href='gestioninscripciones.php'" type="button" class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i></button></div>
            <div class="jumbotron jumbotron-fluid">
                <div class="mb-5 ml-0">
                    <h1>Inscripciones San Romilla</h1>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <!-- Contenido -->
                <div >
                    <div class="form-group mb-5">
                        <form  id="formulario" class="cmxform" action="#" method="POST" >
                            <div class="table-responsive" id="dynamic_field"></div>
                            <div class="float-end form-check">
                                <input class="form-check-input" type="checkbox" id="aceptar" name="aceptar">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <a href="javascript:terminos()">Aceptar términos</a>
                                    <span style="color: red" class="ms-3">*Campo obligatorio</span>
                                   <div class="mt-5">
                                       <button type="button"  id="add" class="btn btn-primary me-3" ><i class="bi bi-plus"></i>Añadir inscripción</button>
                                       <button type="button" class="btn btn-success " onclick="totalCompra()">Finalizar inscripciones</button>
                                   </div>
                                </label>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 'cargar_talla':
        //Consulta de los datos de la tabla talla
        $sql="SELECT * FROM talla";
        //Método que realiza consulta
        $objeto->hacer_consultas($sql);
        //Variable que declara el array donde vamos a recoger los datos
        $res=array();
        //Comprobación de las filas devueltas
        if ($objeto->comprobar_consulta()>0) {
            while ($dato = $objeto->extraer_filas()) {
                //Variable que el idTalla devuelto
                $idtalla = $dato["idTallaCamiseta"];
                //Variable que guarda la talla devuelta
                $talla = $dato["talla_camiseta"];
                array_push($res,$dato);
                //echo $talla;
            }
        }
        echo json_encode($res);
        break;
    case 'precio_dorsal':
        //Variable que recoge la fecha seleccionada
        $i=$_REQUEST["fecha_id"];
        //Comprobación que el campo fecha no esté vacío
        if(!empty($_REQUEST["fecha_nacimiento"][$i])){
            //Variable que recoge la fecha de cada tabla
            $fecha = $_REQUEST["fecha_nacimiento"][$i];
            //Variable que guarda la fecha indicada en el formato correcto
            $fechaEntera = strtotime($fecha);
            //Variable que guarda el año extraído de la fecha indicada
            $anio = date("Y", $fechaEntera);
            //Consulta del precio del dorsal si la fecha está comprendida entre años
            $sql="SELECT precio_dorsal FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
            //Método que realiza consulta
            $objeto->hacer_consultas($sql);
            //Comprobación de la consulta, si se ha realizado correctamente
            if($objeto->comprobar_consulta()>0){
                //Variable que guarda el resultado del método que extrae las filas
                $fila=$objeto->extraer_filas();
                //Variable que guarda el precio del dorsal devuelto
                $precio=$fila["precio_dorsal"];
                echo $precio;
            }else{
                //Consulta del precio del dorsal si la fecha es mínima o máxima
                $consulta_categoria="SELECT precio_dorsal FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                //Método que realiza consulta
                $objeto->hacer_consultas($consulta_categoria);
                //Comprobación de la consulta, si se ha realizado correctamente
                if($objeto->comprobar_consulta()>0){
                    //Variable que guarda el resultado del método que extrae las filas
                    $fila=$objeto->extraer_filas();
                    //Variable que guarda el precio del dorsal devuelto
                    $precio=$fila["precio_dorsal"];
                    echo $precio;
                }
            }
        }
        break;
    case 'terminos':
        ?>
        <div class="window-notice" id="window-notice">
            <div class="content">
                <div class="col-lg-12 pt-3 d-flex d-grid gap-2 d-md-flex justify-content-md-end"><button onclick="ocultarTerminos()" type="button" class="btn btn-danger btn-sm "><i class="bi bi-x-lg"></i></button></div>
                <div class="content-text justify-content-center">
                    <h5>Artículo 14</h5>
                    <i>Aceptación</i>
                    <p class="mt-3">
                        Todos los participantes, por el hecho de inscribirse, reconocen que se encuentran en
                        perfectas condiciones para la práctica deportiva, y se comprometen a correr bajo su
                        estricta responsabilidad.
                        Además de aceptar el presente reglamento y la utilización informática, y con el fin deportivo,
                        de sus datos personales e imágenes dentro de la prueba mediante fotografías, vídeos, etc.
                        En caso de duda o de surgir alguna situación no reflejada en el mismo, se estará a lo que
                        disponga el Comité Organizador.
                    </p>
                </div>
            </div>
        </div>

        <?php
        break;
    case 'total_compra':
        //Tamaño del número de array
        $valor=sizeof($_REQUEST["nombre"]);
        //Inicialización del total del precio de la donación
        $total_donacion=0;
        //Inicialización del total del precio de la camiseta
        $total_camiseta=0;
        //Inicialización del precio real
        $precio_real=0;
        //Método que va recorriendo los campos según el número que haya
        for($i=0; $i<$valor; $i++){
            //Comprobación que el campo fecha no esté vacío
            if(!empty($_REQUEST["fecha_nacimiento"][$i])){
                //Variable que recoge la fecha seleccionada
                $fecha = $_REQUEST["fecha_nacimiento"][$i];
                //Variable que guarda la fecha indicada en el formato correcto
                $fechaEntera = strtotime($fecha);
                //Variable que guarda el año extraído de la fecha indicada
                $anio = date("Y", $fechaEntera);
                //Consulta del precio del dorsal si la fecha está comprendida entre años establecidos
                $sql="SELECT precio_dorsal FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                //Método que realiza consulta
                $objeto->hacer_consultas($sql);
                //Comprobación de la consulta, si se ha realizado correctamente
                if($objeto->comprobar_consulta()>0){
                    //Variable que guarda el resultado del método que extrae las filas
                    $fila=$objeto->extraer_filas();
                }else{
                    //Consulta del precio del dorsal si la fecha es mínima o máxima entre la establecida
                    $consulta_categoria="SELECT precio_dorsal FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                    //Método que realiza consulta
                    $objeto->hacer_consultas($consulta_categoria);
                    //Comprobación de la consulta, si se ha realizado correctamente
                    if($objeto->comprobar_consulta()>0){
                        //Variable que guarda el resultado del método que extrae las filas
                        $fila=$objeto->extraer_filas();
                    }
                }
                //Variable que guarda el precio del dorsal devuelto
                $precio=$fila["precio_dorsal"];
                //Variable que va guardando el precio real
                $precio_real=$precio+$precio_real;
            }
            //Comprobación de que le campo donación no esté vacío
            if(!empty($_REQUEST["donacion"][$i])){
                //Variable que va guardando el precio de la donación
                $total_donacion=$total_donacion+$_REQUEST["donacion"][$i];
            }
            //Comprobación de que el campo talla tenga una talla de camiseta asignada
            if($_REQUEST["talla"][$i]!=0){
                //Consulta datos de la tabla evento
                $sql="SELECT * FROM evento";
                //Método que realiza consulta
                $objeto->hacer_consultas($sql);
                //Comprobación de la consulta, si se ha realizado correctamente
                if($objeto->comprobar_consulta()>0){
                    //Variable que guarda el resultado del método que extrae las filas
                    $fila=$objeto->extraer_filas();
                    //Variable que guarda el precio de la camiseta devuelto
                    $precio_camiseta=$fila["precio_camiseta"];
                }
                //Variable que va guardando el precio de la camiseta
                $total_camiseta=$total_camiseta+$precio_camiseta;
            }
        }
        //Variable que guarda el precio total
        $total_compra=$total_donacion+$total_camiseta;
        ?>
        <div class="window-notice" id="window-notice">
            <div class="content">
                <?php
                //Comprobación de que le precio real de la donación no sea mayor que el importe dado
                if($precio_real>$total_donacion){
                    echo " 
                                <div class=\"content-text justify-content-center\">
                                        El importe de donación no puede ser inferior al precio del dorsal establecido, por favor, revise los datos.
                                </div>
                                <div>
                                    <center>
                                        <button name=\"aceptar\" type=\"button\" class=\"btn btn-success m-3\" onclick=\"seguirComprando()\">Volver a inscripciones</button>
                                    </center>
                                </div>
                                ";
                }else{
                    echo "
                                <div class=\"content-text justify-content-center\">
                                        Precio total: "; echo $total_compra; echo "€
                                </div>
                                <div>
                                    <center>
                                        <button name=\"aceptar\" type=\"button\" class=\"btn btn-success m-3\" onclick=\"seguirComprando()\">Volver a inscripciones</button>
                                        <button name=\"cancelar\" type=\"button\" class=\"btn btn-primary m-3\" onclick=\"insertar()\">Finalizar compra</button>
                                    </center>
                                </div>";
                }

                ?>
            </div>
        </div>
        <?php
        break;
    case 'insertar':
        //Tamaño del número de array
        $valor=sizeof($_REQUEST["nombre"]);
        //Método que va recorriendo los campos según el número que haya
        for($i=0; $i<$valor; $i++){
            //Variable que recoge la fecha seleccionada
            $fecha = $_REQUEST["fecha_nacimiento"][$i];
            //Variable que guarda la fecha indicada en el formato corecto
            $fechaEntera = strtotime($fecha);
            //Variable que guarda el año extraído de la fecha indicada
            $anio = date("Y", $fechaEntera);
            //Consulta de la categoría si la fecha está comprendida entre los años establecidos
            $consulta_categoria="SELECT idCategoria, precio_dorsal FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
            //Método que realiza consulta
            $objeto->hacer_consultas($consulta_categoria);
            //Comprobación de la consulta, si se ha realizado correctamente
            if($objeto->comprobar_consulta()>0){
                //Variable que guarda el resultado del método que extrae las filas
                $fila=$objeto->extraer_filas();
            }else{
                //Consulta de la categoría si la fecha es mínima o máxima entre la establecida
                $consulta_categoria="SELECT idCategoria, precio_dorsal FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                //Método que realiza consulta
                $objeto->hacer_consultas($consulta_categoria);
                //Comprobación de la consulta, si se ha realizado correctamente
                if($objeto->comprobar_consulta()>0){
                    //Variable que guarda el resultado del método que extrae las filas
                    $fila=$objeto->extraer_filas();
                }
            }
            //Variable que guarda la categoría devuelta
            $idcat=$fila["idCategoria"];
            //Variable que guarda el precio del dorsal devuelto
            $precio=$fila["precio_dorsal"];
            //Comprobación del valor de la talla
            if ($_REQUEST["talla"][$i]=="0"){
                $talla="NULL";
            }else{
                $talla="'".$_REQUEST["talla"][$i]."'";
            }
           //Comprobación de que la donación no ezs menos que el precio establecido
            if($_REQUEST["donacion"][$i]<$precio){
                echo "no";
            }else{
                //Consulta inserción
                $sql="INSERT INTO inscripcion (dni, fecha_nacimiento, nombre, apellidos, telefono, dorsal, donacion_dorsal, id_idTallaCamiseta_Talla, id_idCategoria_Categoria)
                    VALUES ('".$_REQUEST["dni"][$i]."', '".$_REQUEST["fecha_nacimiento"][$i]."', '".$_REQUEST["nombre"][$i]."', '".$_REQUEST["apellidos"][$i]."', '".$_REQUEST["telefono"][$i]."',
                    ".$_REQUEST["dorsal"][$i].",".$_REQUEST["donacion"][$i]." , $talla , $idcat);";
                //Método que realiza consulta
                $objeto->hacer_consultas($sql);
                //Comprobación de la consulta, si se ha realizado correctamente
                if($objeto->comprobar_actualizacion()>0){
                    echo "ok";
                }else{
                    echo "ko";
                }
            }

        }
        break;
    case 'mostrar_editar':
        //Variable que recoge el id seleccionado
        $id=$_GET['id'];
        //Consulta de los datos según el nInscripción
        $inscripcion=" SELECT * FROM inscripcion WHERE nInscripcion='".$id."'";
        //Método que realiza consulta
        $objeto->hacer_consultas($inscripcion);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_consulta()>0){
            //Variable que guarda el resultado del método que extrae las filas
            $fila=$objeto->extraer_filas();
        }
        ?>
        <!--Diseño del formulario de edición-->
        <div id="editar" class="row" >
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 pt-3 d-flex d-grid gap-2 d-md-flex justify-content-md-end"><button onclick="location.href='gestioninscripciones.php'" type="button" class="btn btn-danger btn-sm me-md-2"><i class="bi bi-x-lg"></i></button></div>
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
                                <label class="form-control-label">NOMBRE</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo $fila["nombre"];?>' required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">APELLIDOS</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value='<?php echo $fila["apellidos"]?>' required >
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">FECHA NACIMIENTO</label>
                                <input type="date" id="fecha_nacimiento" class="form-control" name="fecha_nacimiento" value='<?php echo $fila["fecha_nacimiento"];?>' required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">DNI</label>
                                <input type="text" id="dni" class="form-control" name="dni" value='<?php echo $fila["dni"];?>' required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">TELÉFONO</label>
                                <input type="text" id="telefono" class="form-control" name="telefono" value='<?php echo $fila["telefono"];?>' required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">DORSAL</label>
                                <input type="text" id="dorsal" class="form-control" name="dorsal" value='<?php echo $fila["dorsal"];?>' required>
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
        $nombre=$_REQUEST['nombre'];
        $apellidos=$_REQUEST['apellidos'];
        $dni=$_REQUEST['dni'];
        $fecha_nacimiento=$_REQUEST['fecha_nacimiento'];
        $telefono=$_REQUEST['telefono'];
        $dorsal=$_REQUEST['dorsal'];
        //Variable que guarda la fecha indicada en el formato corecto
        $fechaEntera = strtotime($fecha_nacimiento);
        //Variable que guarda el año extraído de la fecha indicada
        $anio = date("Y", $fechaEntera);
        //Consulta del precio del dorsal si la fecha está comprendida entre años establecidos
        $consulta_categoria="SELECT idCategoria FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
        //Método que realiza consulta
        $objeto->hacer_consultas($consulta_categoria);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_consulta()>0){
            //Variable que guarda el resultado del método que extrae las filas
            $fila=$objeto->extraer_filas();
        }else{
            //Consulta de la categoría si la fecha es mínima o máxima entre la establecida
            $consulta_categoria="SELECT idCategoria FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
            //Método que realiza consulta
            $objeto->hacer_consultas($consulta_categoria);
            //Comprobación de la consulta, si se ha realizado correctamente
            if($objeto->comprobar_consulta()>0){
                //Variable que guarda el resultado del método que extrae las filas
                $fila=$objeto->extraer_filas();
            }
        }
        //Variable que guarda la categoría devuelta
        $idcat=$fila["idCategoria"];
        //Consulta actualización
        $sql="UPDATE inscripcion SET dni='".$dni."', fecha_nacimiento='". $fecha_nacimiento."',nombre='".$nombre."', apellidos='".$apellidos."',
            telefono='".$telefono."', dorsal='".$dorsal."',  id_idCategoria_Categoria='".$idcat."' WHERE nInscripcion=".$id.";";
        //Método que realiza consulta
        $objeto->hacer_consultas($sql);
        //Comprobación de la consulta, si se ha realizado correctamente
        if($objeto->comprobar_actualizacion()>0){
            echo "ok";
        }else{
            echo "ko";
        }
        break;
    case 'cuadro_eliminar':?>
        <!--Diseño del cuadro de eliminación-->
        <div class="window-notice" id="window-notice">
            <div class="content">
                <div class="content-text justify-content-center">
                    ¿Estás seguro de que quieres eliminar al colaborador
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
}

?>


