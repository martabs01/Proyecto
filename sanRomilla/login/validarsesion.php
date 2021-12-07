<?php
/*
        Alumno: Marta Broncano Suárez
        Asignatura: Proyecto San Romilla
        Curso: 20-21
        Descripción: Archivo de validaciones del formulario de inicio de sesión
     */
//Incluimos que el archivo ha sido incluido para poder trabjar con los métodos definidos
require_once ('../basedatos/operaciones.php');
    //Funcion que contiene las validaciones del inicio de sesión
    function validar(){
        //Exportación de la clase con sus métodos
        $objeto= new consulta();
        //Comprobación de que el formulario ha sido enviado
        if(isset($_POST["inicio"])){
            //Variables que recogen los datos del formulario
            $correo = $_POST["correo"];
            $password = $_POST["password"];
            //Comprobación de los campos vacíos
            if(!empty($correo && $password)){
                //Comprobación de que el correo y la contraseña son correctos
                if ($objeto->inicio_sesion($correo, $password) == true){
                    //Consulta del correo del usuario
                    $sql = "SELECT * FROM colaborador WHERE correo='".$correo."'";
                    //Método que realiza consulta
                    $objeto->hacer_consultas($sql);
                    //Comprobación de la consulta, si se ha realizado correctamente
                    if($objeto->comprobar_consulta()>0){
                        //Variable que guarda el resultado del método que extrae las filas
                        $fila=$objeto->extraer_filas();
                        //Método que inicia una nueva sesión o reanudar la existente
                        session_start();
                        //Variable que guarda el tipo de colaborador que ha iniciado la sesión
                        $tipo=$fila["tipo"];
                        //Variable que guarda el correo de la sesión iniciada
                        $_SESSION["correo"]=$correo;
                        //Variable que guarda el tipo de colaborador de la sesión iniciada
                        $_SESSION["tipo"]=$tipo;
                        //Comprobacion del tipo de usuario que ha iniciado la sesión
                        switch ($tipo){
                            case 'c'://Colaborador
                                //Método de redirección a la página de incio del colaborador si el usuario es de tipo colaborador
                                header('location:../colaborador/inicio_colaborador.php');
                                break;
                            case 'a'://Coordinador
                                //Método de redirección a la página de incio del coordinador si el usuario es de tipo coordinaodr
                                header('location:../coordinador/inicio_coordinador.php');
                                break;
                        }
                    }
                }else{
                    return 1; //Error usuario o contraseña incorrectos
                }
            }else{
                return 2; //Error campos vacíos
            }
        }
    }
?>