<?php
    /*
        Alumno: Marta Broncano Suárez
        Asignatura: Proyecto San Romilla
        Curso: 20-21
        Descripción: Archivo de validaciones del formulario de inicio de sesión
     */
    //Incluimos que el archivo ha sido incluido para poder trabjar con los métodos definidos
    require_once ('../basedatos/operaciones.php');
    //Función que contiene los datos de la sesión iniciada
    session_start();
    //Funcion que contiene las validaciones de la modificación de contraseña
    function validar_password(){
        //Exportación de la clase con sus métodos
        $objeto= new consulta();
        //Comprobación de que el formulario ha sido enviado
        if(isset($_POST["actualizar"])){
            //Variables que recogen los datos del formulario
            $password = $_POST["password"];
            $nuevapassword = $_POST["nuevapassword"];
            $repetirpassword = $_POST["repetirpassword"];
            //Comprobación de que el formulario no esté vacío
            if(empty($password && $nuevapassword && $repetirpassword)){
                return 1; //Debes completar los campos del formulario
            }else{
                //Formulario completo
                //Hacemos consulta a la base de datos de los datos del usuario de la sesión
                $consulta="SELECT * FROM colaborador WHERE correo='".$_SESSION["correo"]."'";
                //Método que ejuecuta la consulta
                $objeto->hacer_consultas($consulta);
                //Comprobación de que nos devuelve datos de ese usuario
                if($objeto->comprobar_consulta()>0){
                    //Variable que guatrda los datos que extrae el método de la base de datos
                    $fila = $objeto->extraer_filas();
                    //Comprobación de que las contraseña actual introducida y la de la base de datos coinciden
                    if(password_verify($password,$fila["password"])){
                        //Comprobación de que las contraseñas tienen mínimo 5 caracteres las dos
                        if(strlen($nuevapassword)<5 and strlen($repetirpassword)<5){
                            return 2; //Las contraseñas deben tener mínimo 5 caracteres
                        }else{
                            //Comprobación de errores que nos muestra si la contraseña actual coincide pero las nuevas no
                            if($nuevapassword!=$repetirpassword){
                                return 3; //Las nuevas contraseñas no coinciden
                            }else{

                                //Contraseña actual correcta y nuevas coinciden
                                //Consulta de actualización de contraseña
                                $consulta="UPDATE colaborador SET password='".password_hash($repetirpassword, PASSWORD_DEFAULT)."' WHERE correo='".$_SESSION["correo"]."' AND password='".$fila["password"]."'";
                                //Método que ejecuta la consulta
                                $objeto->hacer_consultas($consulta);
                                //Método que compruba que la actualización se ha realizado correctamente
                                if($objeto->comprobar_actualizacion()>0){
                                    return 4; //Contraseña modificada correctamente
                                }else{
                                    return 5; //Error en modificación de contraseña
                                }
                            }
                        }

                    }else{
                        //Comprobación de errores que nos muestra si la contraseña actual no coincide y las nuevas tampoco
                        if($nuevapassword!==$repetirpassword){
                            return 6; //Ninguno de los campos son válidos
                        }else{
                            return 7; //Contraseña actual incorrecta
                        }
                    }
                }
            }
        }
    }
?>

