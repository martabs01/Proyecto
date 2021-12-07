<?php
    /*
            Alumno: Marta Broncano Suárez
            Asignatura: Proyecto San Romilla
            Curso: 20-21
            Descripción: Archivo que contiene las acciones que se van a realizar en la gestión de colaboradores
    */
    include('../basedatos/operaciones.php');
    $objeto= new consulta();
    $accion=$_REQUEST['accion'];
    switch ($accion) {
        case 'consultar':
            if($_POST['funcion'] == "listar"){
                $objeto->mostrar_inscripcion();
                $json=array();
                $x=0;
                foreach ($objeto->inscripcion as $data){
                    $json['data'][]=$data;
                    $id_inscripcion=$data["nInscripcion"];
                    $json['data'][$x]['acciones']='<button class="btn btn-secondary m-2" onclick="mostrarEditar('.$id_inscripcion.')"><i class="bi bi-pencil-square"></i></button>';
                    $x++;
                }
                $jsonstring=json_encode($json);
                echo $jsonstring;
            }
            break;
        case 'fecha_inscripcion':
            $sql="SELECT * FROM evento";
            $objeto->hacer_consultas($sql);
            if($objeto->comprobar_consulta()>0){
                $fila=$objeto->extraer_filas();
                $fecha_inicio_ins=$fila["fecha_inicio_ins"];
                $fecha_final_ins=$fila["fecha_final_ins"];
            }
            $hoy=date("Y-m-d");
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
                    <div>
                        <div class="form-group mb-5">
                            <form  id="formulario" class="cmxform" action="#" method="POST" >
                                <div class="table-responsive" id="dynamic_field">
                                </div>
                                <div class="form-check float-end">
                                    <input class="form-check-input" type="checkbox" id="aceptar" name="aceptar">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Aceptar términos
                                    </label>
                                </div>
                                <div  class="float-end mt-5">
                                    <button type="button"  id="add" class="btn btn-primary mb-5" ><i class="bi bi-plus"></i>Añadir inscripción</button>
                                    <button type="submit" class="btn btn-success mb-5 ms-4" >Finalizar inscripciones</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;
        case 'cargar_tallas':
            $sql="SELECT * FROM talla";
            $objeto->hacer_consultas($sql);
            if ($objeto->comprobar_consulta()>0) {
                while ($dato = $objeto->extraer_filas()) {
                    $idtalla = $dato["idTallaCamiseta"];
                    $talla = $dato["talla_camiseta"];
                    echo $talla;
                }
            }else{
                echo "nada";
            }

            break;
        case 'precio_dorsal':
            $i=$_REQUEST["fecha_id"];
            if(!empty($_REQUEST["fecha_nacimiento"][$i])){
                $fecha = $_REQUEST["fecha_nacimiento"][$i];
                $fechaEntera = strtotime($fecha);
                $anio = date("Y", $fechaEntera);
                $sql="SELECT precio_dorsal FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                $objeto->hacer_consultas($sql);
                if($objeto->comprobar_consulta()>0){
                    $fila=$objeto->extraer_filas();
                    $precio=$fila["precio_dorsal"];
                    echo $precio;
                }else{
                    $consulta_categoria="SELECT precio_dorsal FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                    $objeto->hacer_consultas($consulta_categoria);
                    if($objeto->comprobar_consulta()>0){
                        $fila=$objeto->extraer_filas();
                        $precio=$fila["precio_dorsal"];
                        echo $precio;
                    }
                }
            }
            break;
        case 'total_compra':
            $valor=sizeof($_REQUEST["nombre"]);
            $total_donacion=0;
            $total_camiseta=0;
            $precio_real=0;
            for($i=0; $i<$valor; $i++){
                if(!empty($_REQUEST["fecha_nacimiento"][$i])){
                    $fecha = $_REQUEST["fecha_nacimiento"][$i];
                    $fechaEntera = strtotime($fecha);
                    $anio = date("Y", $fechaEntera);
                    $sql="SELECT precio_dorsal FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                    $objeto->hacer_consultas($sql);
                    if($objeto->comprobar_consulta()>0){
                        $fila=$objeto->extraer_filas();
                    }else{
                        $consulta_categoria="SELECT precio_dorsal FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                        $objeto->hacer_consultas($consulta_categoria);
                        if($objeto->comprobar_consulta()>0){
                            $fila=$objeto->extraer_filas();
                        }
                    }
                    $precio=$fila["precio_dorsal"];
                    $precio_real=$precio+$precio_real;
                }
                if(!empty($_REQUEST["donacion"][$i])){
                    $total_donacion=$total_donacion+$_REQUEST["donacion"][$i];
                }
                if($_REQUEST["talla"][$i]!=0){
                    $sql="SELECT * FROM evento";
                    $objeto->hacer_consultas($sql);
                    if($objeto->comprobar_consulta()>0){
                        $fila=$objeto->extraer_filas();
                        $precio_camiseta=$fila["precio_camiseta"];
                    }
                    $total_camiseta=$total_camiseta+$precio_camiseta;
                }
            }
            $total_compra=$total_donacion+$total_camiseta;
            ?>
            <div class="window-notice" id="window-notice">
                <div class="content">
                    <?php
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
            $valor=sizeof($_REQUEST["nombre"]);
            for($i=0; $i<$valor; $i++){
                $fecha = $_REQUEST["fecha_nacimiento"][$i];
                $fechaEntera = strtotime($fecha);
                $anio = date("Y", $fechaEntera);
                $consulta_categoria="SELECT idCategoria, precio_dorsal FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                $objeto->hacer_consultas($consulta_categoria);
                if($objeto->comprobar_consulta()>0){
                    $fila=$objeto->extraer_filas();
                }else{
                    $consulta_categoria="SELECT idCategoria, precio_dorsal FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                    $objeto->hacer_consultas($consulta_categoria);
                    if($objeto->comprobar_consulta()>0){
                        $fila=$objeto->extraer_filas();
                    }
                }
                $idcat=$fila["idCategoria"];
                $precio=$fila["precio_dorsal"];

                if ($_REQUEST["talla"][$i]=="0"){
                    $talla="NULL";
                }else{
                    $talla="'".$_REQUEST["talla"][$i]."'";
                }

                //$dni="'".$_REQUEST["dni"][$i]."'";// Todas las variables caracter
                //$donacion=$_REQUEST["donacion"][$i]; //Todas las variables numericas

                /*$sql="INSERT INTO inscripcion (dni, fecha_nacimiento, nombre, apellidos, telefono, dorsal, donacion_dorsal, id_idTallaCamiseta_Talla, id_idCategoria_Categoria,terminos)
                            VALUES ($dni.','.$fecha_nacimiento.','.$nombre.','.$apellidos.','. $telefono.','.
                           $dorsal.','.$donacion .','. $talla .','. $idcat.','.$terminos);";*/

                //Si acepta los terminos hago la inscripción si no no se puede inscribir
                if($_REQUEST["donacion"][$i]<$precio){
                    echo "no";
                }else{
                    $sql="INSERT INTO inscripcion (dni, fecha_nacimiento, nombre, apellidos, telefono, dorsal, donacion_dorsal, id_idTallaCamiseta_Talla, id_idCategoria_Categoria)
                    VALUES ('".$_REQUEST["dni"][$i]."', '".$_REQUEST["fecha_nacimiento"][$i]."', '".$_REQUEST["nombre"][$i]."', '".$_REQUEST["apellidos"][$i]."', '".$_REQUEST["telefono"][$i]."',
                    ".$_REQUEST["dorsal"][$i].",".$_REQUEST["donacion"][$i]." , $talla , $idcat);";
                    $objeto->hacer_consultas($sql);
                    if($objeto->comprobar_actualizacion()>0){
                        echo "ok";
                    }else{
                        echo "ko";
                    }
                }

            }
            break;
        case 'mostrar_editar':
            $id=$_GET['id'];
            $inscripcion=" SELECT * FROM inscripcion WHERE nInscripcion='".$id."'";
            $objeto->hacer_consultas($inscripcion);
            if($objeto->comprobar_consulta()>0){
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
            $id=$_GET['id'];
            $nombre=$_REQUEST['nombre'];
            $apellidos=$_REQUEST['apellidos'];
            $dni=$_REQUEST['dni'];
            $fecha_nacimiento=$_REQUEST['fecha_nacimiento'];
            $telefono=$_REQUEST['telefono'];
            $dorsal=$_REQUEST['dorsal'];

            $fechaEntera = strtotime($fecha_nacimiento);
            $anio = date("Y", $fechaEntera);
            $consulta_categoria="SELECT idCategoria FROM categoria WHERE ano_min<=".$anio." and ano_max>=".$anio.";";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
            $objeto->hacer_consultas($consulta_categoria);
            if($objeto->comprobar_consulta()>0){
                $fila=$objeto->extraer_filas();
            }else{
                $consulta_categoria="SELECT idCategoria FROM categoria WHERE ano_max>=".$anio." and ano_min is NULL OR ano_min<=".$anio." and ano_max is NULL";//SELECT * FROM categoria WHERE ano_min<=2015 and ano_max>=2015
                $objeto->hacer_consultas($consulta_categoria);
                if($objeto->comprobar_consulta()>0){
                    $fila=$objeto->extraer_filas();
                }
            }
            $idcat=$fila["idCategoria"];

            $sql="UPDATE inscripcion SET dni='".$dni."', fecha_nacimiento='". $fecha_nacimiento."',nombre='".$nombre."', apellidos='".$apellidos."',
            telefono='".$telefono."', dorsal='".$dorsal."',  id_idCategoria_Categoria='".$idcat."' WHERE nInscripcion=".$id.";";
            $objeto->hacer_consultas($sql);
            if($objeto->comprobar_actualizacion()>0){
                echo "ok";
            }else{
                echo "ko";
            }
            break;
    }
?>


