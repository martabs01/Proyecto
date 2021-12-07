<?php
/*
        Alumno: Marta Broncano Suárez
        Asignatura: Proyecto San Romilla
        Curso: 20-21
        Descripción: Archivo que contiene las acciones que se van a realizar en la gestión de donaciones
*/
    include('../basedatos/operaciones.php');
    $objeto= new consulta();
    $accion=$_REQUEST['accion'];
    switch ($accion) {
        case 'consultar':
            if($_POST['funcion'] == "listar"){
                $objeto->mostrar_donacion();
                $json=array();
                $x=0;
                foreach ($objeto->donacion as $data){
                    $json['data'][]=$data;
                    $id_donacion=$data["idDonacion"];

                }
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
                    <div class="col-lg-12 pt-3 d-flex d-grid gap-2 d-md-flex justify-content-md-end"><button onclick="location.href='gestiondonaciones.php'" type="button" class="btn btn-danger btn-sm me-md-2"><i class="bi bi-x-lg"></i></button></div>
                    <div class="col-lg-12 pt-3 d-flex justify-content-center">
                        <i class="bi bi-person-plus-fill login-key" aria-hidden="true"></i>
                    </div>
                    <div class="col-lg-12 login-title">
                        NUEVA DONACIÓN
                    </div>
                    <div class="col-lg-12 login-form">
                        <div class="col-lg-12 login-form">
                            <form id="insertar" class="cmxform" action="#" method="POST">
                                <div class="form-group">
                                    <label class="form-control-label">NOMBRE</label>
                                    <input type="text" id="nombre" class="form-control" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">APELLIDOS</label>
                                    <input type="text" id="apellidos" class="form-control" name="apellidos" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">IMPORTE</label>
                                    <input type="text" id="donacion" class="form-control " name="donacion" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label pb-1">TALLA CAMISETA</label>
                                    <?php
                                        $sql="SELECT * FROM talla";
                                        $objeto->hacer_consultas($sql);
                                        if ($objeto->comprobar_consulta()>0) {
                                            echo '<select class="inscripcion mt-4" name="talla">
                                            <option value="0">No quiere camiseta</option>';
                                            while ($fila = $objeto->extraer_filas()) {
                                                $id = $fila["idTallaCamiseta"];
                                                $talla_camiseta= $fila["talla_camiseta"];
                                                echo '<option value="'.$id.'">'.$talla_camiseta.'</option>';
                                            }
                                        }
                                        echo '</select>';
                                    ?>
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
        case 'donacion':
            $precio_camiseta=0;
            if($_REQUEST["talla"]!=0){
                $sql="SELECT * FROM evento";
                $objeto->hacer_consultas($sql);
                if($objeto->comprobar_consulta()>0){
                    $fila=$objeto->extraer_filas();
                    $precio_camiseta=$fila["precio_camiseta"];
                }
                $total_camiseta=$precio_camiseta;

            }
            $total=$_REQUEST["donacion"]+$precio_camiseta;
            ?>
            <div class="window-notice" id="window-notice">
                <div class="content">
                    <div class="content-text justify-content-center">
                        Precio total: <?php echo $total.'€'?>
                    </div>
                    <div>
                        <center>
                            <button name="aceptar" type="button" class="btn btn-success m-3" onclick="cancelar()">Volver</button>
                            <button name="cancelar" type="button" class="btn btn-primary m-3" onclick="insertar()">Finalizar</button>
                        </center>
                    </div>
                </div>
            </div>
            <?php
            break;
        case 'insertar':
            $nombre=$_REQUEST['nombre'];
            $apellidos=$_REQUEST['apellidos'];
            $donacion=$_REQUEST['donacion'];
            if ($_REQUEST["talla"]=="0"){
                $talla="NULL";
            }else{
                $talla="'".$_REQUEST["talla"]."'";
            }
            $sql="INSERT INTO  donacion (nombre, apellidos, importe, id_idTallaCamiseta_Talla)
                VALUES ('".$nombre."','".$apellidos."',$donacion,$talla);";

            $objeto->hacer_consultas($sql);

            break;

    }



